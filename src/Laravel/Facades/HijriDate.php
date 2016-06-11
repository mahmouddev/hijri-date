<?php


namespace Mahmouddev\HijriDate\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class HijriDate extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'mahmouddev.hijridate';
    }
}
