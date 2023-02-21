@extends('layout')
@section('header')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="color-deep-blue mb-4"><strong>Auditorías</strong></h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered w-100" id="dataTable" cellspacing="0" style="overflow-x: auto;">
                    <thead>
                    <tr>
                        <th>Sede</th>
                        <th>Ubicación</th>
                        <th>Fecha</th>
                        <th>Motivo</th>
                        <th>Observaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($audits as $audit){
                        echo'<tr class="editableRow interactive" data-target="'.url('audits/'.$audit->id).'">
                            <th>'.$audit['location'].'</th>
                            <th>'.$audit['placement'].'</th>
                            <th>'.$audit['date'].'</th>
                            <th>'.$audit['cause'].'</th>
                            <th>'.$audit['observations'].'</th>
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
