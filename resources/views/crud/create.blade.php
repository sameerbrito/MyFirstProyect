@extends('layouts.app')
@section('title','Crear')

@section('content')  
    <div class="container edit">
        <h1>Crear</h1>
        <div class="abs-center">
            <form class="outline-form" action="{{route('crud.store')}}" method="POST" enctype="multipart/form-data">
            @csrf 
            <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="Nombre">Nombre</label>
                    <input class="form-control" type="text" name="name" id="" value="">
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="Apellido">Apellido</label>
                    <input class="form-control" type="text" name="last_name" id="" value="">
                  </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>Favor llenar todos los campos</strong>
                </div>
            @endif
            <div class="btn-send"><button class="btn btn-primary btn-block mb-4"><i class="bi bi-download"></i> Agregar</button></div>
            </form>
        </div>
    </div>
@endsection 