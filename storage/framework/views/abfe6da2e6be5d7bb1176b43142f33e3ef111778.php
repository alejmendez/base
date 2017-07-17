<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('base::partials.ubicacion', ['ubicacion' => ['Perfil de Usuario']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="row">
		<div class="profile-sidebar col-md-3">
			<div class="portlet light profile-sidebar-portlet">
				<div class="mt-element-overlay">
					<div class="col-md-12">
						<div class="mt-overlay-6">
							<img id="foto" src="<?php echo e(url('public/img/usuarios/' . (is_file('public/img/usuarios/' . $usuario->personas->foto) ? $usuario->personas->foto : 'user.png'))); ?>" class="img-responsive" alt="" />
							<div class="mt-overlay">
								<h2> </h2>
								<p>
									<form id="formulario_imagen" enctype="multipart/form-data"  autocomplete="off">
										<input id="upload" name="foto" type="file"/>
										<a href="#" id="upload_link" class="mt-info uppercase btn default btn-outline">Cargar Foto de Perfil</a>
									</form>
								</p>
							 </div>
						</div>
					</div>
				</div>

				<div class="profile-usertitle">
					<div class="profile-usertitle-name"> <?php echo e($usuario->nombre); ?> <span id="ape"> </span> </div>
					<div class="profile-usertitle-job"> <?php echo e($usuario->usuario); ?> </div>
				</div>
				<br />
			</div>
		</div>
		<form id="formulario" name="formulario" method="POST" autocomplete="off">
			 <div class="col-md-9">
	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="portlet light ">
	                            <div class="portlet-title tabbable-line">
	                                <div class="caption caption-md">
	                                    <i class="icon-globe theme-font hide"></i>
	                                    <span class="caption-subject font-blue-madison bold uppercase">Persona</span>
	                                </div>
	                                <ul class="nav nav-tabs">
	                                    <li class="active">
	                                        <a href="#tab_1_1" data-toggle="tab">Persona</a>
	                                    </li>
	                                    <li class="datos_generales">
	                                        <a href="#tab_1_2" data-toggle="tab" >Datos Generales</a>
	                                    </li>
	                                     
	                                    <li>
	                                        <a href="#tab_1_3" data-toggle="tab">Direccion</a>
	                                    </li> 
	                                    <li>
	                                        <a href="#tab_1_5" data-toggle="tab">Datos Contacto</a>
	                                    </li>
	                                    
	                                </ul>
	                            </div>
	                            <div class="portlet-body">
	                                <div class="tab-content">
	                                    <div class="tab-pane active" id="tab_1_1">
	                                       <?php echo $Personas->generate(); ?>

	                                    </div>

	                                    <div class="tab-pane " id="tab_1_2">
	                                      <?php echo $Personas_detalles->generate(); ?>

	                                    </div>
	                                    <div class="tab-pane" id="tab_1_3">
	                                      <?php echo $Personas_direccion->generate(); ?>

	                                    </div>
	                                    <div class="tab-pane" id="tab_1_4">
	                                        <div class="col-md-12"> 
	                                            <div id="botonera">
	                                                <div class="msj-botonera bg-red bg-font-red text-left"></div>
	                                                <div class="btn-group btn-group-solid">
	                                                    
	                                                    <button id="agregar"  type="button" class="btn green tooltips" data-container="body" data-placement="top">
	                                                        <i class="fa fa-plus" aria-hidden="true"></i>
	                                                        <span class="visible-lg-inline visible-md-inline"></span>
	                                                    </button>
	                                                
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div id="cuentas"></div>
	                                    </div>
	                                     <div class="tab-pane" id="tab_1_5">
	                                        <div class="panel panel-default">
	                                            <div class="panel-heading">
	                                                <h3 class="panel-title"><center>Telefonos</center></h3>
	                                            </div>
	                                            <div class="panel-body">
	                                                <div class="col-md-12"> 
	                                                    <div id="botonera">
	                                                        <div class="msj-botonera bg-red bg-font-red text-left"></div>
	                                                        <div class="btn-group btn-group-solid">
	                                                            
	                                                            <button id="agregar_telefonos"  type="button" class="btn green tooltips" data-container="body" data-placement="top">
	                                                                <i class="fa fa-plus" aria-hidden="true"></i>
	                                                                <span class="visible-lg-inline visible-md-inline"></span>
	                                                            </button>
	                                                        
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            <div id="telefonos"></div>
	                                            </div>
	                                        </div>

	                                        <div class="panel panel-default">
	                                            <div class="panel-heading">
	                                                <h3 class="panel-title"><center>Correos</center></h3>
	                                            </div>
	                                            <div class="panel-body">
	                                                <div class="col-md-12"> 
	                                                    <div id="botonera">
	                                                        <div class="msj-botonera bg-red bg-font-red text-left"></div>
	                                                        <div class="btn-group btn-group-solid">
	                                                            
	                                                            <button id="agregar_correos"  type="button" class="btn green tooltips" data-container="body" data-placement="top">
	                                                                <i class="fa fa-plus" aria-hidden="true"></i>
	                                                                <span class="visible-lg-inline visible-md-inline"></span>
	                                                            </button>
	                                                        
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            <div id="correos"></div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <center>
	         	<button type="button"  id="guardar"class="btn btn-primary">Guardar</button>
	         </center>
	         </div>
	         
        </form>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<style type="text/css">
	#upload_link{
	text-decoration:none;
	}
	#upload{
	display:none
	}
	.mt-element-overlay .mt-overlay-6 {
		background: #003f8c none repeat scroll 0 0;
	}
	.mt-overlay-6 img{
		min-height: 250px;
	}
	.tab-content{
		overflow: hidden;
	}

