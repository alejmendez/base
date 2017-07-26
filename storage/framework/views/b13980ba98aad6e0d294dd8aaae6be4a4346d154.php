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
						<li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span class="circle">3</span>
                                <span class="corner"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>You have
                                        <strong>7 New</strong> Messages</h3>
                                    <a href="app_inbox.html">view all</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                        <span class="from"> Lisa Wong </span>
                                                <span class="time">Just Now </span>
                                                </span>
                                                <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                        <span class="from"> Richard Doe </span>
                                                <span class="time">16 mins </span>
                                                </span>
                                                <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar1.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                        <span class="from"> Bob Nilson </span>
                                                <span class="time">2 hrs </span>
                                                </span>
                                                <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                        <span class="from"> Lisa Wong </span>
                                                <span class="time">40 mins </span>
                                                </span>
                                                <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                        <span class="from"> Richard Doe </span>
                                                <span class="time">46 mins </span>
                                                </span>
                                                <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
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