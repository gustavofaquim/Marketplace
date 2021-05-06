@extends('layouts.app')

@section('content')

    <h1>Atualizar Categoria</h1>

    <form action="{{ route('admin.categories.update', ['category' => $category->id])}}" method="POST" >
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Nome Categoria</label>
            <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" value="{{$category->name}}">
        
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror

        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" id="" class="form-control @error('description') is-invalid @enderror" value="{{$category->description}}">
        
            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
        
        </div>


        <div class="form-group">
            <input type="submit" value="Atualizar Categoria" class="btn btn-lg btn-success">
        </div>

    </form>


@endsection