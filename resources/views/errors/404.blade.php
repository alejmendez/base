<?php
$controller = app('tomasini\Modules\Base\Http\Controllers\Controller');
$controller->css[] = '404.css';

$data = $controller->_app();
extract($data);

$html['titulo'] = 'Pagina no Encontrada';
if (is_null($usuario)){
	$usuario = (object) [
		'id' 		=> 0,
		'usuario' 	=> 'user.png',
		'nombre' 	=> 'Invitado',
		'apellido' 	=> '',
		'super'		=> 'n',
		'foto'      => 'user.jpg'
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
							<div class="number font-green"> 404 </div>
							<div class="details">
								<h3>No Encontramos lo Solicitado.</h3>
								<p>
									No podemos encontrar la p&aacute;gina que est&aacute; buscando.
									<br />
									<a href="{{ url(\Config::get('admin.prefix')) }}"> Regresa a Inicio </a> o prueba con la barra de men&uacute;.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection