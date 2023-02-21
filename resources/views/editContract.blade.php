@extends('layout')
@section('header')
@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{url('deleteContract')}}">
            {{csrf_field()}}
            <input type="hidden" name="contractId" value="{{$contract->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center">Borrar contrato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea borrar el contrato "{{$contract->entity}}"?
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
            <form action="{{url('editContract')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="contractId" value="{{$contract->id}}">
                <div class="container-fluid">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="entity">Entidad contratante</label>
                            <input type="text" class="form-control" name="entity" id="entity" value="{{$contract->entity}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="teacher_nif">DNI del trabajador</label>
                            <input type="text" class="form-control" name="teacher_nif" id="teacher_nif" value="{{decrypt($contract->teacher_nif)}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="type">Tipo</label>
                            <input type="text" class="form-control" name="type" id="type" value="{{$contract->type}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="course_type">Tipo del curso</label>
                            <input type="text" class="form-control" name="course_type" id="course_type" value="{{$contract->course_type}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="gross_salary">Salario bruto</label>
                            <input type="number" class="form-control" name="gross_salary" id="gross_salary" value="{{$contract->gross_salary}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="retentions">Retenciones</label>
                            <input type="number" class="form-control" name="retentions" id="retentions" value="{{$contract->retentions}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="net_salary">Salario neto</label>
                            <input type="number" class="form-control" name="net_salary" id="net_salary" value="{{$contract->net_salary}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="formative_planning">Plan formativo</label>
                            <input type="text" class="form-control" name="formative_planning" id="formative_planning" value="{{$contract->formative_planning}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="case_file">Número de expediente</label>
                            <input type="text" class="form-control" name="case_file" id="case_file" value="{{$contract->case_file}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="annuity">Anualidad</label>
                            <input type="text" class="form-control" name="annuity" id="annuity" value="{{$contract->annuity}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="agreement">Convenio</label>
                            <input type="text" class="form-control" name="agreement" id="agreement" value="{{$contract->agreement}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="other_agreements">Otros convenios</label>
                            <input type="text" class="form-control" name="other_agreements" id="other_agreements" value="{{$contract->other_agreements}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="sector">Sector</label>
                            <input type="text" class="form-control" name="sector" id="sector" value="{{$contract->sector}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="course">Curso</label>
                            <input type="text" class="form-control" name="course" id="course" value="{{$contract->course}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="init_date">Fecha de inicio</label>
                            <input type="date" class="form-control" name="init_date" id="init_date" value="{{$contract->init_date}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="end_date">Fecha de fin</label>
                            <input type="date" class="form-control" name="end_date" id="end_date" value="{{$contract->end_date}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="total_hours">Horas totales</label>
                            <input type="number" class="form-control" name="total_hours" id="total_hours" value="{{$contract->total_hours}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="daily_hours">Horas diarias</label>
                            <input type="number" class="form-control" name="daily_hours" id="daily_hours" value="{{$contract->daily_hours}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="schedule">Horario</label>
                            <input type="text" class="form-control" name="schedule" id="schedule" value="{{$contract->schedule}}">
                        </div>
                        <div class="form-group col-6">
                            <label>Días laborales</label><br>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="checkbox" id="monday" name="monday" <?php if($contract->monday == 1) echo 'checked' ?>>Lunes<br>
                                        <input type="checkbox" id="tuesday" name="tuesday" <?php if($contract->tuesday == 1) echo 'checked' ?>>Martes<br>
                                        <input type="checkbox" id="wednesday" name="wednesday" <?php if($contract->wednesday == 1) echo 'checked' ?>>Miércoles<br>
                                        <input type="checkbox" id="thursday" name="thursday" <?php if($contract->thursday == 1) echo 'checked' ?>>Jueves<br>
                                    </div>
                                    <div class="col-6">
                                        <input type="checkbox" id="friday" name="friday" <?php if($contract->friday == 1) echo 'checked' ?>>Viernes<br>
                                        <input type="checkbox" id="saturday" name="saturday" <?php if($contract->saturday == 1) echo 'checked' ?>>Sábado<br>
                                        <input type="checkbox" id="sunday" name="sunday" <?php if($contract->sunday == 1) echo 'checked' ?>>Domingo<br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="location">Lugar de impartición</label>
                            <input type="text" class="form-control" name="location" id="location" value="{{$contract->location}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="observations">Observaciones</label>
                            <input type="text" class="form-control" name="observations" id="observations" value="{{$contract->observations}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="communication_date">Fecha de comunicación</label>
                            <input type="date" class="form-control" name="communication_date" id="communication_date" value="{{$contract->communication_date}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="processing_date">Fecha de tramitación</label>
                            <input type="date" class="form-control" name="processing_date" id="processing_date" value="{{$contract->processing_date}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="company_code">Código de empresa</label>
                            <input type="number" class="form-control" name="company_code" id="company_code" value="{{$contract->company_code}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="employee_code">Código de trabajador</label>
                            <input type="number" class="form-control" name="employee_code" id="employee_code" value="{{$contract->employee_code}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="INEM_code">Código de INEM</label>
                            <input type="text" class="form-control" name="INEM_code" id="INEM_code" value="{{$contract->INEM_code}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="processed">Tramitado</label>
                            <select id="processed" name="processed" class="form-control">
                                <option value="0" <?php if($contract->processed != '1') echo 'selected' ?>>No</option>
                                <option value="1" <?php if($contract->processed == '1') echo 'selected' ?>>Si</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="float-right">
                        <a href="{{url('viewLimitedContracts')}}"><button class="btn bg-white border-deep-blue my-4" type="button"><strong class="color-deep-blue">Volver</strong></button></a>
                        <button class="btn bg-deep-blue my-4" type="submit"><strong class="text-white">Guardar</strong></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="color-deep-blue mb-4"><strong>Datos del empleado</strong></h2>

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
                    if($staff){ 
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

@stop
@section('footer')
