@extends('layout')
@section('header')
@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{url('deleteFormativeAction')}}">
            {{csrf_field()}}
            <input type="hidden" name="formativeActionId" value="{{$formativeAction->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center">Borrar acción formativa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea borrar la acción formativa "{{$formativeAction->name}}"?
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
        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12 offset-0">
            <div>
                <div class="text-right">
                    <button class="btn btn-danger my-2" type="button" data-toggle="modal" data-target="#deleteModal"><strong class="text-white">Borrar</strong></button>
                </div>
            </div>
            <form action="{{url('editFormativeAction')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="formativeActionId" value="{{$formativeAction->id}}">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$formativeAction->name}}">
                </div>
                <div class="form-group">
                    <label for="type">Tipo</label>
                    <input type="text" class="form-control" name="type" id="type" value="{{$formativeAction->type}}">
                </div>
                <div class="form-group">
                    <label for="speciality">Especialidad</label>
                    <input type="text" class="form-control" name="speciality" id="speciality" value="{{$formativeAction->speciality}}">
                </div>
                <div class="form-group">
                    <label for="year">Año</label>
                    <input type="number" class="form-control" name="year" id="year" value="{{$formativeAction->year}}">
                </div>
                <div class="form-group">
                    <label for="closed">Cerrado</label>
                    <select id="closed" name="closed" class="form-control">
                        <option value="0" <?php if($formativeAction->closed != '1') echo 'selected' ?>>No</option>
                        <option value="1" <?php if($formativeAction->closed == '1') echo 'selected' ?>>Si</option>
                    </select>
                </div>
                <div>
                    <div class="float-right">
                        <a href="{{url('viewFormativeAction')}}"><button class="btn bg-white border-deep-blue mt-4" type="button"><strong class="color-deep-blue">Volver</strong></button></a>
                        <button class="btn bg-deep-blue mt-4" type="submit"><strong class="text-white">Guardar</strong></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('footer')
