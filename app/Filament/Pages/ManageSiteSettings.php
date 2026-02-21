<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Site Settings';
    protected static ?string $title = 'Manage Site Settings';
    protected static ?string $slug = 'site-settings';
    
    // Use a standard view, but since we are just using a form, we can use the default page view
    // or just render the form. Filament Pages usually need a view.
    protected static string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        // Load existing settings
        $settings = Setting::pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Settings')
                    ->tabs([
                        Tabs\Tab::make('Home Page')
                            ->schema([
                                Section::make('Hero Slider')
                                    ->schema([
                                        \Filament\Forms\Components\Repeater::make('hero_slides')
                                            ->label('Slides')
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('Main Title')
                                                    ->required(),
                                                TextInput::make('highlight')
                                                    ->label('Highlight Text (Green)')
                                                    ->required(),
                                                Textarea::make('description')
                                                    ->label('Description')
                                                    ->rows(2)
                                                    ->required(),
                                                FileUpload::make('image')
                                                    ->label('Slide Image')
                                                    ->image()
                                                    ->directory('site-assets')
                                                    ->visibility('public')
                                                    ->required(),
                                            ])
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                                    ]),
                                Section::make('Location Maps')
                                    ->schema([
                                        TextInput::make('google_maps_embed_url')
                                            ->label('Google Maps Embed URL')
                                            ->helperText('Paste the "src" attribute from the Google Maps Embed code.')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        Tabs\Tab::make('Contact Info')
                            ->schema([
                                TextInput::make('contact_whatsapp')
                                    ->label('WhatsApp Number')
                                    ->tel()
                                    ->helperText('Format: 628123456789'),
                                TextInput::make('contact_email')
                                    ->label('Email Address')
                                    ->email(),
                                Textarea::make('contact_address')
                                    ->label('Physical Address')
                                    ->rows(3),
                                Section::make('Social Media')
                                    ->schema([
                                        TextInput::make('social_facebook')
                                            ->label('Facebook URL')
                                            ->url()
                                            ->placeholder('https://facebook.com/...'),
                                        TextInput::make('social_instagram')
                                            ->label('Instagram URL')
                                            ->url()
                                            ->placeholder('https://instagram.com/...'),
                                        TextInput::make('social_tiktok')
                                            ->label('TikTok URL')
                                            ->url()
                                            ->placeholder('https://tiktok.com/...'),
                                        TextInput::make('social_x')
                                            ->label('X (Twitter) URL')
                                            ->url()
                                            ->placeholder('https://x.com/...'),
                                    ])->columns(2),
                            ]),
                    ])->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'label' => ucwords(str_replace('_', ' ', $key)),
                    'value' => $value,
                ]
            );
        }

        // Clear settings cache via model method
        Setting::clearCache();

        Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();
    }
}
