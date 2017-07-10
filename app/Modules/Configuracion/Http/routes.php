<?php

Route::group(['middleware' => 'web', 'prefix' => 'configuracion', 'namespace' => 'App\\Modules\Configuracion\Http\Controllers'], function()
{
    Route::get('/', 'ConfiguracionController@index');
});