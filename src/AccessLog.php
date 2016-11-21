<?php

namespace Historiae;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    use WithAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ip', 'url', 'status', 'method', 'user_id'];

    /*
     * Get the user linked to the access.
     */
    public function user()
    {
        return $this->belongsTo(static::$authenticatable);
    }
}
