<?php

namespace Historiae;

use Illuminate\Database\Eloquent\Model;

class ChangeLog extends Model
{
    use WithAuthenticatable;

    protected $fillable = ['model', 'json', 'created', 'user_id'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'json' => 'array',
    ];

    public function getModelAttribute($value)
    {
        return config("historiae.labels.{$value}", $value);
    }

    public function user()
    {
        return $this->belongsTo(static::$authenticatable);
    }
}
