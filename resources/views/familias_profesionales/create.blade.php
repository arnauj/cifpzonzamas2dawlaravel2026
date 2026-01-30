@extends('layout')
@section('title', 'Formulario de Familia Profesional')
@section('contenido')

<div class="container pt-4">
    <ul>
    @foreach ($errors->all() as $error)
        <li  class="text-danger">{{ $error }}</li>
    @endforeach
    </ul>

    @if(isset($datos['exito']) && $datos['exito'])

        <p class="alert alert-success"> {{ $datos['exito'] }} </p>

    @endif

    @php
        $action = '';
        if ($oper == 'create') $action = route('familias_profesionales.create');
        if ($oper == 'edit') $action = route('familias_profesionales.edit');
        if ($oper == 'destroy') $action = route('familias_profesionales.destroy');
    @endphp

    <form action="{{ $action }}" method="POST">

        @csrf

        <input name="id" type="hidden" value="{{ $familia->id }}" />
        
        <div class="mb-3">
            <label for="idnombre" class="@error('nombre') text-danger @enderror form-label">Nombre</label>
            <input {{ $disabled }} value="{{ old('nombre',$familia->nombre) }}" type="text" name="nombre" class="@error('nombre') is-invalid @enderror form-control" id="idnombre" aria-describedby="nombreHelp">
            @error('nombre')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div id="nombreHelp" class="form-text">El nombre de la familia profesional.</div>
        </div>

        <div class="mb-3">
            <label for="idimagen" class="@error('imagen') text-danger @enderror form-label">URL de la Imagen</label>
            <input {{ $disabled }}  value="{{ old('imagen',$familia->imagen) }}" type="text"  name="imagen" class="@error('imagen') is-invalid @enderror form-control" id="idimagen" aria-describedby="imagenHelp">
            @error('imagen')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div id="imagenHelp" class="form-text">URL de la imagen representativa.</div>
        </div>

        <div class="mb-3">
            <label for="iddescripcion" class="@error('descripcion') text-danger @enderror form-label">Descripción</label>
            <textarea  {{ $disabled }} class="@error('descripcion') is-invalid @enderror form-control" name="descripcion" id="iddescripcion" rows="3">{{ old('descripcion',$familia->descripcion) }}</textarea>
            @error('descripcion')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        @if (!$disabled)
            <button type="submit" class="btn btn-primary">Guardar</button>
        @endif

        @if ($oper == 'destroy')
            <button type="submit" class="btn btn-danger">Eliminar Familia</button>
        @endif
    </form>
    
    <a class="btn btn-info mt-3" href="{{ route('familias_profesionales.index') }}">Volver</a>
</div>
@endsection
