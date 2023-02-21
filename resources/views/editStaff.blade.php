@extends('layout')
@section('header')
@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{url('deleteStaff')}}">
            {{csrf_field()}}
            <input type="hidden" name="staffId" value="{{$staff->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center">Borrar equipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea borrar personal "{{$staff->name}}"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn border-deep-blue bg-white" data-dismiss="modal"><strong class="color-deep-blue">Cancelar</strong></button>
                    <button type="submit" class="btn bg-deep-blue"><strong class="text-white">Borrar</strong></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div>
                <div class="text-right">
                    <button class="btn btn-danger my-2" type="button" data-toggle="modal" data-target="#deleteModal"><strong class="text-white">Borrar</strong></button>
                </div>
            </div>
            <form action="{{url('editStaff')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="staffId" value="{{$staff->id}}">
                <div class="container-fluid">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$staff->name}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{decrypt($staff->address)}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="city">Municipio</label>
                            <input type="text" class="form-control" name="city" id="city" value="{{$staff->city}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="nif">DNI</label>
                            <input type="text" class="form-control" name="nif" id="nif" value="{{decrypt($staff->nif)}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="social_security">Seguridad social</label>
                            <input type="text" class="form-control" name="social_security" id="social_security" value="{{decrypt($staff->social_security)}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="postal_code">Código Postal</label>
                            <input type="text" class="form-control" name="postal_code" id="postal_code" value="{{$staff->postal_code}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="birth_date">Fecha de nacimiento</label>
                            <input type="text" class="form-control" name="birth_date" id="birth_date" value="{{$staff->birth_date}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="phone">Teléfono</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{decrypt($staff->phone)}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="bank">Banco</label>
                            <input type="text" class="form-control" name="bank" id="bank" value="{{decrypt($staff->bank)}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="CC">CC</label>
                            <input type="text" class="form-control" name="CC" id="CC" value="{{decrypt($staff->CC)}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="marital_status">Estado civil</label>
                            <input type="text" class="form-control" name="marital_status" id="marital_status" value="{{$staff->marital_status}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="children">Número de hijos</label>
                            <input type="number" class="form-control" name="children" id="children" value="{{$staff->children}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{$staff->email}}">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="float-right">
                        <a href="{{url('viewStaff')}}"><button class="btn bg-white border-deep-blue my-4" type="button"><strong class="color-deep-blue">Volver</strong></button></a>
                        <button class="btn bg-deep-blue my-4" type="submit"><strong class="text-white">Guardar</strong></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="color-deep-blue mb-4"><strong>Contratos del empleado</strong></h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Entidad contratante</th>
                        <th>Tipo de contrato</th>
                        <th>Tipo de curso</th>
                        <th>Plan formativo</th>
                        <th>Número de expediente</th>
                        <th>Anualidad</th>
                        <th>Convenio</th>
                        <th>Otros convenios</th>
                        <th>Sector</th>
                        <th>Curso</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Horas totales</th>
                        <th>Horas diarias</th>
                        <th>Horario</th>
                        <th>Lugar de impartición</th>
                        <th>Observaciones</th>
                        <th>Fecha de comunicación</th>
                        <th>Fecha de tramitación</th>
                        <th>Código de empresa</th>
                        <th>Código de trabajador</th>
                        <th>Código de INEM</th>
                        <th>Tramitado</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($contracts as $contract){
                        echo'<tr class="editableRow interactive" data-target="'.url('contract/'.$contract->id).'">
                                <th>'.$contract['entity'].'</th>
                                <th>'.$contract['type'].'</th>
                                <th>'.$contract['course_type'].'</th>
                                <th>'.$contract['formative_planning'].'</th>
                                <th>'.$contract['case_file'].'</th>
                                <th>'.$contract['annuity'].'</th>
                                <th>'.$contract['agreement'].'</th>
                                <th>'.$contract['other_agreements'].'</th>
                                <th>'.$contract['sector'].'</th>
                                <th>'.$contract['course'].'</th>
                                <th>'.$contract['init_date'].'</th>
                                <th>'.$contract['end_date'].'</th>
                                <th>'.$contract['total_hours'].'</th>
                                <th>'.$contract['daily_hours'].'</th>
                                <th>'.$contract['schedule'].'</th>
                                <th>'.$contract['location'].'</th>
                                <th>'.$contract['observations'].'</th>
                                <th>'.$contract['communication_date'].'</th>
                                <th>'.$contract['processing_date'].'</th>
                                <th>'.$contract['company_code'].'</th>
                                <th>'.$contract['company_code'].'</th>
                                <th>'.$contract['INEM_code'].'</th><th>';
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

@stop
@section('footer')
