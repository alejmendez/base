<?php
$controller = app('App\Modules\Base\Http\Controllers\Controller');
$controller->css[] = 'login.min.css';
$controller->js[] = 'login.js';

$data = $controller->_app();
extract($data);

$html['titulo'] = 'Inicio de Sesión';
?>
<!DOCTYPE html>
<!--[if IE 8]>    <html lang="es" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>    <html lang="es" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--><html lang="es"><!--<![endif]-->
<head>
	<?php echo $__env->make('base::partials.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head><!--/head-->

	<body class="login">
		<div class="logo">
			<a href="<?php echo e(url(\Config::get('admin.prefix'))); ?>">
				<img src="<?php echo e(asset('img/logos/253x123/' . $controller->conf('login_logo'))); ?>" alt="Logo" />
			</a>
		</div>
		<div class="content">
			<?php echo Form::open(array('id' => 'formulario', 'url' => 'login')); ?>

				<h3 class="form-title font-green"><?php echo e($controller->conf('nombre')); ?></h3>
				<div>
					<img alt="" class="profile-img"  id="foto" src="<?php echo e(url('public/img/usuarios/user.png')); ?>">
				</div>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9"><?php echo e(Lang::get('login.user')); ?></label>
					<?php echo Form::text('nombre', '', ['class' => 'form-control form-control-solid placeholder-no-fix user', 'autocomplete' => 'off', 'placeholder' => Lang::get('login.user')]); ?>

				</div>

				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9"><?php echo e(Lang::get('login.password')); ?></label>
					<?php echo Form::password('password', ['class' => 'form-control form-control-solid placeholder-no-fix', 'autocomplete' => 'off', 'placeholder' => Lang::get('login.password')]); ?>

				</div>

				<label class="rememberme check mt-checkbox mt-checkbox-outline">
					<?php echo Form::checkbox('recordar', '1', false); ?>

					<?php echo e(Lang::get('login.remember_me')); ?>

					<span></span>
				</label>

				<div class="form-actions" style="text-align: center;">
					<?php echo Form::button(Lang::get('login.log_in'), ['class' => 'btn green uppercase']); ?>

				</div>
				
				<!-- <div class="login-options">
					<h4>&Oacute; Iniciar sesi&oacute;n como</h4>
					<ul class="social-icons">
						<li>
							<a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>
						</li>
						<li>
							<a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>
						</li>
						<li>
							<a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>
						</li>
						<li>
							<a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>
						</li>
					</ul>
				</div> -->

				<div class="create-account">
					<p><?php echo e(date('Y')); ?> &copy; Gobernaci&oacute;n del Estado Bolívar.</p>
					<!-- 	Desarrollado por:  Gobernacion del Estado Bolívar / Division de desarrollo Web 
							Alejandro Mendez alejmendez.87@gmail.com
							Luis Mata lmata1793@gmail.com
							Miguelangel Gutierrez Drummermiguelangel@gmail.com 	
					 -->
				</div>
			<?php echo Form::close(); ?>

		</div>
		<script type="text/javascript" charset="utf-8" async defer>
		var ruta= "<?php echo e(asset('public/img/usuarios')); ?>";
		</script>
		<?php echo $__env->make('base::partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	

	</body>
</html>