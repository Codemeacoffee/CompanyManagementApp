@extends('layout')
@section('header')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="color-deep-blue mb-4"><strong>Incidencias de servicio</strong></h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Incidencia</th>
                        <th>Sede</th>
                        <th>Informante</th>
                        <th>Responsable</th>
                        <th>Arreglado</th>
                        <th>Solución</th>
                        <th>Fecha de Incidencia</th>
                        <th>Fecha de solución</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($serviceIncidences as $incidence){
                        echo'<tr class="editableRow interactive" data-target="'.url('serviceIncidence/'.$incidence->id).'">
                                <th>'.$incidence['incidence'].'</th>
                                <th>'.$incidence['location'].'</th>
                                <th>'.$incidence['informant'].'</th>
                                <th>'.$incidence['responsible'].'</th><th>';
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
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->

@stop
@section('footer')
