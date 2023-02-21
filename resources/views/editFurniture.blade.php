@extends('layout')
@section('header')
@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{url('deleteFurniture')}}">
            {{csrf_field()}}
            <input type="hidden" name="furnitureId" value="{{$furniture->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center">Borrar incidencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea borrar la incidencia "{{$furniture->incidence}}"?
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
        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12 offset-0">
            <div>
                <div class="text-right">
                    <button class="btn btn-danger my-2" type="button" data-toggle="modal" data-target="#deleteModal"><strong class="text-white">Borrar</strong></button>
                </div>
            </div>
            <form action="{{url('editFurniture')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="furnitureId" value="{{$furniture->id}}">
                <div class="form-group">
                    <label for="code">Código de mobiliario</label>
                    <input type="number" class="form-control" name="code" id="code" value="{{$furniture->code}}">
                </div>
                <div class="form-group">
                    <label for="locationFilter">Sede</label>
                    <select id="locationFilter" name="location" class="form-control">
                        <option value="GRAN CANARIA 54" <?php if($furniture->location == 'GRAN CANARIA 54') echo 'selected' ?>>GRAN CANARIA 54</option>
                        <option value="GRAN CANARIA 70" <?php if($furniture->location == 'GRAN CANARIA 70') echo 'selected' ?>>GRAN CANARIA 70</option>
                        <option value="CISNEROS 82" <?php if($furniture->location == 'CISNEROS 82') echo 'selected' ?>>CISNEROS 82</option>
                        <option value="CISNEROS 105" <?php if($furniture->location == 'CISNEROS 105') echo 'selected' ?>>CISNEROS 105</option>
                        <option value="MAHAN 154" <?php if($furniture->location == 'MAHAN 154') echo 'selected' ?>>MAHAN 154</option>
                        <option value="BARSINA 12" <?php if($furniture->location == 'BARSINA 12') echo 'selected' ?>>BARSINA 12</option>
                        <option value="PIZARRO 45" <?php if($furniture->location == 'PIZARRO 45') echo 'selected' ?>>PIZARRO 45</option>
                        <option value="CANALEJAS" <?php if($furniture->location == 'CANALEJAS') echo 'selected' ?>>CANALEJAS</option>
                        <option value="ANTIGUA" <?php if($furniture->location == 'ANTIGUA') echo 'selected' ?>>ANTIGUA</option>
                        <option value="FERNANDO GUANARTEME 44" <?php if($furniture->location == 'FERNANDO GUANARTEME 44') echo 'selected' ?>>FERNANDO GUANARTEME 44</option>
                        <option value="PLAZA ALONSO QUESADA" <?php if($furniture->location == 'PLAZA ALONSO QUESADA') echo 'selected' ?>>PLAZA ALONSO QUESADA</option>
                        <option value="RUFINO 7" <?php if($furniture->location == 'RUFINO 7') echo 'selected' ?>>RUFINO 7</option>
                        <option value="PARADOR DE FUERTEVENTURA" <?php if($furniture->location == 'PARADOR DE FUERTEVENTURA') echo 'selected' ?>>PARADOR DE FUERTEVENTURA</option>
                        <option value="HOTEL ESCUELA PAJARA" <?php if($furniture->location == 'HOTEL ESCUELA PAJARA') echo 'selected' ?>>HOTEL ESCUELA PAJARA</option>
                        <option value="PEREZ DEL TORO 54" <?php if($furniture->location == 'PEREZ DEL TORO 54') echo 'selected' ?>>PEREZ DEL TORO 54</option>
                        <option value="CHT" <?php if($furniture->location == 'CHT') echo 'selected' ?>>CHT</option>
                        <option value="ATALAYA 15" <?php if($furniture->location == 'ATALAYA 15') echo 'selected' ?>>ATALAYA 15</option>
                        <option value="PEROJO 16" <?php if($furniture->location == 'PEROJO 16') echo 'selected' ?>>PEROJO 16</option>
                        <option value="AYAGUARES 9" <?php if($furniture->location == 'AYAGUARES 9') echo 'selected' ?>>AYAGUARES 9</option>
                        <option value="JOAQUIN BLANCO TORRENT" <?php if($furniture->location == 'JOAQUIN BLANCO TORRENT') echo 'selected' ?>>JOAQUIN BLANCO TORRENT</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount">Cantidad</label>
                    <input type="number" class="form-control" name="amount" id="amount" value="{{$furniture->amount}}">
                </div>
                <div class="form-group">
                    <label for="status">Estado</label>
                    <input type="text" class="form-control" name="status" id="status" value="{{$furniture->status}}">
                </div>
                <div class="form-group">
                    <label for="observations">Observaciones</label>
                    <input type="text" class="form-control" name="observations" id="observations" value="{{$furniture->observations}}">
                </div>
                <div class="form-group">
                    <label for="originalPlacement">Ubicación</label>
                    <input type="text" class="form-control" name="originalPlacement" id="originalPlacement" value="{{$furniture->originalPlacement}}">
                </div>
                <div class="form-group">
                    <label for="currentPlacement">Ubicación actual</label>
                    <input type="text" class="form-control" name="currentPlacement" id="currentPlacement" value="{{$furniture->currentPlacement}}">
                </div>
                <div>
                    <div class="float-right">
                        <a href="{{url('viewFurniture')}}"><button class="btn bg-white border-deep-blue mt-4" type="button"><strong class="color-deep-blue">Volver</strong></button></a>
                        <button class="btn bg-deep-blue mt-4" type="submit"><strong class="text-white">Guardar</strong></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('footer')
