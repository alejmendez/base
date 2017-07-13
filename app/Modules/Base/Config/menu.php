<?php

$menu['base'] = [
	[
		'nombre' 	=> 'Administrador',
		'direccion' => '#Administrador',
		'icono' 	=> 'fa fa-gear',
		'menu' 		=> [
			[
				'nombre' 	=> 'Usuarios',
				'direccion' => 'usuarios',
				'icono' 	=> 'fa fa-user'
			],
			[
				'nombre' 	=> 'Perfiles',
				'direccion' => 'perfiles',
				'icono' 	=> 'fa fa-users'
			],
			[
				'nombre' 	=> 'Ubicaciones',
				'direccion' => '#Ubicaciones',
				'icono' 	=> 'fa fa-globe',
				'menu' 		=> [

					[
						'nombre' 	=> 'Estados',
						'direccion' => 'estados',
						'icono' 	=> 'fa fa-map-marker'
					],
					[
						'nombre' 	=> 'Ciudades',
						'direccion' => 'ciudades',
						'icono' 	=> 'fa fa-map-pin'
					],
					[
						'nombre' 	=> 'Municipios',
						'direccion' => 'municipio',
						'icono' 	=> 'fa fa-map-pin'
					],
					[
						'nombre' 	=> 'Parroquia',
						'direccion' => 'parroquia',
						'icono' 	=> 'fa fa-map-pin'
					],
					[
						'nombre' 	=> 'Sector',
						'direccion' => 'sector',
						'icono' 	=> 'fa fa-map-pin'
					]
				]
			],
		]
	]
];

