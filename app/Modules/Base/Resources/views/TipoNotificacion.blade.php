@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['Tipo Notificacion']])
    
    @include('base::partials.modal-busqueda', [
        'titulo' => 'Buscar TipoNotificacion.',
        'columnas' => [
            'Nombre' => '50',
		'Ruta' => '50'
        ]
    ])
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]) !!}
            {!! $TipoNotificacion->generate() !!}
        {!! Form::close() !!}
    </div>
@endsection