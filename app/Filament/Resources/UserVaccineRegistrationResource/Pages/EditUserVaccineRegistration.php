<?php

namespace App\Filament\Resources\UserVaccineRegistrationResource\Pages;

use App\Filament\Resources\UserVaccineRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserVaccineRegistration extends EditRecord
{
    protected static string $resource = UserVaccineRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
