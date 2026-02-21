<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;

use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Room Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->rules(['regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/']),
                        Forms\Components\Select::make('type')
                            ->options([
                                'standard' => 'Standard',
                                'premium' => 'Premium',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->label('Monthly Price')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(999999999999.99)
                            ->step(0.01)
                            ->prefix('IDR')
                            ->helperText('Regular monthly rental price'),
                        Forms\Components\TextInput::make('price_6_months')
                            ->label('6-Month Package Price')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(999999999999.99)
                            ->step(0.01)
                            ->prefix('IDR')
                            ->helperText('Total price for 6 months. Should be less than 6x monthly price for discount.'),
                        Forms\Components\TextInput::make('price_yearly')
                            ->label('Yearly Package Price')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(999999999999.99)
                            ->step(0.01)
                            ->prefix('IDR')
                            ->helperText('Total price for 1 year. Should be less than 12x monthly price for discount.'),
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\TagsInput::make('facilities')
                            ->required()
                            ->placeholder('Add a facility'),
                        Forms\Components\FileUpload::make('images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->directory('rooms')
                            ->maxFiles(8)
                            ->maxSize(2048) // 2MB per image
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_available')
                            ->default(true)
                            ->required(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'standard' => 'gray',
                        'premium' => 'warning',
                        default => 'gray',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Monthly Price')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_6_months')
                    ->label('6 Months Price')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('price_yearly')
                    ->label('Yearly Price')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('is_available'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'standard' => 'Standard',
                        'premium' => 'Premium',
                    ]),
                Tables\Filters\TernaryFilter::make('is_available')
                    ->label('Availability'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
