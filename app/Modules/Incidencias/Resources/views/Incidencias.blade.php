@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    @include('base::partials.ubicacion', ['ubicacion' => ['Incidencias']])
     
@endsection

@section('content')
   <div class="row">
      <form id="formulario" name="formulario" enctype="multipart/form-data" role="form" autocomplete="off">
      <input id="archivos" name="archivos" type="hidden" />

        {{ Form::bsText('titulo', '', [
            'label'     => 'Titulo',
            'placeholder'   => 'Titulo del usuario',
            'required'    => 'required',
        ]) }}

        {{ Form::bsText('correo', '', [
            'label'     => 'Correo',
            'placeholder'   => 'Correo del usuario',
           
        ]) }}
           
        {{ Form::bsSelect('modulo', $controller->modulo(), '', [
            'label' => 'Modulo',
            'required' => 'required'
        ]) }}

        {{ Form::bsText('descripcion', '', [
            'label'     => 'Descripcion',
            'placeholder'   => 'Descripcion del usuario',
            
        ]) }}
        
    </form>  
    <hr/>
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
@endsection
@push('js')
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
@endpush
