<?php

namespace Edwink\FilamentUserActivity\Commands;

use Carbon\Carbon;
use Edwink\FilamentUserActivity\Models\UserActivity;
use Illuminate\Console\Command;

class FilamentUserActivityCommand extends Command
{
    public $signature = 'filament-user-activity:truncate-activities-table';

    public $description = 'Truncates the activity table as configured config/filament-user-activity.php';

    public function handle(): int
    {
        $this->comment('Truncating datatable '.config('filament-user-activity.table.name'));
        $query = UserActivity::whereDate('created_at', '<', Carbon::today()->subDays(config('filamanet-user-activity.table.retention-days')));
        $this->comment('Deleting '.$query->count().' of '.UserActivity::count().' entries.');
        $query->forceDelete();
        $this->comment('DONE');

        return self::SUCCESS;
    }
}
