@extends('layout')
@section('header')
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h2 class="color-deep-blue mb-4"><strong>Equipos</strong></h2>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dataTable" cellspacing="0" style="overflow-x: auto;">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Número de serie</th>
                            <th>IP</th>
                            <th>Procesador</th>
                            <th>Memoria</th>
                            <th>Disco duro</th>
                            <th>Sistema operativo</th>
                            <th>CD-ROM</th>
                            <th>Estado</th>
                            <th>Sede</th>
                            <th>Ubicación</th>
                            <th>Ubicación actual</th>
                            <th>Observaciones</th>
                            <th>Baja</th>
                            <th>Fecha de baja</th>
                            <th>Garantía</th>
                            <th>Fin de garantía</th>
                            <th>Proveedor</th>
                            <th>Puerta de enlace</th>
                            <th>DNS1</th>
                            <th>DNS2</th>
                            <th>Fecha de compra</th>
                            <th>Clave de activación Windows</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($computers as $computer){
                            echo'<tr class="editableRow interactive" data-target="'.url('computer/'.$computer->id).'">
                                <th>'.$computer['code'].'</th>
                                <th>'.$computer['name'].'</th>
                                <th>'.$computer['brand'].'</th>
                                <th>'.$computer['model'].'</th>
                                <th>'.$computer['serial'].'</th>
                                <th>'.$computer['ip'].'</th>
                                <th>'.$computer['processor'].'</th>
                                <th>'.$computer['memory'].'</th>
                                <th>'.$computer['hardDrive'].'</th>
                                <th>'.$computer['operatingSystem'].'</th>
                                <th>';
                                if($computer['CD_ROM'] == ''){
                                    echo'NO';
                                } else if($computer['CD_ROM'] == 1){
                                    echo'SI';
                                }
                                echo'</th>
                                <th>'.$computer['status'].'</th>
                                <th>'.$computer['location'].'</th>
                                <th>'.$computer['originalPlacement'].'</th>
                                <th>'.$computer['currentPlacement'].'</th>
                                <th>'.$computer['observations'].'</th>
                                <th>';
                                if($computer['deceased'] == ''){
                                    echo'NO';
                                } else if($computer['deceased'] == 1){
                                    echo'SI';
                                }
                                echo'</th>
                                <th>'.$computer['deceaseDate'].'</th>
                                <th>';
                                if($computer['warranty'] == ''){
                                    echo'NO';
                                } else if($computer['warranty'] == 1){
                                    echo'SI';
                                }
                                echo'</th>
                                <th>'.$computer['warrantyEndDate'].'</th>
                                <th>'.$computer['provider'].'</th>
                                <th>'.$computer['gateway'].'</th>
                                <th>'.$computer['DNS1'].'</th>
                                <th>'.$computer['DNS2'].'</th>
                                <th>'.$computer['purchaseDate'].'</th>
                                <th>'.$computer['activationKey'].'</th>';
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
