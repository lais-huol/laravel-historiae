<?php

namespace Historiae;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    use WithAuthenticatable;

    protected $fillable = ['ip', 'url', 'status', 'method', 'user_id'];

    public function user()
    {
        return $this->belongsTo(static::$authenticatable);
    }
}
