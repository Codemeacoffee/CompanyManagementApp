@extends('layout')
@section('header')
@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{url('deleteCheckOut')}}">
            {{csrf_field()}}
            <input type="hidden" name="checkOutId" value="{{$checkOut->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center">Borrar registro de salida</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea borrar el registro de salida "{{$checkOut->name}}"?
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
            <form action="{{url('editCheckOut')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="checkOutId" value="{{$checkOut->id}}">
                <div class="form-group">
                    <label for="exit_code">Código de salida</label>
                    <input type="text" class="form-control" name="exit_code" id="exit_code" value="{{$checkOut->exit_code}}">
                </div>
                <div class="form-group">
                    <label for="document">Documento</label>
                    <input type="text" class="form-control" name="document" id="document" value="{{$checkOut->document}}">
                </div>
                <div class="form-group">
                    <label for="date">Fecha</label>
                    <input type="date" class="form-control" name="date" id="date" value="{{$checkOut->date}}">
                </div>
                <div class="form-group">
                    <label for="destination">Destino</label>
                    <input type="text" class="form-control" name="destination" id="destination" value="{{$checkOut->destination}}">
                </div>
                <div class="form-group">
                    <label for="sender">Entregado</label>
                    <input type="text" class="form-control" name="sender" id="sender" value="{{$checkOut->sender}}">
                </div>
                <div>
                    <div class="float-right">
                        <a href="{{url('viewCheckOut')}}"><button class="btn bg-white border-deep-blue mt-4" type="button"><strong class="color-deep-blue">Volver</strong></button></a>
                        <button class="btn bg-deep-blue mt-4" type="submit"><strong class="text-white">Guardar</strong></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('footer')
