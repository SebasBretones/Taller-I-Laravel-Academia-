@extends('plantillas.plantilla1')
@section('titulo')
    Academia
@endsection
@section('cabecera')
    Alumnos de la academia
@endsection
@section('contenido')
    @if ($text = Session::get('mensaje'))
        <p class="bg-secondary text-white p-2 my-3">{{ $text }}</p>
    @endif
    <form name="search" method="get" action="{{ route('alumnos.index') }}" class="form-inline">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('alumnos.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Crear Alumno</a>
                <a href="{{ route('inicio') }}" class="btn btn-primary"><i class="fa fa-house-user"></i> Inicio</a>
            </div>
            <table class="table table-striped table-dark">
                <thead>
                  <tr>
                    <th scope="col">Detalles</th>
                    <th scope="col" class="align-middle">Nombre</th>
                    <th scope="col" class="align-middle">Apellidos</th>
                    <th scope="col" class="align-middle">Email</th>
                    <th scope="col" class="align-middle">Teléfono</th>
                    <th scope="col" class="align-middle">Imagen</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($alumnos as $alumno)
                  <tr class="align-middle">
                    <th scope="row" class="align-middle">
                    <a href="{{route('alumnos.show', $alumno)}}" class="btn btn-success fa fa-address-card fa-2x">Detalles</a>
                    </th>
                    <td class="align-middle">{{$alumno->nombre}}</td>
                  <td class="align-middle">{{$alumno->apellidos}}</td>
                  <td class="align-middle">{{$alumno->email}}</td>
                  <td class="align-middle">{{$alumno->telefono}}</td>
                  <td class="align-middle">
                  <img src="{{asset($alumno->foto)}}" width='110px' height='110px' class="img-fluid rounded-circle">
                      </td>
                   <td class="align-middle" style="white-space: :nowrap">
                      <form class="form-inline" name="del" action="{{route('alumnos.destroy', $alumno)}}" method='POST'>
                        @method("DELETE")
                        @csrf
                        <button type="submit" onclick="return confirm('¿Borrar Alumno?')" class="btn btn-danger fa fa-trash fa-2x"></button>
                        <a href="{{route('alumnos.edit', $alumno)}}" class="ml-2 fa fa-edit fa-2x btn btn-warning"></a>
                      </form>
                  </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{$alumnos->links()}}

            @endsection
