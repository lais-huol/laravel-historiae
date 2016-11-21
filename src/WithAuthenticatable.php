<?php

namespace Historiae;

trait WithAuthenticatable
{
    /**
     * The authenticatable model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected static $authenticatable;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::$authenticatable = config('auth.providers.users.model');
    }
}
