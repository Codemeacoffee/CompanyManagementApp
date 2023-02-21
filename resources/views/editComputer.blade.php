@extends('layout')
@section('header')
@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{url('deleteComputer')}}">
            {{csrf_field()}}
            <input type="hidden" name="computerId" value="{{$computer->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center">Borrar equipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea borrar el equipo "{{$computer->code}}"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn border-deep-blue bg-white" data-dismiss="modal"><strong class="color-deep-blue">Cancelar</strong></button>
                    <button type="submit" class="btn bg-deep-blue"><strong class="text-white">Borrar</strong></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div>
                <div class="text-right">
                    <button class="btn btn-danger my-2" type="button" data-toggle="modal" data-target="#deleteModal"><strong class="text-white">Borrar</strong></button>
                </div>
            </div>
            <form action="{{url('editComputer')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="computerId" value="{{$computer->id}}">
                <div class="container-fluid">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="code">Código</label>
                            <input type="text" class="form-control" name="code" id="code" value="{{$computer->code}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$computer->name}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="location">Sede</label>
                            <select id="locationFilter" name="location" class="form-control">
                                <option value="GRAN CANARIA 54" @if($computer->location == 'GRAN CANARIA 54'){{ "selected" }}@endif>GRAN CANARIA 54</option>
                                <option value="GRAN CANARIA 70" @if($computer->location == 'GRAN CANARIA 70'){{ "selected" }}@endif>GRAN CANARIA 70</option>
                                <option value="CISNEROS 82" @if($computer->location == 'CISNEROS 82'){{ "selected" }}@endif>CISNEROS 82</option>
                                <option value="CISNEROS 105" @if($computer->location == 'CISNEROS 105'){{ "selected" }}@endif>CISNEROS 105</option>
                                <option value="MAHAN 154" @if($computer->location == 'MAHAN 154'){{ "selected" }}@endif>MAHAN 154</option>
                                <option value="BARSINA 12" @if($computer->location == 'BARSINA 12'){{ "selected" }}@endif>BARSINA 12</option>
                                <option value="PIZARRO 45" @if($computer->location == 'PIZARRO 45'){{ "selected" }}@endif>PIZARRO 45</option>
                                <option value="CANALEJAS" @if($computer->location == 'CANALEJAS'){{ "selected" }}@endif>CANALEJAS</option>
                                <option value="ANTIGUA" @if($computer->location == 'ANTIGUA'){{ "selected" }}@endif>ANTIGUA</option>
                                <option value="FERNANDO GUANARTEME 44" @if($computer->location == 'FERNANDO GUANARTEME 44'){{ "selected" }}@endif>FERNANDO GUANARTEME 44</option>
                                <option value="PLAZA ALONSO QUESADA" @if($computer->location == 'PLAZA ALONSO QUESADA'){{ "selected" }}@endif>PLAZA ALONSO QUESADA</option>
                                <option value="RUFINO 7" @if($computer->location == 'RUFINO 7'){{ "selected" }}@endif>RUFINO 7</option>
                                <option value="PARADOR DE FUERTEVENTURA" @if($computer->location == 'PARADOR DE FUERTEVENTURA'){{ "selected" }}@endif>PARADOR DE FUERTEVENTURA</option>
                                <option value="HOTEL ESCUELA PAJARA" @if($computer->location == 'HOTEL ESCUELA PAJARA'){{ "selected" }}@endif>HOTEL ESCUELA PAJARA</option>
                                <option value="PEREZ DEL TORO 54" @if($computer->location == 'PEREZ DEL TORO 54'){{ "selected" }}@endif>PEREZ DEL TORO 54</option>
                                <option value="CHT" @if($computer->location == 'CHT'){{ "selected" }}@endif>CHT</option>
                                <option value="ATALAYA 15" @if($computer->location == 'ATALAYA 15'){{ "selected" }}@endif>ATALAYA 15</option>
                                <option value="PEROJO 16" @if($computer->location == 'PEROJO 16'){{ "selected" }}@endif>PEROJO 16</option>
                                <option value="AYAGUARES 9" @if($computer->location == 'AYAGUARES 9'){{ "selected" }}@endif>AYAGUARES 9</option>
                                <option value="JOAQUIN BLANCO TORRENT" @if($computer->location == 'JOAQUIN BLANCO TORRENT'){{ "selected" }}@endif>JOAQUIN BLANCO TORRENT</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="currentPlacement">Ubicación actual</label>
                            <input type="text" class="form-control" name="currentPlacement" id="currentPlacement" value="{{$computer->currentPlacement}}">
                        </div>
                        <div class="accordion col-12" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Resto de datos del equipo
                                        </button>
                                    </h2>
                                </div>
                            
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="brand">Marca</label>
                                                <input type="text" class="form-control" name="brand" id="brand" value="{{$computer->brand}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="model">Modelo</label>
                                                <input type="text" class="form-control" name="model" id="model" value="{{$computer->model}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="serial">Número de serie</label>
                                                <input type="text" class="form-control" name="serial" id="serial" value="{{$computer->serial}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="ip">IP</label>
                                                <input type="text" class="form-control" name="ip" id="ip" value="{{$computer->ip}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="processor">Procesador</label>
                                                <input type="text" class="form-control" name="processor" id="processor" value="{{$computer->processor}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="memory">Memoria</label>
                                                <input type="text" class="form-control" name="memory" id="memory" value="{{$computer->memory}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="hardDrive">Disco duro</label>
                                                <input type="text" class="form-control" name="hardDrive" id="hardDrive" value="{{$computer->hardDrive}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="operatingSystem">Sistema operativo</label>
                                                <input type="text" class="form-control" name="operatingSystem" id="processor" value="{{$computer->operatingSystem}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="CD_ROM">CD-ROM</label>
                                                <select id="CD_ROM" name="CD_ROM" class="form-control">
                                                    <option value="0" @if($computer->CD_ROM != '1'){{ "selected" }}@endif>No</option>
                                                    <option value="1" @if($computer->CD_ROM == '1'){{ "selected" }}@endif>Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="status">Estado</label>
                                                <input type="text" class="form-control" name="status" id="status" value="{{$computer->status}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="originalPlacement">Ubicación</label>
                                                <input type="text" class="form-control" name="originalPlacement" id="originalPlacement" value="{{$computer->originalPlacement}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="observations">Observaciones</label>
                                                <input type="text" class="form-control" name="observations" id="observations" value="{{$computer->observations}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="deceased">Baja</label>
                                                <select id="deceased" name="deceased" class="form-control">
                                                    <option value="0" @if($computer->deceased != '1'){{ "selected" }}@endif>No</option>
                                                    <option value="1" @if($computer->deceased == '1'){{ "selected" }}@endif>Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="deceaseDate">Fecha de baja</label>
                                                <input type="date" class="form-control" name="deceaseDate" id="deceaseDate" value="{{$computer->deceaseDate}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="warranty">Garantía</label>
                                                <select id="warranty" name="warranty" class="form-control">
                                                    <option value="0" @if($computer->warranty != '1'){{ "selected" }}@endif>No</option>
                                                    <option value="1" @if($computer->warranty == '1'){{ "selected" }}@endif>Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="warrantyEndDate">Fin de garantía</label>
                                                <input type="date" class="form-control" name="warrantyEndDate" id="warrantyEndDate" value="{{$computer->warrantyEndDate}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="provider">Proveedor</label>
                                                <input type="text" class="form-control" name="provider" id="provider" value="{{$computer->provider}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="gateway">Puerta de enlace</label>
                                                <input type="text" class="form-control" name="gateway" id="gateway" value="{{$computer->gateway}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="DNS1">DNS1</label>
                                                <input type="text" class="form-control" name="DNS1" id="DNS1" value="{{$computer->DNS1}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="DNS2">DNS2</label>
                                                <input type="text" class="form-control" name="DNS2" id="DNS2" value="{{$computer->DNS2}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="purchaseDate">Fecha de compra</label>
                                                <input type="date" class="form-control" name="purchaseDate" id="purchaseDate" value="{{$computer->purchaseDate}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="activationKey">Clave de activación Windows</label>
                                                <input type="text" class="form-control" name="activationKey" id="activationKey" value="{{$computer->activationKey}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="float-right">
                        <a href="{{url('viewComputers')}}"><button class="btn bg-white border-deep-blue my-4" type="button"><strong class="color-deep-blue">Volver</strong></button></a>
                        <button class="btn bg-deep-blue my-4" type="submit"><strong class="text-white">Guardar</strong></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@if(isset($incidences))
    <div class="container-fluid">
        <h2 class="color-deep-blue mb-4"><strong>Incidencias</strong></h2>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Incidencia</th>
                            <th>Observaciónes</th>
                            <th>Sede</th>
                            <th>Informante</th>
                            <th>Arreglado</th>
                            <th>Solución</th>
                            <th>Fecha de Incidencia</th>
                            <th>Fecha de solución</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($incidences as $incidence)
                                <tr class="editableRow interactive" data-target="{{URL::to('incidence/'.$incidence->id)}}">
                                    <th>{{$incidence->incidence}}</th>
                                    <th>{{$incidence->observations}}</th>
                                    <th>{{$incidence->location}}</th>
                                    <th>{{$incidence->informant}}</th>
                                    <th>@if($incidence->solved == 1){{"SI"}}@else{{"NO"}}@endif</th>
                                    <th>{{$incidence->solution}}</th>
                                    <th>{{$incidence->created}}</th>
                                    <th>@if($incidence->solved == 1){{$incidence->updated}}@endif</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif

@stop
@section('footer')
