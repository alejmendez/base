@extends(isset($layouts) ? $layouts : 'base::layouts.default')

@section('content-top') 
    @include('base::partials.ubicacion', ['ubicacion' => ['Notificaciones']]) 
@endsection

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Notificaciones</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="tabla3" class="table table-striped table-hover table-bordered tables-text">
                        <thead>
                            <tr>
                                <th style="width: 20%; text-align: center;">Fecha</th>
                                <th style="width: 80%; text-align: center;">Notificacion</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>    
@endsection