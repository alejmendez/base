@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['Profesion']])
    
    @include('base::partials.modal-busqueda', [
        'titulo' => 'Buscar Profesion.',
        'columnas' => [
            'Nombre' => '100',
		
        ]
    ])
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]) !!}
            {!! $Profesion->generate() !!}
        {!! Form::close() !!}
    </div>
@endsection