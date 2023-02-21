@extends('layout')
@section('header')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="color-deep-blue mb-4"><strong>Personal</strong></h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Municipio</th>
                        <th>Código Postal</th>
                        <th>Fecha de nacimiento</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($staffs as $staff){
                        echo'<tr class="editableRow interactive" data-target="'.url('staff/'.$staff->id).'">
                                <th>'.$staff['name'].'</th>
                                <th>'.$staff['city'].'</th>
                                <th>'.$staff['postal_code'].'</th>
                                <th>'.$staff['birth_date'].'</th>
                                <th>'.$staff['email'].'</th>
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
