<?php

namespace Historiae;

trait WithAuthenticatable
{
    protected static $authenticatable;

    protected static function boot()
    {
        parent::boot();

        static::$authenticatable = config('auth.providers.users.model');
    }
}
