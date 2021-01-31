@extends('plantillas.plantilla1')
@section('titulo')
Academia
@endsection
@section('cabecera')
Detalles alumno
@endsection
@section('contenido')
@if($text=Session::get('mensaje'))
<p class="alert alert-info my-3">{{$text}}</p>
@endif
<span class="clearfix"></span>
    <div class="card text-white bg-info mt-5 mx-auto" style="max-width: 65rem;">
        <div class="card-header text-center"><b>{{($alumnos->nombre)}}</b></div>
        <div class="card-body" style="font-size: 1.3em">
            <h5 class="card-title text-center">ID: {{($alumnos->id)}}</h5>
            <p class="card-text">
            <div class="float-right"><img src="{{asset($alumnos->foto)}}" width="185x" heght="185px" class="rounded-circle"></div>
            <p class="card-text"><b>Nombre:</b> {{$alumnos->nombre}}</p>
            <p class="card-text"><b>Apellidos:</b> {{$alumnos->apellidos}}</p>
            <p class="card-text"><b>Email:</b> {{$alumnos->email}}</p>
            <p class="card-text"><b>Telefono:</b> {{$alumnos->telefono}}</p>

    <a href="{{route('alumnos.index')}}" class="mt-3 float-right btn btn-success">Inicio</a>
        </div>
    </div>
@endsection
