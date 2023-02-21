@extends('layout')
@section('header')
@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{url('deleteReservedList')}}">
            {{csrf_field()}}
            <input type="hidden" name="reservedListId" value="{{$reservedList->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center">Borrar preinscripción</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea borrar la incidencia "{{$reservedList->name}}"?
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
            <form action="{{url('editReservedList')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="reservedListId" value="{{$reservedList->id}}">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$reservedList->name}}">
                </div>
                <div class="form-group">
                    <label for="type">Estado</label>
                    <select id="type" name="solved" class="form-control">
                        <option value="Alumno" <?php if($reservedList->type == 'Alumno') echo 'selected' ?>>Alumno</option>
                        <option value="Docente" <?php if($reservedList->type == 'Docente') echo 'selected' ?>>Docente</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{$reservedList->email}}">
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="number" class="form-control" name="phone" id="phone" value="{{$reservedList->phone}}">
                </div>
                <div class="form-group">
                    <label for="location">Sede</label>
                    <select id="location" name="location" class="form-control">
                        <option value="GRAN CANARIA 54" <?php if($reservedList->location == 'GRAN CANARIA 54') echo 'selected' ?>>GRAN CANARIA 54</option>
                        <option value="GRAN CANARIA 70" <?php if($reservedList->location == 'GRAN CANARIA 70') echo 'selected' ?>>GRAN CANARIA 70</option>
                        <option value="CISNEROS 82" <?php if($reservedList->location == 'CISNEROS 82') echo 'selected' ?>>CISNEROS 82</option>
                        <option value="CISNEROS 105" <?php if($reservedList->location == 'CISNEROS 105') echo 'selected' ?>>CISNEROS 105</option>
                        <option value="MAHAN 154" <?php if($reservedList->location == 'MAHAN 154') echo 'selected' ?>>MAHAN 154</option>
                        <option value="BARSINA 12" <?php if($reservedList->location == 'BARSINA 12') echo 'selected' ?>>BARSINA 12</option>
                        <option value="PIZARRO 45" <?php if($reservedList->location == 'PIZARRO 45') echo 'selected' ?>>PIZARRO 45</option>
                        <option value="CANALEJAS" <?php if($reservedList->location == 'CANALEJAS') echo 'selected' ?>>CANALEJAS</option>
                        <option value="ANTIGUA" <?php if($reservedList->location == 'ANTIGUA') echo 'selected' ?>>ANTIGUA</option>
                        <option value="FERNANDO GUANARTEME 44" <?php if($reservedList->location == 'FERNANDO GUANARTEME 44') echo 'selected' ?>>FERNANDO GUANARTEME 44</option>
                        <option value="PLAZA ALONSO QUESADA" <?php if($reservedList->location == 'PLAZA ALONSO QUESADA') echo 'selected' ?>>PLAZA ALONSO QUESADA</option>
                        <option value="RUFINO 7" <?php if($reservedList->location == 'RUFINO 7') echo 'selected' ?>>RUFINO 7</option>
                        <option value="PARADOR DE FUERTEVENTURA" <?php if($reservedList->location == 'PARADOR DE FUERTEVENTURA') echo 'selected' ?>>PARADOR DE FUERTEVENTURA</option>
                        <option value="HOTEL ESCUELA PAJARA" <?php if($reservedList->location == 'HOTEL ESCUELA PAJARA') echo 'selected' ?>>HOTEL ESCUELA PAJARA</option>
                        <option value="PEREZ DEL TORO 54" <?php if($reservedList->location == 'PEREZ DEL TORO 54') echo 'selected' ?>>PEREZ DEL TORO 54</option>
                        <option value="CHT" <?php if($reservedList->location == 'CHT') echo 'selected' ?>>CHT</option>
                        <option value="ATALAYA 15" <?php if($reservedList->location == 'ATALAYA 15') echo 'selected' ?>>ATALAYA 15</option>
                        <option value="PEROJO 16" <?php if($reservedList->location == 'PEROJO 16') echo 'selected' ?>>PEROJO 16</option>
                        <option value="AYAGUARES 9" <?php if($reservedList->location == 'AYAGUARES 9') echo 'selected' ?>>AYAGUARES 9</option>
                        <option value="JOAQUIN BLANCO TORRENT" <?php if($reservedList->location == 'JOAQUIN BLANCO TORRENT') echo 'selected' ?>>JOAQUIN BLANCO TORRENT</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">Contenido</label>
                    <input type="text" class="form-control" name="content" id="content" value="{{$reservedList->content}}">
                </div>
                <div class="form-group">
                    <label for="info">Información</label>
                    <input type="text" class="form-control" name="info" id="info" value="{{$reservedList->info}}">
                </div>
                <div class="form-group">
                    <label for="status">Estado</label>
                    <select id="status" name="status" class="form-control">
                        <option value="0" <?php if($reservedList->status == 0) echo 'selected' ?>>Sin tramitar</option>
                        <option value="1" <?php if($reservedList->status == 1) echo 'selected' ?>>Tramitado</option>
                    </select>
                </div>
                <div>
                    <div class="float-right">
                        <a href="{{url('viewLimitedReservedList')}}"><button class="btn bg-white border-deep-blue mt-4" type="button"><strong class="color-deep-blue">Volver</strong></button></a>
                        <button class="btn bg-deep-blue mt-4" type="submit"><strong class="text-white">Guardar</strong></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('footer')
