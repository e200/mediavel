<?php

namespace e200\Mediavel\Facades;

use Illuminate\Support\Facades\Facade;

class Mediavel extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mediavel';
    }
}
