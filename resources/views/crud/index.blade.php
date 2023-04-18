@extends('layouts.app')
@section('title','Home')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success" role="alert">
            <strong>{{Session::get('success')}}</strong>
        </div>
    @endif
    <div class="contenedor">
        <div class="div-search">                
            <form action="{{route('crud.index')}}" method="GET" class="d-flex filtro">
                <input class="form-control w-25 me-2" name="Search" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success w-10 h-25" type="submit">Search</button>
            </form>
        </div>
        <table class="table table-hover">
            <thead>
                <tr class="text">
                    <th class="num">#</th>
                    <th class="nem">Name</th>
                    <th class="nem">Last Name</th>
                    <th class="act" colspan="2">Acciones</th>
                </tr>
            </thead>
            @foreach ($test as $person)
            <tbody>
                <tr>
                    <td>{{$person->id}}{{--{{$loop->iteration}}--}}</td>
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
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Quieres ELIMINAR los datos del estudiante?')"><i class="bi bi-trash2-fill"></i> Borrar</button>
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
    <div class="btn-send"><a href="{{route('crud.create')}}"><button class="btn btn-success"><i class="bi bi-file-earmark-plus-fill"></i> Crear</button></a></div>
@endsection