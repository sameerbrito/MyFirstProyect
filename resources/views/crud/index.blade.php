@extends('layouts.app')
@section('title','CRUD')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success" role="alert">
            <strong>{{Session::get('success')}}</strong>
        </div>
    @endif
    <div class="contenedor">
        <div id=Left>
            <a href="{{route('crud.create')}}"><button class="btn btn-success"><i class="bi bi-plus-square"></i> Crear</button></a>
        </div>
        <div id=Right>            
        <form action="{{route('crud.index')}}" method="GET" class="d-flex">
            <input class="form-control me-2" name="Search" type="text" placeholder="Buscar" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
        </div>
        <table class="table table-hover">
            <thead>
                <tr class="text">
                    <th class="num">#</th>
                    <th class="nem">Nombre</th>
                    <th class="nem">Apellido</th>
                    <th style="text-align: center" colspan="2">Acciones</th>
                </tr>
            </thead>
            @foreach ($test as $person)
            <tbody>
                <tr>
                    <td>{{$person->id}}</td>
                    <td>{{$person->name}}</td>
                    <td>{{$person->last_name}}</td>
                    <td class="actions">
                        <form action="{{route('crud.edit', $person)}}" method="GET">
                            @csrf 
                            @method('PUT')
                                <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Editar</button>
                        </form>
                    </td>
                    <td class="actions">
                        <form action="{{route('crud.destroy', $person)}}" method="POST">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Quieres ELIMINAR los datos del estudiante?')"><i class="bi bi-trash"></i> Borrar</button>
                        </form>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        <div class="d-flex justify-content-end">
            {{$test->appends(['search'=>$search])}}
        </div>
    </div>
    <example-component></example-component>
@endsection