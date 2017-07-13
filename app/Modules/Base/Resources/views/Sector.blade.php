@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['Sector']])
    
    @include('base::partials.modal-busqueda', [
        'titulo' => 'Buscar Sector.',
        'columnas' => [
            'Nombre' => '50',
		
		      'Parroquia' => '50'
        ]
    ])
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]) !!}
            {!! $Sector->generate() !!}
        {!! Form::close() !!}
    </div>
@endsection