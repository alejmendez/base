<?php
$controller = app('App\Modules\Base\Http\Controllers\Controller');
$controller->css[] = '404.css';

$data = $controller->_app();
extract($data);

$html['titulo'] = 'Servicio no disponible';
$html['css'][] = '404.css';

if (is_null($usuario)){
	$usuario = (object) [
		'id' 		=> 0,
		'usuario' 	=> 'user.png',
		'nombre' 	=> 'Invitado',
		'super'		=> 'n',
		'personas' => (object) [
			'foto'      => 'user.jpg',
			'nombres' 	=> 'Invitado',
		]
	];
}
?>

@extends('base::layouts.default')
@section('content')
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="container">
				<div class="page-content-inner">
					<div class="row">
						<div class="col-md-12 page-404">
							<div class="number font-green"> 503 </div>
							<div class="details">
								<h3>Servicio no disponible.</h3>
								<p>
									Intenta acceder m&aacute;s tarde.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
