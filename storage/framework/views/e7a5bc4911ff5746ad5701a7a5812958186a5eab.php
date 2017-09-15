<?php $__env->startSection('content-top'); ?>
    <?php echo $__env->make('base::partials.botonera', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->make('base::partials.ubicacion', ['ubicacion' => ['Estatus']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->make('base::partials.modal-busqueda', [
        'titulo' => 'Buscar Estatus.',
        'columnas' => [
            'Nombre' => '100'
        ]
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php echo Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]); ?>

            <?php echo $Estatus->generate(); ?>

        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(isset($layouts) ? $layouts : 'base::layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>