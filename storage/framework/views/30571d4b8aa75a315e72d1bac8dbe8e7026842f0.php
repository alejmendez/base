<?php $__env->startSection('content'); ?>

<div class="row center-xs">
  <div class="col-md-3 col-xs-10 col-sm-5 tecnicos">
    <div class="card">
      <div class="inside-card">
        <div class="profile-userpic img-center">
          <img src="<?php echo e(url('public/img/usuarios/user.png')); ?>" class="img-responsive img-profile img-center" OnmouseOver='return Mostrar1();' alt="Foto de Perfil del usuario">
        </div>
        <div class="profile-usertitle profile-text-tecnico">
          <p>Nombre del tecnico</p>
          <p>Tipo de tecnico</p>
          <input type="hidden"  id="id" name="id">
        </div>
        <div class="tecnico-inf-txt">
          <h4 class="">Información Usuario</h4>
          <span class=""> Cargo del Usuario </span>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('base::layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>