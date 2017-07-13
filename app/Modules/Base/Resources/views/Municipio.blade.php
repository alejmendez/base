@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['Municipio']])
    
    @include('base::partials.modal-busqueda', [
        'titulo' => 'Buscar Municipio.',
        'columnas' => [
            'Estados' => '50',
		'Nombre' => '50'
        ]
    ])
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]) !!}
            {!! $Municipio->generate() !!}
        {!! Form::close() !!}
    </div>
@endsection