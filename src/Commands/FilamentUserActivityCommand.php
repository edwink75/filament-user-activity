<?php

namespace Edwink\FilamentUserActivity\Commands;

use Illuminate\Console\Command;

class FilamentUserActivityCommand extends Command
{
    public $signature = 'filament-user-activity';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
