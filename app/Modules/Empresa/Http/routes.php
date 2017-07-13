<?php

Route::group(['middleware' => 'web', 'prefix' => 'empresa', 'namespace' => 'App\\Modules\Empresa\Http\Controllers'], function()
{
    Route::get('/', 'EmpresaController@index');
});
