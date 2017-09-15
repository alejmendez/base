@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top')
    @include('base::partials.botonera')
    
    @include('base::partials.ubicacion', ['ubicacion' => ['Ciudades']])
    
    @include('base::partials.modal-busqueda', [
        'titulo' => 'Buscar Ciudades.',
        'columnas' => [
            'Estado' => '50',
		    'Nombre' => '50',	
        ]
    ])
@endsection

@section('content')
    <div class="row">
        {!! Form::open(['id' => 'formulario', 'name' => 'formulario', 'method' => 'POST' ]) !!}
            {!! $Ciudades->generate() !!}
            {{ Form::bsSelect('capital', [
                    0 => 'No',
                    1 => 'Si'
                ], 'n', [
                'label' => 'capital',
                'class_cont' => 'col-md-4 col-sm-6 col-xs-12'
            ]) }}
        {!! Form::close() !!}
    </div>
@endsection