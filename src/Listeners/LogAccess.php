<?php

namespace Historiae\Listeners;

use Historiae\AccessLog;
use Illuminate\Support\Facades\Auth;

class LogAccess
{
    /**
     * Handle the event.
     *
     * @param   \Illuminate\Http\Request  $request
     * @param   \Illuminate\Http\Response $response
     * @return  void
     */
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
