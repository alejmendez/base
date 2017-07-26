@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['Parroquia']])
    
    @include('base::partials.modal-busqueda', [
        'titulo' => 'Buscar Parroquia.',
        'columnas' => [
            'Nombre' => '50',
		'Municipio' => '50'
        ]
    ])
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]) !!}
            {!! $Parroquia->generate() !!}
        {!! Form::close() !!}
    </div>
@endsection