<?php

namespace App\Filament\Resources\LabelResource\Pages;

use Filament\Actions;
use App\Filament\Resources\LabelResource;
use Filament\Resources\Pages\ManageRecords;


class ManageLabels extends ManageRecords
{
    protected static string $resource = LabelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}