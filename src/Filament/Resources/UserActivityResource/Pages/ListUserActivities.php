<?php

namespace Edwink\FilamentUserActivity\Filament\Resources\UserActivityResource\Pages;

use Closure;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Edwink\FilamentUserActivity\Filament\Resources\UserActivityResource;

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
