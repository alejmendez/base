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


	Route::group(['prefix' => 'ciudades'], function() {
		Route::get('/', 				'definiciones\CiudadesController@index');
		Route::get('buscar/{id}', 		'definiciones\CiudadesController@buscar');
		Route::get('nuevo', 		    'definiciones\CiudadesController@nuevo');

		Route::get('cambiar/{id}', 		'definiciones\CiudadesController@cambiar');
		Route::post('guardar',			'definiciones\CiudadesController@guardar');
		Route::put('guardar/{id}', 		'definiciones\CiudadesController@guardar');

		Route::delete('eliminar/{id}', 	'definiciones\CiudadesController@eliminar');
		Route::post('restaurar/{id}', 	'definiciones\CiudadesController@restaurar');
		Route::delete('destruir/{id}', 	'definiciones\CiudadesController@destruir');

		Route::post('cambio', 			'definiciones\CiudadesController@cambio');
		Route::get('datatable', 		'definiciones\CiudadesController@datatable');
	});

	Route::group(['prefix' => 'estados'], function() {
		Route::get('/', 				'definiciones\EstadosController@index');
		Route::get('buscar/{id}', 		'definiciones\EstadosController@buscar');
		Route::get('nuevo', 		    'definiciones\EstadosController@nuevo');

		Route::get('cambiar/{id}', 		'definiciones\EstadosController@cambiar');
		Route::post('guardar',			'definiciones\EstadosController@guardar');
		Route::put('guardar/{id}', 		'definiciones\EstadosController@guardar');

		Route::delete('eliminar/{id}', 	'definiciones\EstadosController@eliminar');
		Route::post('restaurar/{id}', 	'definiciones\EstadosController@restaurar');
		Route::delete('destruir/{id}', 	'definiciones\EstadosController@destruir');

		Route::post('cambio', 			'definiciones\EstadosController@cambio');
		Route::get('datatable', 		'definiciones\EstadosController@datatable');
	});

	Route::group(['prefix' => 'municipio'], function() {
		Route::get('/', 				'definiciones\MunicipioController@index');
		Route::get('buscar/{id}', 		'definiciones\MunicipioController@buscar');
		Route::get('nuevo', 		    'definiciones\MunicipioController@nuevo');

		Route::get('cambiar/{id}', 		'definiciones\MunicipioController@cambiar');
		Route::post('guardar',			'definiciones\MunicipioController@guardar');
		Route::put('guardar/{id}', 		'definiciones\MunicipioController@guardar');

		Route::delete('eliminar/{id}', 	'definiciones\MunicipioController@eliminar');
		Route::post('restaurar/{id}', 	'definiciones\MunicipioController@restaurar');
		Route::delete('destruir/{id}', 	'definiciones\MunicipioController@destruir');

		Route::post('cambio', 			'definiciones\MunicipioController@cambio');
		Route::get('datatable', 		'definiciones\MunicipioController@datatable');
	});
	
	Route::group(['prefix' => 'parroquia'], function() {
		Route::get('/', 				'definiciones\ParroquiaController@index');
		Route::get('buscar/{id}', 		'definiciones\ParroquiaController@buscar');
		Route::get('nuevo', 		    'definiciones\ParroquiaController@nuevo');

		Route::get('cambiar/{id}', 		'definiciones\ParroquiaController@cambiar');
		Route::post('guardar',			'definiciones\ParroquiaController@guardar');
		Route::put('guardar/{id}', 		'definiciones\ParroquiaController@guardar');

		Route::delete('eliminar/{id}', 	'definiciones\ParroquiaController@eliminar');
		Route::post('restaurar/{id}', 	'definiciones\ParroquiaController@restaurar');
		Route::delete('destruir/{id}', 	'definiciones\ParroquiaController@destruir');

		Route::post('cambio', 			'definiciones\ParroquiaController@cambio');
		Route::get('datatable', 		'definiciones\ParroquiaController@datatable');
	});
	
	Route::group(['prefix' => 'sector'], function() {
		Route::get('/', 				'definiciones\SectorController@index');
		Route::get('buscar/{id}', 		'definiciones\SectorController@buscar');
		Route::get('nuevo', 		    'definiciones\SectorController@nuevo');

		Route::get('cambiar/{id}', 		'definiciones\SectorController@cambiar');
		Route::post('guardar',			'definiciones\SectorController@guardar');
		Route::put('guardar/{id}', 		'definiciones\SectorController@guardar');

		Route::delete('eliminar/{id}', 	'definiciones\SectorController@eliminar');
		Route::post('restaurar/{id}', 	'definiciones\SectorController@restaurar');
		Route::delete('destruir/{id}', 	'definiciones\SectorController@destruir');

		Route::post('cambio', 			'definiciones\SectorController@cambio');
		Route::get('datatable', 		'definiciones\SectorController@datatable');
	});

});

Route::group(['middleware' => 'web', 'prefix' => 'img/', 'namespace' => 'App\Modules\Base\Http\Controllers'], function() {
	Route::get('{dir}/{tam}/{arch}', 'ImagenController@public_img');
});
