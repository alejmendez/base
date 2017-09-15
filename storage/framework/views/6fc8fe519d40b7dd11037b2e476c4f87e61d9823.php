	<script type="text/javascript">
		var $url = "<?php echo e(URL::current()); ?>/",
		sessionLife = <?php echo e(\Config::get('session.lifetime')); ?>;
	</script>
	
<?php if(isset($html['js'])): ?>
<?php $__currentLoopData = $html['js']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $js): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<script type="text/javascript" src="<?php echo e(url($js)); ?>?v=<?php echo e(env('APP_VERSION')); ?>"></script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

	<?php echo $__env->yieldPushContent('js'); ?>