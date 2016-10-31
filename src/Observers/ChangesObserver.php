<?php

namespace Historiae\Observers;

use Historiae\ChangeLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ChangesObserver
{
    public function saving(Model $object)
    {
        ChangeLog::create([
            'model' => get_class($object),
            'json' => $object->setHidden([]),
            'created' => !$object->exists,
            'user_id' => Auth::id()
        ]);
    }
}
