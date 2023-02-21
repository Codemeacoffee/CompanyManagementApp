@extends('layout')
@section('header')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="color-deep-blue mb-4"><strong>Registro de entrada</strong></h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Receptor</th>
                        <th>Cód. de entrada</th>
                        <th>Documento</th>
                        <th>Fecha</th>
                        <th>Destino</th>
                        <th>Entregado</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($checkIns as $checkIn){
                        echo'<tr class="editableRow interactive" data-target="'.url('checkIn/'.$checkIn->id).'">
                                <th>'.$checkIn['receiver'].'</th>
                                <th>'.$checkIn['entry_code'].'</th>
                                <th>'.$checkIn['document'].'</th>
                                <th>'.$checkIn['date'].'</th>
                                <th>'.$checkIn['destination'].'</th>
                                <th>'.$checkIn['sender'].'</th>
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
