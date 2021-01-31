@extends('plantillas.plantilla1')
@section('titulo')
Alumno nuevo
@endsection
@section('cabecera')
Crear Alumno
@endsection
@section('contenido')
@if ($errors->any())
    <div class="alert alert-danger my-3 p-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form name="f" action="{{route('alumnos.store')}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="form-row">
    <div class="col">
        <label for="nombre" class="col-form-label">Nombre</label>
        <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="nombre" required>
    </div>
    <div class="col">
        <label for="apellidos" class="col-form-label">Apellidos</label>
        <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" id="apellidos" required>
    </div>
    <div class="col">
        <label for="telefono" class="col-form-label">Teléfono</label>
        <input type="number" name="telefono" class="form-control" placeholder="telefono" id="telefono">
    </div>
</div>
<div class="form-row mt-3">
    <div class="col">
        <label for="email" class="col-form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="email" id="email" required>
    </div>
</div>
<div class="row mt-4">
<div class="col">
    <input type='file' name='foto' class="form-control-file">
</div>
<div class="col">
    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Crear</button>
    <button class="btn btn-warning" type="reset"><i class="fa fa-brush"></i> Limpiar</button>
    <a href="{{route('alumnos.index')}}" class="btn btn-primary"><i class="fa fa-house-user"></i> Inicio</a>
</div>

</div>
</form>
@endsection
