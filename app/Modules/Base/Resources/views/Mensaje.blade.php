@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['Mensaje']])
    
    @include('base::partials.modal-busqueda', [
        'titulo' => 'Buscar Mensaje.',
        'columnas' => [
            'Mensaje' => '100'
        ]
    ])
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]) !!}
            {!! $Mensaje->generate() !!}
        {!! Form::close() !!}
    </div>
@endsection