<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('base::partials.botonera', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('base::partials.ubicacion', ['ubicacion' => ['Perfil de Usuario']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <?php echo $__env->make('base::partials.modal-busqueda', [
    'titulo' => 'Buscar Usuarios.',
    'columnas' => [
      'nombre'          => '20',
      'descripcion'     => '20',
      'usuario'  => '20',
      'perfil'   => '20',
      'estatus'  => '20',
    ]
  ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
    <div class="row">
      <form id="formulario" name="formulario" enctype="multipart/form-data" role="form" autocomplete="off">
      <input id="archivos" name="archivos" type="hidden" />

          <?php echo e(Form::bsText('nombre', '', [
            'label'     => 'Nombre',
            'placeholder'   => 'Nombre del usuario',
            'required'    => 'required',
            'class_cont'  => 'col-sm-12'
          ])); ?>


          <?php echo e(Form::bsText('descripcion', '', [
            'label'     => 'Descripcion',
            'placeholder'   => 'Descripcion del usuario',
            'class_cont'  => 'col-sm-12'
          ])); ?>


          <?php echo e(Form::bsText('correo', '', [
            'label'     => 'Correo',
            'placeholder'   => 'Correo del usuario',
            'class_cont'  => 'col-sm-12'
          ])); ?>



            <div style="margin-bottom: 15px; margin-left: 13px;" >
            <label>Modulo</label>
              <select class="form-control" id="modulo" name="modulo">
          <?php $__currentLoopData = $modulo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key->name); ?>"><?php echo e($key->name); ?></option>                                                        
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

          <!-- <?php echo e(Form::bsSelect('app_usuario_id',$controller->usuario(), '', [
                  'label'     => 'Usuario',
                  'class_cont'  => 'col-sm-12'
          ])); ?>



          <?php echo e(Form::bsSelect('app_perfil_id',$controller->perfil(), '', [
                  'label'     => 'Perfil',
                  'class_cont'  => 'col-sm-12'
          ])); ?>



          <?php echo e(Form::bsSelect('estatus_id',$controller->estatus(), '', [
                  'label'     => 'Estatus',
                  'class_cont'  => 'col-sm-12'
          ])); ?> -->
    </form>  
    <form id="fileupload" action="" method="POST" enctype="multipart/form-data">

          <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
              <span class="btn btn-success fileinput-button">
                <i class="fa fa-plus"></i>
                <span>Agregar Archivos...</span>
                <input type="file" name="files[]" multiple>
              </span>
              <button type="submit" class="btn btn-primary start">
                <i class="fa fa-upload"></i>
                <span>Iniciar Carga</span>
              </button>
              <button type="reset" class="btn btn-warning cancel">
                <i class="fa fa-times-circle"></i>
                <span>Cancelar Carga</span>
              </button>
              <button type="button" class="btn btn-danger delete">
                <i class="fa fa-trash"></i>
                <span>Eliminar</span>
              </button>
              <input type="checkbox" class="toggle">
              <span class="fileupload-process"></span>
            </div>
            <div class="col-lg-5 fileupload-progress fade">
              <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
              </div>
              <div class="progress-extended">&nbsp;</div>
            </div>
          </div>
          <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
  <!-- The template to display files available for upload -->
  <script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
      <tr data-id="{%=file.id%}" class="template-upload fade">
        <td style="width: 120px;">
          <span class="preview"></span>
        </td>
        <td style="width: 300px;">
          <p class="name">{%=file.name%}</p>
          <strong class="error text-danger"></strong>
        </td>
        <td>
          <p class="size">Procesando...</p>
          <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
          </div>
        </td>
        <td style="width: 240px;">
          {% if (!i && !o.options.autoUpload) { %}
            <button class="btn btn-primary start" disabled>
              <i class="fa fa-upload"></i>
              <span>Iniciar</span>
            </button>
          {% } %}
          {% if (!i) { %}
            <button class="btn btn-warning cancel">
              <i class="fa fa-times-circle"></i>
              <span>Cancelar</span>
            </button>
          {% } %}
        </td>
      </tr>
    {% } %}
  </script>
  <!-- The template to display files available for download -->
  <script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
      <tr data-id="{%=file.id%}" class="template-download fade">
        <td style="width: 120px;">
          <span class="preview">
            {% if (file.thumbnailUrl) { %}
              <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}">
              <img width="85px" height="60px" src="{%=file.thumbnailUrl%}"></a>
            {% } %}
          </span>
        </td>
        <td colspan="2">
          <p>
            <b>Leyenda:</b> <span class="leyenda">{%=file.data.leyenda%}</span>
          </p>
          {% if (file.error) { %}
            <div><span class="label label-danger">Error</span> {%=file.error%}</div>
          {% } %}
        </td>
        <td style="width: 240px;">
          {% if (file.deleteUrl) { %}
            <button class="btn btn-info" data-url="{%=file.url%}">
              <i class="fa fa-pencil"></i>
              <span>Editar</span>
            </button>
            <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
              <i class="fa fa-trash"></i>
              <span>Eliminar</span>
            </button>
            <input type="checkbox" name="delete" value="1" class="toggle">
          {% } else { %}
            <button class="btn btn-warning cancel">
              <i class="fa fa-times-circle"></i>
              <span>Cancelar</span>
            </button>
          {% } %}
        </td>
      </tr>
    {% } %}
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('base::layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>