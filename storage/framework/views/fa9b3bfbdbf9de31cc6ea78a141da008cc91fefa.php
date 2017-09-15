<!DOCTYPE html>
<!--[if IE 8]>    <html lang="es" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>    <html lang="es" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--><html lang="es"><!--<![endif]-->
<head>
	<?php echo $__env->make('base::partials.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head><!--/head-->

<body class="page-container-bg-solid">
	<?php echo $__env->make('base::partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="page-container">
		<div class="page-content-wrapper">
			<div class="page-head">
				<div class="container-fluid">
					<div class="page-title">
						<h1><?php echo e(ucwords($html['titulo'])); ?></h1>
					</div>
				</div>
			</div>
			<div class="page-content">
				<div class="container-fluid">
					<?php echo $__env->yieldContent('content-top'); ?>
					<?php echo $__env->yieldContent('content'); ?>
				</div>
			</div>
		</div>
	</div>
	<?php echo $__env->make('base::partials.page-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('base::partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>