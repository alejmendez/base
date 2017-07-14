@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['Tipo Persona']])
    
    @include('base::partials.modal-busqueda', [
        'titulo' => 'Buscar TipoPersona.',
        'columnas' => [
            'Nombre' => '100'
        ]
    ])
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]) !!}
            {!! $TipoPersona->generate() !!}
        {!! Form::close() !!}
    </div>
@endsection