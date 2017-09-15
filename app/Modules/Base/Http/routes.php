<?php

Route::group(['middleware' => 'web', 'prefix' => Config::get('admin.prefix'), 'namespace' => 'App\\Modules\Base\Http\Controllers'], function() {
    Route::get('/', 'EscritorioController@getIndex');
	 
	/**
	 * Login
	 */
	
	Route::group(['prefix' => 'login'], function() {
		Route::get('/', 				'LoginController@index')->name('login');
		Route::get('salir', 			'LoginController@salir')->name('logout');
		Route::post('foto', 			'LoginController@foto');
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
		/* 	Route::get('/', 				'PerfilController@index');
			Route::put('actualizar', 		'PerfilController@actualizar');
			Route::put('clave', 			'PerfilController@clave');
			Route::post('cambio', 			'PerfilController@cambio');
		*/
		Route::get('/', 			'PerfilController@index');
		Route::get('buscar/{id}', 	'PerfilController@buscar');
		Route::put('guardar/{id}', 	'PerfilController@guardar');
		Route::put('clave', 		'PerfilController@clave');
		Route::post('cambio', 		'PerfilController@cambio');
		Route::get('ciudades/{id}',     'PerfilController@ciudades');
		Route::get('municipios/{id}',   'PerfilController@municipios');
		Route::get('parroquias/{id}',   'PerfilController@parroquias');
		Route::get('sectores/{id}',    	'PerfilController@sectores');

		Route::get('telefonos',    	    'PerfilController@personastelefono');
		Route::get('correo',    	    'PerfilController@personascorreos');
		Route::get('validar',    	    'PerfilController@validar');
	});

	/**
	 * Usuarios
	 */

	Route::group(['prefix' => 'usuarios'], function() {
		Route::get('/', 				'UsuariosController@index');
		Route::get('buscar/{id}', 		'UsuariosController@buscar');

		Route::post('guardar',			'UsuariosController@guardar');
		Route::put('guardar/{id}', 		'UsuariosController@guardar');
		Route::post('validar',			'UsuariosController@validar');
		Route::delete('eliminar/{id}', 	'UsuariosController@eliminar');
		Route::post('restaurar/{id}', 	'UsuariosController@restaurar');
		Route::delete('destruir/{id}', 	'UsuariosController@destruir');

		Route::post('cambio', 			'UsuariosController@cambio');
		Route::get('arbol', 			'UsuariosController@arbol');
		Route::get('datatable', 		'UsuariosController@datatable');
	});

	Route::group(['prefix' => 'configuracion'], function() {
		Route::get('/', 				'ConfiguracionController@index');
		Route::post('guardar',			'ConfiguracionController@guardar');
		Route::put('guardar/{id}', 		'ConfiguracionController@guardar');
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

	Route::group(['prefix' => 'personas'], function () {
	//definiciones o configuraciones del sistema
		
		Route::group(['prefix' => 'telefonotipo'], function() {
			Route::get('/', 				'definiciones\TipoTelefonoController@index');
			Route::get('buscar/{id}', 		'definiciones\TipoTelefonoController@buscar');
			Route::get('nuevo', 		    'definiciones\TipoTelefonoController@nuevo');

			Route::get('cambiar/{id}', 		'definiciones\TipoTelefonoController@cambiar');
			Route::post('guardar',			'definiciones\TipoTelefonoController@guardar');
			Route::put('guardar/{id}', 		'definiciones\TipoTelefonoController@guardar');

			Route::delete('eliminar/{id}', 	'definiciones\TipoTelefonoController@eliminar');
			Route::post('restaurar/{id}', 	'definiciones\TipoTelefonoController@restaurar');
			Route::delete('destruir/{id}', 	'definiciones\TipoTelefonoController@destruir');

			Route::post('cambio', 			'definiciones\TipoTelefonoController@cambio');
			Route::get('datatable', 		'definiciones\TipoTelefonoController@datatable');
		});
		
		Route::group(['prefix' => 'bancos'], function() {
			Route::get('/', 				'definiciones\BancosController@index');
			Route::get('buscar/{id}', 		'definiciones\BancosController@buscar');
			Route::get('nuevo', 		    'definiciones\BancosController@nuevo');

			Route::get('cambiar/{id}', 		'definiciones\BancosController@cambiar');
			Route::post('guardar',			'definiciones\BancosController@guardar');
			Route::put('guardar/{id}', 		'definiciones\BancosController@guardar');

			Route::delete('eliminar/{id}', 	'definiciones\BancosController@eliminar');
			Route::post('restaurar/{id}', 	'definiciones\BancosController@restaurar');
			Route::delete('destruir/{id}', 	'definiciones\BancosController@destruir');

			Route::post('cambio', 			'definiciones\BancosController@cambio');
			Route::get('datatable', 		'definiciones\BancosController@datatable');
		});
		Route::group(['prefix' => 'bancotipo'], function() {
			Route::get('/', 				'definiciones\BancoTipoCuentaController@index');
			Route::get('buscar/{id}', 		'definiciones\BancoTipoCuentaController@buscar');
			Route::get('nuevo', 		    'definiciones\BancoTipoCuentaController@nuevo');

			Route::get('cambiar/{id}', 		'definiciones\BancoTipoCuentaController@cambiar');
			Route::post('guardar',			'definiciones\BancoTipoCuentaController@guardar');
			Route::put('guardar/{id}', 		'definiciones\BancoTipoCuentaController@guardar');

			Route::delete('eliminar/{id}', 	'definiciones\BancoTipoCuentaController@eliminar');
			Route::post('restaurar/{id}', 	'definiciones\BancoTipoCuentaController@restaurar');
			Route::delete('destruir/{id}', 	'definiciones\BancoTipoCuentaController@destruir');

			Route::post('cambio', 			'definiciones\BancoTipoCuentaController@cambio');
			Route::get('datatable', 		'definiciones\BancoTipoCuentaController@datatable');
		});

		Route::group(['prefix' => 'tipopersona'], function() {
			Route::get('/', 				'definiciones\TipoPersonaController@index');
			Route::get('buscar/{id}', 		'definiciones\TipoPersonaController@buscar');
			Route::get('nuevo', 		    'definiciones\TipoPersonaController@nuevo');

			Route::get('cambiar/{id}', 		'definiciones\TipoPersonaController@cambiar');
			Route::post('guardar',			'definiciones\TipoPersonaController@guardar');
			Route::put('guardar/{id}', 		'definiciones\TipoPersonaController@guardar');

			Route::delete('eliminar/{id}', 	'definiciones\TipoPersonaController@eliminar');
			Route::post('restaurar/{id}', 	'definiciones\TipoPersonaController@restaurar');
			Route::delete('destruir/{id}', 	'definiciones\TipoPersonaController@destruir');

			Route::post('cambio', 			'definiciones\TipoPersonaController@cambio');
			Route::get('datatable', 		'definiciones\TipoPersonaController@datatable');
		});

		Route::group(['prefix' => 'profesion'], function() {
			Route::get('/', 				'definiciones\ProfesionController@index');
			Route::get('buscar/{id}', 		'definiciones\ProfesionController@buscar');
			Route::get('nuevo', 		    'definiciones\ProfesionController@nuevo');

			Route::get('cambiar/{id}', 		'definiciones\ProfesionController@cambiar');
			Route::post('guardar',			'definiciones\ProfesionController@guardar');
			Route::put('guardar/{id}', 		'definiciones\ProfesionController@guardar');

			Route::delete('eliminar/{id}', 	'definiciones\ProfesionController@eliminar');
			Route::post('restaurar/{id}', 	'definiciones\ProfesionController@restaurar');
			Route::delete('destruir/{id}', 	'definiciones\ProfesionController@destruir');

			Route::post('cambio', 			'definiciones\ProfesionController@cambio');
			Route::get('datatable', 		'definiciones\ProfesionController@datatable');
		});

		Route::group(['prefix' => 'persona'], function() {
			Route::get('/', 				'PersonasController@index');
			Route::get('buscar/{id}', 		'PersonasController@buscar');
			Route::get('nuevo', 		    'PersonasController@nuevo');
			Route::get('ciudades/{id}',     'PersonasController@ciudades');
			Route::get('municipios/{id}',   'PersonasController@municipios');
			Route::get('parroquias/{id}',   'PersonasController@parroquias');
			Route::get('sectores/{id}',    	'PersonasController@sectores');
			Route::get('bancos',    	    'PersonasController@personasbancos');
			Route::get('telefonos',    	    'PersonasController@personastelefono');
			Route::get('correo',    	    'PersonasController@personascorreos');
			Route::get('validar',    	    'PersonasController@validar');

			Route::get('cambiar/{id}', 		'PersonasController@cambiar');
			Route::post('guardar',			'PersonasController@guardar');
			Route::put('guardar/{id}', 		'PersonasController@guardar');

			Route::delete('eliminar/{id}', 	'PersonasController@eliminar');
			Route::post('restaurar/{id}', 	'PersonasController@restaurar');
			Route::delete('destruir/{id}', 	'PersonasController@destruir');

			Route::post('cambio', 			'PersonasController@cambio');
			Route::get('datatable', 		'PersonasController@datatable');
		});

	
	});

	Route::group(['prefix' => 'notificacion/mensaje'], function() {
		Route::get('/',                 'MensajeController@index');
		Route::get('nuevo',             'MensajeController@nuevo');
		Route::get('cambiar/{id}',      'MensajeController@cambiar');
		
		Route::get('buscar/{id}',       'MensajeController@buscar');

		Route::post('guardar',          'MensajeController@guardar');
		Route::put('guardar/{id}',      'MensajeController@guardar');

		Route::delete('eliminar/{id}',  'MensajeController@eliminar');
		Route::post('restaurar/{id}',   'MensajeController@restaurar');
		Route::delete('destruir/{id}',  'MensajeController@destruir');

		Route::get('datatable',         'MensajeController@datatable');
	});


	Route::group(['prefix' => 'notificacion/tipo_notificacion'], function() {
		Route::get('/',                 'TipoNotificacionController@index');
		Route::get('nuevo',             'TipoNotificacionController@nuevo');
		Route::get('cambiar/{id}',      'TipoNotificacionController@cambiar');
		
		Route::get('buscar/{id}',       'TipoNotificacionController@buscar');

		Route::post('guardar',          'TipoNotificacionController@guardar');
		Route::put('guardar/{id}',      'TipoNotificacionController@guardar');

		Route::delete('eliminar/{id}',  'TipoNotificacionController@eliminar');
		Route::post('restaurar/{id}',   'TipoNotificacionController@restaurar');
		Route::delete('destruir/{id}',  'TipoNotificacionController@destruir');

		Route::get('datatable',         'TipoNotificacionController@datatable');
	});


        Route::group(['prefix' => 'notificaciones'], function() {
            Route::get('/',                 'NotificacionesController@index');
            Route::get('nuevo',             'NotificacionesController@nuevo');
            Route::get('cambiar/{id}',      'NotificacionesController@cambiar');
            
            Route::get('buscar/{id}',       'NotificacionesController@buscar');

            Route::post('guardar',          'NotificacionesController@guardar');
            Route::put('guardar/{id}',      'NotificacionesController@guardar');

            Route::delete('eliminar/{id}',  'NotificacionesController@eliminar');
            Route::post('restaurar/{id}',   'NotificacionesController@restaurar');
            Route::delete('destruir/{id}',  'NotificacionesController@destruir');

            Route::get('datatable',         'NotificacionesController@datatable');
        });

	//{{route}}

});

Route::group(['middleware' => 'web', 'prefix' => 'img/', 'namespace' => 'App\Modules\Base\Http\Controllers'], function() {
	Route::get('{dir}/{tam}/{arch}', 'ImagenController@public_img');
});