<?php $__env->startSection('content-top'); ?>
	<?php echo $__env->make('base::partials.botonera', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('base::partials.ubicacion', ['ubicacion' => ['Usuarios']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('base::partials.modal-busqueda', [
		'titulo' => 'Buscar Usuarios.',
		'columnas' => [
			'Usuario' => '30',
			'Cedula'  => '30',
			'Nombre'  => '40'
		]
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="row">
		<form id="formulario" name="formulario" enctype="multipart/form-data" method="POST" autocomplete="off">
			<div class="profile-sidebar col-md-3" style="margin-bottom: 35px;">
				<div class="portlet light profile-sidebar-portlet ">
					<div class="mt-element-overlay">
						<div class="row">
							<div class="col-md-12">
								<div class="mt-overlay-6">
									<img  id="foto" src="<?php echo e(url('public/img/usuarios/user.png')); ?>" class="img-responsive" alt="">
									<div class="mt-overlay">
										<h2> </h2>
										<p>
											<input id="upload" name="foto" type="file" />
											<a href="#" id="upload_link" class="mt-info uppercase btn default btn-outline">
												<i class="fa fa-camera"></i>
											</a>
										</p>
									</div>
									<h4 style="color:#fff;font-weight:bold;">Imagen de perfil</h4>
								</div>
							</div>
						</div>
					</div>
					<br />
				</div>
			</div>

			<div class="tabbable-line bg-white boxless tabbable-reversed col-md-9">
				<ul class="nav nav-tabs" style="margin-top: 10px;">
					<li class="active">
						<a href="#tab_0" data-toggle="tab">
							<i class="fa fa-user"></i> Usuario 
						</a>
					</li>
					<li>
						<a href="#tab_1" data-toggle="tab">
							<i class="fa fa-info-circle"></i> Informaci&oacute;n Personal
						</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="tab_0">
						<div class="row">
							<?php echo e(Form::hidden('permisos', '', ['id' => 'permisos'])); ?>


							<?php echo e(Form::bsText('usuario', '', [
								'label' => 'Usuario',
								'placeholder' => 'Login del Usuario',
								'required' => 'required'
							])); ?>


							<?php echo e(Form::bsPassword('password', '', [
								'label' => 'Contrase&ntilde;a',
								'placeholder' => 'Contrase&ntilde;a del Usuario',
								'required' => 'required'
							])); ?>


							<?php echo e(Form::bsSelect('perfil_id', $controller->perfiles(), '', [
								'label' => 'Perfil',
								'required' => 'required'
							])); ?>


							<?php if($usuario->super === 's'): ?>
								<?php echo e(Form::bsSelect('super', [
									'n' => 'No',
									's' => 'Si',
								], 'n',
								[
									'label' => '&iquest;Es Super Usuario?',
									'required' => 'required'
								])); ?>

							<?php endif; ?>

							
				     
							<div class="form-group col-xs-12">
								<label for="arbol">Permisos:</label>
								<input id="input_buscar" name="input_buscar" class="form-control" type="text" placeholder="Buscar" value="" /><br />
								<div id="arbol"></div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab_1">
						<div class="row">
							 <?php echo $Personas->generate(); ?>

							 <div class="col-md-12"></div>
							 <?php echo $Personas_telefono->generate(); ?>

							 <?php echo $Personas_correo->generate(); ?>

						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
	<script>
		var imagenDefault = "<?php echo e(url('public/img/usuarios/user.png')); ?>";
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make(isset($layouts) ? $layouts : 'base::layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>