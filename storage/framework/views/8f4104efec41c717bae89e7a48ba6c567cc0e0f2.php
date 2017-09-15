<div id="botonera">
	<div class="msj-botonera bg-red bg-font-red text-left"></div>
	<div class="btn-group btn-group-solid">
		<button id="limpiar" class="btn default tooltips" data-container="body" data-placement="top" data-original-title="<?php echo e(Lang::get('backend.btn_group.clean.title')); ?>">
			<i class="fa fa-file-o" aria-hidden="true"></i>
			<span class="visible-lg-inline visible-md-inline"><?php echo e(Lang::get('backend.btn_group.clean.btn')); ?></span>
		</button>

		<button id="guardar" class="btn blue tooltips" data-container="body" data-placement="top" data-original-title="<?php echo e(Lang::get('backend.btn_group.save.title')); ?>">
			<i class="fa fa-floppy-o" aria-hidden="true"></i>
			<span class="visible-lg-inline visible-md-inline"><?php echo e(Lang::get('backend.btn_group.save.btn')); ?></span>
		</button>

		<button id="eliminar" class="btn red tooltips" data-container="body" data-placement="top" data-original-title="<?php echo e(Lang::get('backend.btn_group.remove.title')); ?>">
			<i class="fa fa-trash" aria-hidden="true"></i>
			<span class="visible-lg-inline visible-md-inline"><?php echo e(Lang::get('backend.btn_group.remove.btn')); ?></span>
		</button>

		<?php if($controller->permisologia($controller->ruta() . '/restaurar')): ?>
		<button id="restaurar" class="btn blue tooltips" data-container="body" data-placement="top" data-original-title="<?php echo e(Lang::get('backend.btn_group.restore.title')); ?>">
			<i class="fa fa-heart" aria-hidden="true"></i>
			<span class="visible-lg-inline visible-md-inline"><?php echo e(Lang::get('backend.btn_group.restore.btn')); ?></span>
		</button>
		<?php endif; ?>
		
		<?php if($controller->permisologia($controller->ruta() . '/destruir')): ?>
		<button id="destruir" class="btn red tooltips" data-container="body" data-placement="top" data-original-title="<?php echo e(Lang::get('backend.btn_group.forceDelete.title')); ?>">
			<i class="fa fa-bomb" aria-hidden="true"></i>
			<span class="visible-lg-inline visible-md-inline"><?php echo e(Lang::get('backend.btn_group.forceDelete.btn')); ?></span>
		</button>
		<?php endif; ?>

		<button id="buscar" class="btn green tooltips" data-container="body" data-placement="top" data-original-title="<?php echo e(Lang::get('backend.btn_group.search.title')); ?>">
			<i class="fa fa-search" aria-hidden="true"></i>
			<span class="visible-lg-inline visible-md-inline"><?php echo e(Lang::get('backend.btn_group.search.btn')); ?></span>
		</button>
		<?php echo $__env->yieldPushContent('botones'); ?>
	</div>
</div>