@extends('layout')
@section('header')
@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{url('deleteCheckIn')}}">
            {{csrf_field()}}
            <input type="hidden" name="checkInId" value="{{$checkIn->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center">Borrar registro de entrada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea borrar el registro de entrada "{{$checkIn->name}}"?
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
            <form action="{{url('editCheckIn')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="checkInId" value="{{$checkIn->id}}">
                <div class="form-group">
                    <label for="receiver">Receptor</label>
                    <input type="text" class="form-control" name="receiver" id="receiver" value="{{$checkIn->receiver}}">
                </div>
                <div class="form-group">
                    <label for="entry_code">Código de entrada</label>
                    <input type="text" class="form-control" name="entry_code" id="entry_code" value="{{$checkIn->entry_code}}">
                </div>
                <div class="form-group">
                    <label for="document">Documento</label>
                    <input type="text" class="form-control" name="document" id="document" value="{{$checkIn->document}}">
                </div>
                <div class="form-group">
                    <label for="date">Fecha</label>
                    <input type="date" class="form-control" name="date" id="date" value="{{$checkIn->date}}">
                </div>
                <div class="form-group">
                    <label for="destination">Destino</label>
                    <input type="text" class="form-control" name="destination" id="destination" value="{{$checkIn->destination}}">
                </div>
                <div class="form-group">
                    <label for="sender">Entregado</label>
                    <input type="text" class="form-control" name="sender" id="sender" value="{{$checkIn->sender}}">
                </div>
                <div>
                    <div class="float-right">
                        <a href="{{url('viewCheckIn')}}"><button class="btn bg-white border-deep-blue mt-4" type="button"><strong class="color-deep-blue">Volver</strong></button></a>
                        <button class="btn bg-deep-blue mt-4" type="submit"><strong class="text-white">Guardar</strong></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('footer')
