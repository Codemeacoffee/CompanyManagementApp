@extends('layout')
@section('header')
@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{url('deleteExternalIncidence')}}">
            {{csrf_field()}}
            <input type="hidden" name="externalIncidenceId" value="{{$externalIncidence->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center">Borrar incidencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea borrar la incidencia "{{$externalIncidence->incidence}}"?
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
            <form method="post" id="unsolvedIncidenceForm">
                {{csrf_field()}}
                <input type="hidden" name="externalIncidenceId" value="{{$externalIncidence->id}}">
                <div class="form-group">
                    <label for="incidence">Incidencia externa</label>
                    <input type="text" class="form-control" name="incidence" id="incidence" value="{{$externalIncidence->incidence}}">
                </div>
                <div class="form-group">
                    <label for="incidence_date">Fecha de incidencia</label>
                    <input type="date" class="form-control" name="incidence_date" id="incidence_date" value="{{$externalIncidence->created}}">
                </div>
                <div class="form-group">
                    <label for="solved_incidence_date">Fecha de solución</label>
                    <input type="date" class="form-control" name="solved_incidence_date" id="solved_incidence_date" value="{{$externalIncidence->updated}}">
                </div>
                <div class="form-group">
                    <label for="locationFilter">Sede</label>
                    <select id="locationFilter" name="location" class="form-control">
                        <option value="GRAN CANARIA 54" <?php if($externalIncidence->location == 'GRAN CANARIA 54') echo 'selected' ?>>GRAN CANARIA 54</option>
                        <option value="GRAN CANARIA 70" <?php if($externalIncidence->location == 'GRAN CANARIA 70') echo 'selected' ?>>GRAN CANARIA 70</option>
                        <option value="CISNEROS 82" <?php if($externalIncidence->location == 'CISNEROS 82') echo 'selected' ?>>CISNEROS 82</option>
                        <option value="CISNEROS 105" <?php if($externalIncidence->location == 'CISNEROS 105') echo 'selected' ?>>CISNEROS 105</option>
                        <option value="MAHAN 154" <?php if($externalIncidence->location == 'MAHAN 154') echo 'selected' ?>>MAHAN 154</option>
                        <option value="BARSINA 12" <?php if($externalIncidence->location == 'BARSINA 12') echo 'selected' ?>>BARSINA 12</option>
                        <option value="PIZARRO 45" <?php if($externalIncidence->location == 'PIZARRO 45') echo 'selected' ?>>PIZARRO 45</option>
                        <option value="CANALEJAS" <?php if($externalIncidence->location == 'CANALEJAS') echo 'selected' ?>>CANALEJAS</option>
                        <option value="ANTIGUA" <?php if($externalIncidence->location == 'ANTIGUA') echo 'selected' ?>>ANTIGUA</option>
                        <option value="FERNANDO GUANARTEME 44" <?php if($externalIncidence->location == 'FERNANDO GUANARTEME 44') echo 'selected' ?>>FERNANDO GUANARTEME 44</option>
                        <option value="PLAZA ALONSO QUESADA" <?php if($externalIncidence->location == 'PLAZA ALONSO QUESADA') echo 'selected' ?>>PLAZA ALONSO QUESADA</option>
                        <option value="RUFINO 7" <?php if($externalIncidence->location == 'RUFINO 7') echo 'selected' ?>>RUFINO 7</option>
                        <option value="PARADOR DE FUERTEVENTURA" <?php if($externalIncidence->location == 'PARADOR DE FUERTEVENTURA') echo 'selected' ?>>PARADOR DE FUERTEVENTURA</option>
                        <option value="HOTEL ESCUELA PAJARA" <?php if($externalIncidence->location == 'HOTEL ESCUELA PAJARA') echo 'selected' ?>>HOTEL ESCUELA PAJARA</option>
                        <option value="PEREZ DEL TORO 54" <?php if($externalIncidence->location == 'PEREZ DEL TORO 54') echo 'selected' ?>>PEREZ DEL TORO 54</option>
                        <option value="CHT" <?php if($externalIncidence->location == 'CHT') echo 'selected' ?>>CHT</option>
                        <option value="ATALAYA 15" <?php if($externalIncidence->location == 'ATALAYA 15') echo 'selected' ?>>ATALAYA 15</option>
                        <option value="PEROJO 16" <?php if($externalIncidence->location == 'PEROJO 16') echo 'selected' ?>>PEROJO 16</option>
                        <option value="AYAGUARES 9" <?php if($externalIncidence->location == 'AYAGUARES 9') echo 'selected' ?>>AYAGUARES 9</option>
                        <option value="JOAQUIN BLANCO TORRENT" <?php if($externalIncidence->location == 'JOAQUIN BLANCO TORRENT') echo 'selected' ?>>JOAQUIN BLANCO TORRENT</option>
                        <option value="JUAN DOMINGUEZ PEÑA" <?php if($externalIncidence->location == 'JUAN DOMINGUEZ PEÑA') echo 'selected' ?>>JUAN DOMINGUEZ PEÑA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="contact">Contacto</label>
                    <input type="text" class="form-control" name="contact" id="contact" value="{{$externalIncidence->contact}}">
                </div>
                <div class="form-group">
                    <label for="responsible">Responsable</label>
                    <input type="text" class="form-control" name="responsible" id="responsible" value="{{$externalIncidence->responsible}}">
                </div>
                <div class="form-group">
                    <label for="solvedFilter">Solucionado</label>
                    <select id="solvedFilter" name="solved" class="form-control">
                        <option value="0" <?php if($externalIncidence->solved == 0) echo 'selected' ?>>NO</option>
                        <option value="1" <?php if($externalIncidence->solved == 1) echo 'selected' ?>>SI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="solution">Solucionado</label>
                    <textarea class="form-control" name="solution" rows="4" id="solution">{{$externalIncidence->solution}}</textarea>
                </div>
                <div>
                    <div class="float-right">
                        <button class="btn bg-success mt-4" formaction="{{URL::to('resolveExternalIncidence')}}" type="submit"><strong class="text-white">Solucionado</strong></button>
                        <a href="{{url('viewUnsolvedExternalIncidences')}}"><button class="btn bg-white border-deep-blue mt-4" type="button"><strong class="color-deep-blue">Volver</strong></button></a>
                        <button class="btn bg-deep-blue mt-4" formaction="{{URL::to('editExternalIncidence')}}" type="submit"><strong class="text-white">Guardar</strong></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('footer')
