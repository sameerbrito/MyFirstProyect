@extends('layouts.app')
@section('title','Editar')

@section('content')
    <div class="container edit">
        <h1>Editar</h1>
        <div class="abs-center">
            <form class="outline-form" action="{{route('crud.update', $test)}}" method="POST" enctype="multipart/form-data"> 
                @csrf 
                @method('PUT')
                <div class="row mb-4">
                    <div class="col">
                      <div class="form-outline">
                        <label class="form-label" for="Nombre">Nombre</label>
                        <input type="text" name="name" id="" value="{{$test->name}}" class="form-control"/>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-outline">
                        <label class="form-label" for="Apellido">Apellido</label>
                        <input type="text" name="last_name" id="" value="{{$test->last_name}}" class="form-control"/>
                      </div>
                    </div>
                </div>
                <div class="btn-send"><button class="btn btn-primary btn-block mb-4"><i class="bi bi-download"></i> Guardar</button></div>
            </form>
        </div>
    </div>
@endsection