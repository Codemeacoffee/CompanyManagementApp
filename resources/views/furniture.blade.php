@extends('layout')
@section('header')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="color-deep-blue mb-4"><strong>Mobiliario</strong></h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Sede</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                        <th>Ubicación</th>
                        <th>Ubicación actual</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($furniture as $fur){
                        echo'<tr class="editableRow interactive" data-target="'.url('furniture/'.$fur->id).'">
                                <th>'.$fur['code'].'</th>
                                <th>'.$fur['location'].'</th>
                                <th>'.$fur['amount'].'</th>
                                <th>'.$fur['status'].'</th>
                                <th>'.$fur['observations'].'</th>
                                <th>'.$fur['originalPlacement'].'</th>
                                <th>'.$fur['currentPlacement'].'</th>
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
