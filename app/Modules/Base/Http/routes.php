<?php

Route::group(['middleware' => 'web', 'prefix' => Config::get('admin.prefix'), 'namespace' => 'App\\Modules\Base\Http\Controllers'], function() {
    Route::get('/', 'EscritorioController@getIndex');
	 
	/**
	 * Login
	 */
	
	Route::group(['prefix' => 'login'], function() {
		Route::get('/', 				'LoginController@index')->name('login');
		Route::get('salir', 			'LoginController@salir')->name('logout');
		Route::post('validar', 			'LoginController@validar');
		Route::get('bloquear', 			'LoginController@bloquear');
	});

	/**
	 * Perfiles
	 */

	Route::group(['prefix' => 'perfiles'], function() {
		Route::get('/', 				'PerfilesController@index');
		Route::get('buscar/{id}', 		'PerfilesController@buscar');
		Route::post('guardar', 			'PerfilesController@guardar');
		Route::put('guardar/{id}', 		'PerfilesController@guardar');
		Route::delete('eliminar/{id}', 	'PerfilesController@eliminar');
		Route::post('restaurar/{id}', 	'PerfilesController@restaurar');
		Route::delete('destruir/{id}', 	'PerfilesController@destruir');
		Route::get('arbol', 			'PerfilesController@arbol');
		Route::get('datatable', 		'PerfilesController@datatable');
	});

	/**
	 * Perfil
	 */

	Route::group(['prefix' => 'perfil'], function() {
		Route::get('/', 				'PerfilController@index');
		Route::put('actualizar', 		'PerfilController@actualizar');
		Route::put('clave', 			'PerfilController@clave');
		Route::post('cambio', 			'PerfilController@cambio');
	});

	/**
	 * Usuarios
	 */

	Route::group(['prefix' => 'usuarios'], function() {
		Route::get('/', 				'UsuariosController@index');
		Route::get('buscar/{id}', 		'UsuariosController@buscar');

		Route::post('guardar',			'UsuariosController@guardar');
		Route::put('guardar/{id}', 		'UsuariosController@guardar');

		Route::delete('eliminar/{id}', 	'UsuariosController@eliminar');
		Route::post('restaurar/{id}', 	'UsuariosController@restaurar');
		Route::delete('destruir/{id}', 	'UsuariosController@destruir');

		Route::post('cambio', 			'UsuariosController@cambio');
		Route::get('arbol', 			'UsuariosController@arbol');
		Route::get('datatable', 		'UsuariosController@datatable');
	});

});

Route::group(['middleware' => 'web', 'prefix' => 'img/', 'namespace' => 'App\Modules\Base\Http\Controllers'], function() {
	Route::get('{dir}/{tam}/{arch}', 'ImagenController@public_img');
});
