<div id="<?php echo e(isset($id) ? $id : 'modalTablaBusqueda'); ?>" class="modal modal-busqueda fade" tabindex="-1" role="dialog">
	<div class="modal-dialog container">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title"><?php echo e(isset($titulo) ? $titulo : 'Buscar'); ?>


				<div class="btn-group btn-datatable">
					<button type="button" class="btn btn-primary dropdown-toggle btn-sm" aria-haspopup="true" aria-expanded="false">
						Acciones <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php if($controller->permisologia($controller->ruta() . '/restaurar') || $controller->permisologia($controller->ruta() . '/destruir')): ?>
							<li class="dropdown-header">Registros Eliminados</li>

							<li data-re="1">
								<a href="#">
									<i class="fa fa-eye" aria-hidden="true"></i> 
									Ver Registros Eliminados 
									<i class="check" aria-hidden="true"></i>
								</a>
							</li>

							<li data-sre="1">
								<a href="#">
									<i class="fa fa-eye" aria-hidden="true"></i> 
									Ver Solo Registros Eliminados 
									<i class="check" aria-hidden="true"></i>
								</a>
							</li>
							
							<li role="separator" class="divider"></li>
						<?php endif; ?>
						<li data-vfc="1">
							<a href="#">
								<i class="fa fa-search" aria-hidden="true"></i> 
								Ver filtros por Comluna
								<i class="fa fa-check check" aria-hidden="true"></i>
							</a>
						</li>
						
						<li role="separator" class="divider"></li>

						<li class="dropdown-header">Visualizar Columnas</li>
						<?php $__currentLoopData = $columnas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columna => $ancho): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li data-column="<?php echo e($loop->iteration - 1); ?>">
							<a href="#">
								<?php echo e($columna); ?>

								<i class="fa fa-check check" aria-hidden="true"></i>
							</a>
						</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
				</h4>
			</div>
			<div class="modal-body">
				<?php echo $__env->yieldPushContent('filtroDatatable'); ?>
				<table id="<?php echo e(isset($idTabla) ? $idTabla : 'tabla'); ?>" class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<?php $__currentLoopData = $columnas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columna => $ancho): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<th style="width: <?php echo e($ancho); ?>%;"><?php echo e($columna); ?></th>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tr>
					</thead>
					<tbody></tbody>
					<tfoot>
						<tr>
							<?php $__currentLoopData = $columnas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columna => $ancho): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<th style="width: <?php echo e($ancho); ?>%;"><?php echo e($columna); ?></th>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tr>
					</tfoot>
				</table>
			</div>
			<!--<div class="modal-footer">
				<button type="button" class="btn blue" data-dismiss="modal">Cerrar</button>
			</div>-->
		</div>
	</div>
</div>