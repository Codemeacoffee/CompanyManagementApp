@extends('layout')
@section('header')
@section('content')

<div class="imgContainer position-absolute w-100">
    <div class="imgContainer-inside"></div>
</div>

<div class="container-fluid position-relative">
    
    @if($solvedIncidences != 0 || $unsolvedIncidences != 0)
        <h2 class="color-deep-blue mb-4"><strong>Mis incidencias</strong></h2>
    @endif
    
    @if($solvedIncidences != 0)
        <a href="{{URL::to('viewSolvedIncidences')}}">
            <button type="button" class="btn bg-deep-blue color-grey p-3"><i class="glyphicon glyphicon-ok"></i> Solucionadas {{$solvedIncidences}}</button>
        </a>
    @endif
    
    @if($unsolvedIncidences != 0)
        <a href="{{URL::to('viewUnsolvedIncidences')}}">
            <button type="button" class="btn bg-deep-blue color-grey p-3"><i class="glyphicon glyphicon-remove"></i> Sin solucionar {{$unsolvedIncidences}}</button>
        </a>
    @endif
    @if($allUnsolvedIncidences != 0)
        <a href="{{URL::to('viewUnsolvedTableIncidences')}}">
            <button type="button" class="btn bg-deep-blue color-grey p-3"><i class="glyphicon glyphicon-remove"></i> Incidencias de equipos sin solucionar {{$allUnsolvedIncidences}}</button>
        </a>
    @endif
    @if($allUnsolvedExternalIncidences != 0)
        <a href="{{URL::to('viewUnsolvedExternalIncidences')}}">
            <button type="button" class="btn bg-deep-blue color-grey p-3"><i class="glyphicon glyphicon-remove"></i> Incidencias externas sin solucionar {{$allUnsolvedExternalIncidences}}</button>
        </a>
    @endif
    @if($allUnsolvedServiceIncidences != 0)
        <a href="{{URL::to('viewUnsolvedServiceIncidences')}}">
            <button type="button" class="btn bg-deep-blue color-grey p-3"><i class="glyphicon glyphicon-remove"></i> Incidencias de servicio sin solucionar {{$allUnsolvedServiceIncidences}}</button>
        </a>
    @endif
</div>

@stop
@section('footer')
