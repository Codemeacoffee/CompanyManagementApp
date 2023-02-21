@extends('layout')
@section('header')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="color-deep-blue mb-4"><strong>Registro de salida</strong></h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if(isset($limited)) echo'<p>Esta tabla es excepcionalmente grande, por esta razón se muestran solo las últimas 1000 filas, para verla entera haga click <a href="'.URL::to('viewCheckOut').'">aquí</a>.</p>'; ?>
            <div class="table-responsive">
                <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Cód. de salida</th>
                        <th>Documento</th>
                        <th>Fecha</th>
                        <th>Destino</th>
                        <th>Entregado</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($checkOuts as $checkOut){
                        echo'<tr class="editableRow interactive" data-target="'.url('checkOut/'.$checkOut->id).'">
                                <th>'.$checkOut['exit_code'].'</th>
                                <th>'.$checkOut['document'].'</th>
                                <th>'.$checkOut['date'].'</th>
                                <th>'.$checkOut['destination'].'</th>
                                <th>'.$checkOut['sender'].'</th>
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
