<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-md-2"><!--AQUI VA LO DEL LADO IZQ-->
      <div class="profile-userpic img-center center-xs">
          <img id="foto" src="<?php echo e(url('public/img/usuarios/' . (is_file('public/img/usuarios/' . $usuario->foto) ? $usuario->foto : 'user.png'))); ?>" class="img-responsive img-profile img-center" alt="" />
      </div>
      <div class="profile-usertitle profile-text-tecnico">
          <p><?php echo e(\Auth::user()->usuario); ?></p>
      </div>
      <div class="tecnico-inf-txt">
          <h4 class="">Información Usuario</h4>
          <span class=""> </span>
      </div>
      <div class="profile-usermenu">
        <ul class="nav">
          <li class="">
            <a href="#">
              <i class="icon-home "></i> Incidencias 
            </a>
          </li>
          <li>
            <a href="incidencias/tecnicos">
              <i class="icon-settings "></i> Tecnicos
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-md-10" >
      <div class="row casos"><!--AQUI VA LO DEL LADO der Arriba-->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="dashboard-stat red">
            <div class="visual">
                <i class="fa fa-folder-open"></i>
            </div>
            <div class="details">
                <div class="number"> <?php echo e($usuario_nuevo); ?> </div>
                <div class="desc"> Casos Nuevos </div>
            </div>
          </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="dashboard-stat blue">
            <div class="visual">
                <i class="fa fa-gear fa-spin"></i>
            </div>
            <div class="details">
                <div class="number"> <?php echo e($usuario_procesado); ?> </div>
                <div class="desc"> Casos en Proceso </div>
            </div>
          </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="dashboard-stat green">
            <div class="visual">
                <i class="fa fa-thumbs-o-up"></i>
            </div>
            <div class="details">
                <div class="number"> <?php echo e($usuario_resuelto); ?></div>
                <div class="desc"> Casos Resueltos </div>
            </div>
          </div>
          </div>
      </div>
      <div class="row"><!--AQUI VA LO DEL LADO der Abajo-->
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-globe theme-font hide"></i>
                    <span class="caption-subject font-blue-madison bold uppercase">Lista de incidencias</span>
                </div>
                <div class="btn-group pull-right">
                    <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Herramientas
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-print"></i> Print </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                        <tr>
                            <th>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                    <span></span>
                                </label>
                            </th>
                            <th> ID # </th>
                            <th> Nombre de falla </th>
                            <th> Descripcion </th>
                            <th> Correo  </th>
                            <th> Fecha </th>
                            <th> Asignado a </th>
                            <th> Estado </th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php $__currentLoopData = $consulta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="odd gradeX">
                            <td>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" class="checkboxes" value="1" />
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <a href="id_ticket:view_details"><?php echo e($consul['id']); ?></a>
                            </td>
                            <td>
                                <a href="<?php echo e(url('/incidencias/especifico/especifico/'.$consul['id'])); ?>"><?php echo e($consul['nombre']); ?></a>
                            </td>
                            <td> <a href="mailto:correo@reportador.com"> <?php echo e($consul['descripcion']); ?> </a></td>
                            <td>
                                <a href="mailto:correo@reportador.com"> <?php echo e($consul['correo']); ?> </a>
                            </td>
                            <td class="center"> <?php echo e($consul['fecha']); ?> </td>
                            <td> Por Asignar </td>
                            <td>
                                <span class="label label-sm label-warning"> <?php echo e($consul['estatus']); ?>  </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('base::layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>