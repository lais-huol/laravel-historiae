<?php

namespace Historiae\Listeners;

use Historiae\AccessLog;
use Illuminate\Support\Facades\Auth;

class LogAccess
{
    public function handle($request, $response)
    {
        AccessLog::create([
            'ip' => $request->ip(),
            'url' => $request->getRequestUri(),
            'status' => $response->status(),
            'method' => $request->method(),
            'user_id' => Auth::id()
        ]);
    }
}
