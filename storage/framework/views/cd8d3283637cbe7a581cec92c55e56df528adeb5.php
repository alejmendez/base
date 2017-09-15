<?php $__env->startSection('content-top'); ?> 
    <?php echo $__env->make('base::partials.ubicacion', ['ubicacion' => ['Notificaciones']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Notificaciones</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="tabla3" class="table table-striped table-hover table-bordered tables-text">
                        <thead>
                            <tr>
                                <th style="width: 20%; text-align: center;">Fecha</th>
                                <th style="width: 80%; text-align: center;">Notificacion</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make(isset($layouts) ? $layouts : 'base::layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>