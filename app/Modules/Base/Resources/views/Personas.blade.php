@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['Personas']])
    
    @include('base::partials.modal-busqueda', [
        'titulo' => 'Buscar Personas.',
        'columnas' => [
          'Tipo Persona' => '33.333333333333',
		  'Dni' => '33.333333333333',
		  'Nombres' => '33.333333333333'
        ]
    ])
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]) !!}
            <div class="profile-sidebar col-md-3" style="margin-bottom: 35px;">
                <div class="portlet light profile-sidebar-portlet ">
                    <div class="mt-element-overlay">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mt-overlay-6">
                                    <img  id="foto" src="{{ url('public/img/usuarios/user.png') }}" class="img-responsive" alt="">
                                    <div class="mt-overlay">
                                        <h2> </h2>
                                        <p>
                                            <input id="upload" name="foto" type="file" />
                                            <a href="#" id="upload_link" class="mt-info uppercase btn default btn-outline">
                                                <i class="fa fa-camera"></i>
                                            </a>
                                        </p>
                                    </div>
                                    <h4 style="color:#fff;font-weight:bold;">Imagen de perfil</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                </div>
            </div>

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
                                        <a href="#tab_1_2" data-toggle="tab">Datos Generales</a>
                                    </li>
                                     
                                    <li>
                                        <a href="#tab_1_3" data-toggle="tab">Direccion</a>
                                    </li> 
                                    <li>
                                        <a href="#tab_1_4" data-toggle="tab">Cuentas Bancarias</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_5" data-toggle="tab">Datos Contacto</a>
                                    </li>
                                    
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1">
                                       {!! $Personas->generate() !!}
                                    </div>

                                    <div class="tab-pane " id="tab_1_2">
                                      {!! $Personas_detalles->generate() !!}
                                    </div>
                                    <div class="tab-pane" id="tab_1_3">
                                      {!! $Personas_direccion->generate() !!}
                                    </div>
                                    <div class="tab-pane" id="tab_1_4">
                                        <div class="col-md-12">
                                            <div class="msj-botonera bg-red bg-font-red text-left"></div>
                                            <div class="btn-group btn-group-solid" style="float: right;" >
                                                <button id="agregar" type="button" class="btn green tooltips" data-container="body" data-placement="top">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                    <span class="visible-lg-inline visible-md-inline"></span>
                                                </button>
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
                                                    <div>
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
                                                    <div id="">
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
            </div>
            
        
        {!! Form::close() !!}
    </div>
@endsection
@push('js')
<script>
var id = {{ is_null($Personas->id) ? 0 : $Personas->id }};
</script>

{{-- telefonos --}}
<script type="text/x-tmpl" id="tmpl-demo3">
    {% for (var i=0, file; file=o.datos[i]; i++) { %}
        <input type="hidden" name="id_telefonos[]" value="{%=file.id%}">
        
        <div class="form-group col-md-3 cont-persona">
            <label for="nombres">tipo de telefono:</label>
            <div class="form-group multiple-form-group input-group">
                <div class="input-group-btn input-group-select">
                    <select class="form-control" name="tipo_telefono[]" required="">
                        <option value="">seleccione ..</option>
                        @foreach($controller->tipotelefono() as $id => $tipo)
                            <option value="{{ $id }}" {% if (file.tipo_telefono_id == {{ $id }}) { %} selected="selected" {% } %}>
                                {{ $tipo }}
                            </option>
                        @endforeach
                    </select> 
                </div>
             </div>
        </div>


        {{ Form::bsText('numero', '{%=file.numero%}', [
            'label'         => 'Número de Telefonos',
            'placeholder'   => 'Número de Telefonos',
            'name'          => 'numero[]',
            'required'      => 'required',
            'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
        ]) }}

        <div class="form-group col-md-3 cont-persona">
            <label for="nombres">Principal:</label>
            <div class="form-group multiple-form-group input-group">
                <div class="input-group-btn input-group-select">
                    <select class="form-control" name="principal_tlf[]" required="">
                        <option value="">seleccione ..</option>
                        @foreach($controller->principal() as $id => $tipo)
                            <option value="{{ $id }}" {% if (file.principal == {{ $id }}) { %} selected="selected" {% } %}>
                                {{ $tipo }}
                            </option>
                        @endforeach
                    </select> 
                </div>
             </div>
        </div>

    <div class="col-md-12"></div>
    {% } %}
