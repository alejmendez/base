	<div class="page-header">
		<!-- BEGIN HEADER TOP -->
		<div class="page-header-top">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<div class="page-logo">
					<a href="<?php echo e(url('/')); ?>">
						<img src="<?php echo e(asset('img/logos/168x68/' . $controller->conf('logo'))); ?>" alt="logo" class="logo-default" />
					</a>
				</div>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="menu-toggler"></a>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<!-- BEGIN USER LOGIN DROPDOWN -->
						<li class="dropdown dropdown-user dropdown-dark">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<?php if(is_file('public/img/usuarios/' . $usuario->personas->foto)): ?>
									<img alt="" class="img-circle" src="<?php echo e(url('img/usuarios/40x40/' . $usuario->personas->foto)); ?>">
								<?php else: ?>
									<img alt="" class="img-circle" src="<?php echo e(url('img/usuarios/40x40/user.png')); ?>">
								<?php endif; ?>
								<span class="username username-hide-mobile"><?php echo e($usuario->personas->nombres); ?></span>
							</a>
							<?php if($usuario->id > 0): ?>
							<ul class="dropdown-menu dropdown-menu-default">
								<li>
									<a href="<?php echo e(url(Config::get('admin.prefix').'/perfil')); ?>">
										<i class="fa fa-user"></i> Mi Perfil
									</a>
								</li>
								<li class="divider"> </li>
								<li>
									<a href="<?php echo e(url(Config::get('admin.prefix').'/login/bloquear')); ?>">
										<i class="icon-lock"></i> Bloquear Pantalla
									</a>
								</li>
								<li>
									<a href="<?php echo e(url(Config::get('admin.prefix').'/login/salir')); ?>">
										<i class="icon-logout"></i> Salir
									</a>
								</li>
							</ul>
							<?php endif; ?>
						</li>
						<!-- END USER LOGIN DROPDOWN -->
						<!-- BEGIN QUICK SIDEBAR TOGGLER -->
						<li class="">
							<a href="<?php echo e(url(Config::get('admin.prefix').'/login/salir')); ?>">
								<span class="sr-only">Salir</span>
								<i class="icon-logout"></i> 
							</a>
						</li>
						<!-- END QUICK SIDEBAR TOGGLER -->
					</ul>
				</div>
				<!-- END TOP NAVIGATION MENU -->
			</div>
		</div>
		<!-- END HEADER TOP -->
		<?php echo $__env->make('base::partials.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>