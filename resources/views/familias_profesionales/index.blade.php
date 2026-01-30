@extends('layout')
@section('title', 'Listado de Familias Profesionales')
@section('contenido')

<div class="container pt-4">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Imagen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($familias as $familia)       
                <tr>
                    <th>
                        <a href="{{ route('familias_profesionales.show', $familia->id) }}" class="btn btn-primary"><i class="bi bi-search"></i></a>
                        <a href="{{ route('familias_profesionales.edit', $familia->id) }}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                        <a href="{{ route('familias_profesionales.destroy', $familia->id) }}" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                    </th>
                    <td>{{ $familia->nombre }}</td>
                    <td>
                        @if($familia->imagen)
                            <img src="{{ $familia->imagen }}" alt="{{ $familia->nombre }}" style="height: 50px;">
                        @else
                            No imagen
                        @endif
                    </td>
                </tr>
            @endforeach

            {{ $familias->links() }}

        </tbody>
    </table>

    <a class="btn btn-primary" href="{{ route('familias_profesionales.create') }}">Nueva Familia Profesional</a>

</div>

@endsection
