<?php

namespace Edwink\FilamentUserActivity\Filament\Resources\UserActivityResource\Pages;

use Edwink\FilamentUserActivity\Filament\Resources\UserActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserActivities extends ListRecords
{
    protected static string $resource = UserActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
