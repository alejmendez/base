<?php
$controller = app('App\Modules\Base\Http\Controllers\Controller');
$controller->css[] = '404.css';

$data = $controller->_app();
extract($data);

$html['titulo'] = 'Pagina no Encontrada';
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


<?php $__env->startSection('content'); ?>
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
									<a href="<?php echo e(url(\Config::get('admin.prefix'))); ?>"> Regresa a Inicio </a> o prueba con la barra de men&uacute;.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('base::layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>