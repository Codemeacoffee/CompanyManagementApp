@extends('layout')
@section('header')
@section('content')
    <?php
    if(count($incidences) != 0) {
        echo'<div class="container-fluid">

        <!-- Page Heading -->
        <h2 class="color-deep-blue mb-4"><strong>Incidencias no resueltas</strong></h2>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Código de equipo</th>
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
                        <tbody>';
        foreach ($incidences as $incidence){
            echo'<tr class="editableRow interactive" data-target="'.url('incidence/'.$incidence->id).'">
                                                <th>'.$incidence['code'].'</th>
                                                <th>'.$incidence['incidence'].'</th>
                                                <th>'.$incidence['observations'].'</th>
                                                <th>'.$incidence['location'].'</th>
                                                <th>'.$incidence['informant'].'</th><th>';
            if($incidence['solved'] == ''){
                echo'NO';
            } else if($incidence['solved'] == 1){
                echo'SI';
            }
            echo'</th><th>'.$incidence['solution'].'</th>
                                                <th>'.$incidence['created'].'</th>
                                                <th>';

            if($incidence['solved'] == 1) echo $incidence['updated'];

            echo'</th>
                                            </tr>';
        }
        echo'</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>';
    }
    ?>

    <?php
    if(count($externalIncidences) != 0) {
        echo'<div class="container-fluid">

        <h2 class="color-deep-blue mb-4"><strong>Incidencias externas no resueltas</strong></h2>

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
                        <tbody>';
        foreach ($externalIncidences as $externalIncidence){
            echo'<tr class="editableRow interactive" data-target="'.url('externalIncidence/'.$externalIncidence->id).'">
                            <th>'.$externalIncidence['incidence'].'</th>
                            <th>'.$externalIncidence['observations'].'</th>
                            <th>'.$externalIncidence['location'].'</th>
                            <th>'.$externalIncidence['informant'].'</th><th>';
            if($externalIncidence['solved'] == ''){
                echo'NO';
            } else if($externalIncidence['solved'] == 1){
                echo'SI';
            }
            echo'</th><th>'.$externalIncidence['solution'].'</th>
                            <th>'.$externalIncidence['created_at'].'</th>
                            <th>';

            if($externalIncidence['solved'] == 1) echo $externalIncidence['updated_at'];

            echo'</th>
                        </tr>';
        }
        echo'</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>';
    }
    ?>
    <?php
    if(count($serviceIncidences) != 0) {
        echo'<div class="container-fluid">

        <!-- Page Heading -->
        <h2 class="color-deep-blue mb-4"><strong>Incidencias de servicio no resueltas</strong></h2>

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
                        <tbody>';
        foreach ($serviceIncidences as $serviceIncidence){
            echo'<tr class="editableRow interactive" data-target="'.url('serviceIncidence/'.$serviceIncidence->id).'">
                                <th>'.$serviceIncidence['incidence'].'</th>
                                <th>'.$serviceIncidence['observations'].'</th>
                                <th>'.$serviceIncidence['location'].'</th>
                                <th>'.$serviceIncidence['informant'].'</th><th>';
            if($serviceIncidence['solved'] == ''){
                echo'NO';
            } else if($serviceIncidence['solved'] == 1){
                echo'SI';
            }
            echo'</th><th>'.$serviceIncidence['solution'].'</th>
                                <th>'.$serviceIncidence['created_at'].'</th>
                                <th>';

            if($serviceIncidence['solved'] == 1) echo $serviceIncidence['updated_at'];

            echo'</th>
                            </tr>';
        }

        echo'</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>';
    }
    ?>


@stop
@section('footer')
