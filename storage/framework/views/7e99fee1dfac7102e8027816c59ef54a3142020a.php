	<ul class="page-breadcrumb breadcrumb">
		<li>
			<a href="<?php echo e(url('/')); ?>">Inicio</a><i class="fa fa-circle"></i>
		</li>
		<?php $__currentLoopData = $ubicacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li>
			<span><?php echo e($ubi); ?> 
			<?php if(!$loop->last): ?>
			<i class="fa fa-circle"></i>
			<?php endif; ?>
			</span>
		</li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>