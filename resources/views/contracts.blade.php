@extends('layout')
@section('header')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="color-deep-blue mb-4 noPrint"><strong>Contratos sin tramitar</strong></h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Entidad contratante</th>
                        <th>DNI profesor</th>
                        <th>Nombre profesor</th>
                        <th>Nº de expediente</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de comunicación</th>
                        <th>Fecha Modifiación</th>
                        <th>Modificado</th>
                        <th>Tramitado</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($noProcessedContracts as $contract){
                        echo'<tr class="editableRow interactive" data-target="'.url('contract/'.$contract->id).'">
                                <th>'.$contract['id'].'</th>
                                <th>'.$contract['entity'].'</th>
                                <th>'.decrypt($contract['teacher_nif']).'</th>
                                <th>'.$contract['teacher_name'].'</th>
                                <th>'.$contract['case_file'].'</th>
                                <th>'.$contract['init_date'].'</th>
                                <th>'.$contract['communication_date'].'</th>
                                <th>'.$contract['updated_at'].'</th><th>';

                                if($contract['updated_at'] != $contract['created_at']) echo 'Si';
                                else echo 'No';

                                echo'</th><th>';
                                if($contract['processed'] == 0){
                                    echo'No';
                                } else if($contract['processed'] == 1){
                                    echo'Si';
                                }
                                echo'</th>
                            </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Page Heading -->
    <h2 class="color-deep-blue mb-4 noPrint"><strong>Historial de Contratos</strong></h2>

    <div class="card shadow mb-4 noPrint">
        <div class="card-body">
            <?php if(isset($limited)) echo'<p>Esta tabla es excepcionalmente grande, por esta razón se muestran solo las últimas 1000 filas, para verla entera haga click <a href="'.URL::to('viewContracts').'">aquí</a>.</p>'; ?>
            <div class="table-responsive">
                <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Entidad contratante</th>
                        <th>DNI profesor</th>
                        <th>Nombre profesor</th>
                        <th>Nº de expediente</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de comunicación</th>
                        <th>Fecha Modifiación</th>
                        <th>Modificado</th>
                        <th>Tramitado</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($contracts as $contract){
                        echo'<tr class="editableRow interactive" data-target="'.url('contract/'.$contract->id).'">
                                <th>'.$contract['id'].'</th>
                                <th>'.$contract['entity'].'</th>
                                <th>'.decrypt($contract['teacher_nif']).'</th>
                                <th>'.$contract['teacher_name'].'</th>
                                <th>'.$contract['case_file'].'</th>
                                <th>'.$contract['init_date'].'</th>
                                <th>'.$contract['communication_date'].'</th>
                                <th>'.$contract['updated_at'].'</th><th>';

                        if($contract['updated_at'] != $contract['created_at']) echo 'Si';
                        else echo 'No';

                        echo'</th><th>';
                        if($contract['processed'] == 0){
                            echo'No';
                        } else if($contract['processed'] == 1){
                            echo'Si';
                        }
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
