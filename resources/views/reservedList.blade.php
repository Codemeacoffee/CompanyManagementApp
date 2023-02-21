@extends('layout')
@section('header')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="color-deep-blue mb-4"><strong>Preinscripciones</strong></h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if(isset($limited)) echo'<p>Esta tabla es excepcionalmente grande, por esta razón se muestran solo las últimas 1000 filas, para verla entera haga click <a href="'.URL::to('viewReservedList').'">aquí</a>.</p>'; ?>
            <div class="table-responsive">
                <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Sede</th>
                        <th>Entidad</th>
                        <th>Contenido</th>
                        <th>Información</th>
                        <th>Estado</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($reservedList as $reserved){
                        echo'<tr class="editableRow interactive" data-target="'.url('reserved/'.$reserved->id).'">
                                <th>'.$reserved['name'].'</th>
                                <th>'.$reserved['type'].'</th>
                                <th>'.$reserved['email'].'</th>
                                <th>'.$reserved['phone'].'</th>
                                <th>'.$reserved['location'].'</th>
                                <th>'.$reserved['entity'].'</th>
                                <th>'.$reserved['content'].'</th>
                                <th>'.$reserved['info'].'</th><th>';
                                if($reserved['status'] == 0){
                                    echo'Sin tramitar';
                                } else if($reserved['status'] == 1){
                                    echo'Tramitado';
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
