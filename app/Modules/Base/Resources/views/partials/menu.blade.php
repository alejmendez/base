	<div class="page-header-menu">
		<div class="container-fluid">
			<div class="hor-menu">
				<ul class="nav navbar-nav">
					{!! \App\Modules\Base\Models\Menu::generar_menu($controller->app) !!}
				</ul>
			</div>
		</div>
	</div>