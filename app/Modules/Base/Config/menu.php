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
			[
				'nombre' 	=> 'Configuracion',
				'direccion' => 'configuracion',
				'icono' 	=> 'fa fa-gear'
			],
			[
				'nombre' 	=> 'Personas',
				'direccion' => '#Personas',
				'icono' 	=> 'fa fa-gear',
				'menu' 		=> [
					[
						'nombre' 	=> 'Definiciones',
						'direccion' => '#DefinicionesPersonas',
						'icono' 	=> 'fa fa-gear',
						'menu' 		=> [
							[
								'nombre' 	=> 'Profesion',
								'direccion' => 'personas/profesion',
								'icono' 	=> 'fa fa-briefcase'
							],
							[
								'nombre' 	=> 'Tipo de telefono',
								'direccion' => 'personas/telefonotipo',
								'icono' 	=> 'fa fa-phone'
							],
							[
								'nombre' 	=> 'Tipo de Persona',
								'direccion' => 'personas/tipopersona',
								'icono' 	=> 'fa fa-users'
							]

						]
					],[
						'nombre' 	=> 'Persona',
						'direccion' => 'personas/persona',
						'icono' 	=> 'fa fa-plus'
					]
				]
			]


		]
	],
	[
		'nombre' 	=> 'Escritorio',
		'direccion' => '/',
		'icono' 	=> 'fa fa-desktop'
	],
];

