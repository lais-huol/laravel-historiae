<?php

Route::group([
    'middleware' => $this->getConfig('middleware'),
    'namespace' => '\Historiae\Http\Controllers',
    'prefix' => 'logs'
], function() {
    Route::get('accesses', 'AccessLogsController@index');
    Route::get('changes', 'ChangeLogsController@index');
});
