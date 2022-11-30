<?php

namespace App\Filament\Resources\TaskgroupResource\Pages;

use App\Filament\Resources\TaskgroupResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTaskgroups extends ManageRecords
{
    protected static string $resource = TaskgroupResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
