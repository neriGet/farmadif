@extends('layouts.app')

@section('content')
@if(count($donadores) <= 0) 
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Donadores registrados
                </div>
                @include('donador.buscadorDonador')
                <br><br><br>
                <center><h4>No se encontro el donador</h4></center>
                <br><br><br>
            </div>
        </div>
    </div>
@else
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Donadores registrados
            </div>
            @include('donador.buscadorDonador')
            <div class="panel-body">
                <table width="100%" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="5%" style="font-size: 13px;">Actualizar</th>
                            <th width="5%" style="font-size: 13px;">Eliminar</th>
                            <th>Nombre</th>
                            <th>Domicilio</th>
                            <th>No. telefonico</th>
                            <th>Codigo postal</th>
                            <th>Fecha de registro</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($donadores as $donador)
                        <tr>
                            <td>
                                <center>
                                    <a href="{{ route('ruta_seleccionar_actualizar_donador', ['idDonador' => $donador->id_donador]) }}">
                                        <button class="btn btn-default btn-small ">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </button> 
                                    </a>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <a href="{{ route('ruta_eliminar_donador', ['idDonador' => $donador->id_donador]) }}">
                                        <button class="btn btn-default btn-small ">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </button> 
                                    </a>
                                </center>
                            </td>
                            <td>{{ $donador->nombre }}</td>
                            <td>{{ $donador->domicilio }}</td>
                            <td>{{ $donador->num_telefonico }}</td>
                            <td>{{ $donador->codigo_postal }}</td>
                            <td>{{ $donador->fecha_registro }}</td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <center>{{ $donadores->links() }}</center>
</div>


@endif
   
@endsection