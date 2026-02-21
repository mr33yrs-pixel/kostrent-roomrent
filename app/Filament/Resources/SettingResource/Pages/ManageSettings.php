<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Resources\Pages\ManageRecords;

class ManageSettings extends ManageRecords
{
    protected static string $resource = SettingResource::class;

    /**
     * No header actions - settings should only be edited, not created.
     */
    protected function getHeaderActions(): array
    {
        return [];
    }
}