</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>


<script type="text/x-tmpl" id="tmpl-demo3">
    {% for (var i=0, file; file=o.datos[i]; i++) { %}
        <input type="hidden" name="id_telefonos[]" value="{%=file.id%}">
       <?php echo e(Form::bsSelect('tipo_telefono', $controller->tipotelefono(), '{%=intval(file.tipo_telefono_id)%}', [
        'label'         => 'tipo de telefono',
        'placeholder'   => 'tipo de telefono',
        'name'          => 'tipo_telefono[]',
        'required'      => 'required',
        'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
    ])); ?>

    <?php echo e(Form::bsText('numero', '{%=file.numero%}', [
        'label'         => 'N&uacute;mero de Telefonos',
        'placeholder'   => 'N&uacute;mero de Telefonos',
        'name'          => 'numero[]',
        'required'      => 'required',
        'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
    ])); ?>

    <?php echo e(Form::bsSelect('Principal_tlf',[
         1=>'Si',
         0=> 'No'
        ], '{%=file.principal%}', [
        'label'         => 'Principal',
        'placeholder'   => 'Principal',
        'name'          => 'principal_tlf[]',
        'required'      => 'required',
        'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
    ])); ?>

    <div class="col-md-12"></div>
    {% } %}
</script>
<script type="text/x-tmpl" id="tmpl-demo4">
    <input type="hidden" name="id_telefonos[]" value="0">
    <?php echo e(Form::bsSelect('tipo_telefono', $controller->tipotelefono(), '', [
        'label'         => 'tipo de telefono',
        'placeholder'   => 'tipo de telefono',
        'name'          => 'tipo_telefono[]',
        'required'      => 'required',
        'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
    ])); ?>

    <?php echo e(Form::bsText('numero', '', [
        'label'         => 'N&uacute;mero de Telefonos',
        'placeholder'   => 'N&uacute;mero de Telefonos',
        'name'          => 'numero[]',
        'required'      => 'required',
        'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
    ])); ?>

    <?php echo e(Form::bsSelect('Principal',[
         1=>'Si',
         0=> 'No'
        ], '', [
        'label'         => 'Principal',
        'placeholder'   => 'Principal',
        'name'          => 'principal_tlf[]',
        'required'      => 'required',
        'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
    ])); ?>

    <div class="col-md-12"></div>
</script>

<script type="text/x-tmpl" id="tmpl-demo5">
    {% for (var i=0, file; file=o.datos[i]; i++) { %}
        <input type="hidden" name="id_correo[]" value="{%=file.id%}">
       <?php echo e(Form::bsText('correo', '{%=file.correo%}', [
        'label'         => 'Correo',
        'placeholder'   => 'Correo',
        'name'          => 'correo[]',
        'required'      => 'required',
        'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
        ])); ?>

       <?php echo e(Form::bsSelect('Principal',[
         1=>'Si',
         0=> 'No'
        ], '{%=file.principal%}', [
        'label'         => 'Principal',
        'placeholder'   => 'Principal',
        'name'          => 'principal_correo[]',
        'required'      => 'required',
        'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
         ])); ?>

         <div class="col-md-12"></div>
    {% } %}
</script>
<script type="text/x-tmpl" id="tmpl-demo6">
    <input type="hidden" name="id_correo[]" value="0">
    <?php echo e(Form::bsText('correo', '', [
        'label'         => 'Correo',
        'placeholder'   => 'Correo',
        'name'          => 'correo[]',
        'required'      => 'required',
        'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
    ])); ?> 
    <?php echo e(Form::bsSelect('Principal',[
         1=>'Si',
         0=> 'No'
        ], '', [
        'label'         => 'Principal',
        'placeholder'   => 'Principal',
        'name'          => 'principal_correo[]',
        'required'      => 'required',
        'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
    ])); ?>

    <div class="col-md-12"></div>
</script>
<script  type="text/javascript">
	var $id = '<?php echo e($usuario->personas_id); ?>';
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('base::layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>