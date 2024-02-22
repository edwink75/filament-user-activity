<?php

namespace Edwink\FilamentUserActivity\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Edwink\FilamentUserActivity\FilamentUserActivity
 */
class FilamentUserActivity extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Edwink\FilamentUserActivity\FilamentUserActivity::class;
    }
}
