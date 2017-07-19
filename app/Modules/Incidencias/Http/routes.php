<?php

Route::group(['middleware' => 'web', 'prefix' => 'incidencias', 'namespace' => 'App\\Modules\Incidencias\Http\Controllers'], function()
{
    Route::get('/', 'IncidenciasController@index');
});
