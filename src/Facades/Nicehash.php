<?php

namespace Days85\Nicehash\Facades;

use Illuminate\Support\Facades\Facade;

class Nicehash extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor(): string
    {
        return \Days85\Nicehash\Nicehash::class;
    }
}
