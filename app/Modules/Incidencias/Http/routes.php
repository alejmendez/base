<?php

Route::group(['middleware' => 'web', 'prefix' =>  Config::get('admin.prefix').'/incidencias', 'namespace' => 'App\\Modules\Incidencias\Http\Controllers'], function()
{

        Route::group(['prefix' => 'incidencias'], function() {
            Route::get('/',                 'IncidenciasController@index');
            Route::get('nuevo',             'IncidenciasController@nuevo');
            Route::get('cambiar/{id}',      'IncidenciasController@cambiar');
            Route::post('subir',             'IncidenciasController@subir');
            
            Route::get('buscar/{id}',       'IncidenciasController@buscar');

            Route::post('guardar',          'IncidenciasController@guardar');
            Route::put('guardar/{id}',      'IncidenciasController@guardar');

            Route::delete('eliminar/{id}',  'IncidenciasController@eliminar');
            Route::post('restaurar/{id}',   'IncidenciasController@restaurar');
            Route::delete('destruir/{id}',  'IncidenciasController@destruir');

            Route::get('datatable',         'IncidenciasController@datatable');
        });


        Route::group(['prefix' => 'estatus'], function() {
            Route::get('/',                 'EstatusController@index');
            Route::get('nuevo',             'EstatusController@nuevo');
            Route::get('cambiar/{id}',      'EstatusController@cambiar');
            
            Route::get('buscar/{id}',       'EstatusController@buscar');

            Route::post('guardar',          'EstatusController@guardar');
            Route::put('guardar/{id}',      'EstatusController@guardar');

            Route::delete('eliminar/{id}',  'EstatusController@eliminar');
            Route::post('restaurar/{id}',   'EstatusController@restaurar');
            Route::delete('destruir/{id}',  'EstatusController@destruir');

            Route::get('datatable',         'EstatusController@datatable');
        });

   //{{route}}
});