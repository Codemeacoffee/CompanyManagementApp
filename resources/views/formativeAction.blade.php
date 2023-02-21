@extends('layout')
@section('header')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="color-deep-blue mb-4"><strong>Acción Formativa</strong></h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Especialidad</th>
                        <th>Año</th>
                        <th>Cerrado</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($formativeActions as $formativeAction){
                        echo'<tr class="editableRow interactive" data-target="'.url('formativeAction/'.$formativeAction->id).'">
                                <th>'.$formativeAction['name'].'</th>
                                <th>'.$formativeAction['type'].'</th>
                                <th>'.$formativeAction['speciality'].'</th>
                                <th>'.$formativeAction['year'].'</th><th>';
                                if($formativeAction['closed'] == 0){
                                    echo'No';
                                } else if($formativeAction['closed'] == 1){
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
