@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['Estados']])
    
    @include('base::partials.modal-busqueda', [
        'titulo' => 'Buscar Estados.',
        'columnas' => [
            'Nombre' => '50',
		'Iso 3166-2' => '50'
        ]
    ])
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]) !!}
            {!! $Estados->generate() !!}
            
        {!! Form::close() !!}
    </div>
@endsection