</script>
<script type="text/x-tmpl" id="tmpl-demo4">
    <input type="hidden" name="id_telefonos[]" value="0">
    <div class="form-group col-md-3 cont-persona">
            <label for="nombres">tipo de telefono:</label>
            <div class="form-group multiple-form-group input-group">
                <div class="input-group-btn input-group-select">
                    <select class="form-control" name="tipo_telefono[]" required="">
                        <option value="">seleccione ..</option>
                        @foreach($controller->tipotelefono() as $id => $tipo)
                            <option value="{{ $id }}" >
                                {{ $tipo }}
                            </option>
                        @endforeach
                    </select> 
                </div>
             </div>
        </div>
    {{ Form::bsText('numero', '', [
        'label'         => 'Número de Telefonos',
        'placeholder'   => 'Número de Telefonos',
        'name'          => 'numero[]',
        'required'      => 'required',
        'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
    ]) }}
    <div class="form-group col-md-3 cont-persona">
        <label for="nombres">Principal:</label>
        <div class="form-group multiple-form-group input-group">
            <div class="input-group-btn input-group-select">
                <select class="form-control" name="principal_tlf[]" required="">
                    <option value="">seleccione ..</option>
                    @foreach($controller->principal() as $id => $tipo)
                        <option value="{{ $id }}" >
                            {{ $tipo }}
                        </option>
                    @endforeach
                </select> 
            </div>
         </div>
    </div>

    <div class="col-md-12"></div>
</script>
{{-- Correos --}}
<script type="text/x-tmpl" id="tmpl-demo5">
    {% for (var i=0, file; file=o.datos[i]; i++) { %}
        <input type="hidden" name="id_correo[]" value="{%=file.id%}">
       {{ Form::bsText('correo', '{%=file.correo%}', [
        'label'         => 'Correo',
        'placeholder'   => 'Correo',
        'name'          => 'correo[]',
        'required'      => 'required',
        'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
        ]) }}
       <div class="form-group col-md-3 cont-persona">
            <label for="nombres">Principal:</label>
            <div class="form-group multiple-form-group input-group">
                <div class="input-group-btn input-group-select">
                    <select class="form-control" name="principal_correo[]" required="">
                        <option value="">seleccione ..</option>
                        @foreach($controller->principal() as $id => $tipo)
                            <option value="{{ $id }}" {% if (file.principal == {{ $id }}) { %} selected="selected" {% } %}>
                                {{ $tipo }}
                            </option>
                        @endforeach
                    </select> 
                </div>
             </div>
        </div>

        <div class="col-md-12"></div>
    {% } %}
</script>
<script type="text/x-tmpl" id="tmpl-demo6">
    <input type="hidden" name="id_correo[]" value="0">
    {{ Form::bsText('correo', '', [
        'label'         => 'Correo',
        'placeholder'   => 'Correo',
        'name'          => 'correo[]',
        'required'      => 'required',
        'class_cont'    => 'col-md-4 col-sm-6 col-xs-12'
    ]) }} 

    <div class="form-group col-md-3 cont-persona">
        <label for="nombres">Principal:</label>
        <div class="form-group multiple-form-group input-group">
            <div class="input-group-btn input-group-select">
                <select class="form-control" name="principal_correo[]" required="">
                    <option value="">seleccione ..</option>
                    @foreach($controller->principal() as $id => $tipo)
                        <option value="{{ $id }}" >
                            {{ $tipo }}
                        </option>
                    @endforeach
                </select> 
            </div>
         </div>
    </div>

    <div class="col-md-12"></div>
</script>
@endpush