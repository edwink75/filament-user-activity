<?php

namespace Edwink\FilamentUserActivity\Filament\Resources\UserActivityResource\Pages;

use Edwink\FilamentUserActivity\Filament\Resources\UserActivityResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

class ListUserActivities extends ListRecords
{
    protected static string $resource = UserActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }

    protected function makeTable(): Table
    {
        return parent::makeTable()->recordUrl(null);
    }
}
