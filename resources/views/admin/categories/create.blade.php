@extends('layouts.app')

@section('content')

    <h1> Criar Categoria</h1>

    <form action="{{ route('admin.categories.store') }}" method="post" >
        @csrf
        <div class="form-group">
            <label for="">Nome Categoria</label>
            <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
        
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
        
        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" id="" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}">

            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
        
        </div>


        <div class="form-group">
            <input type="submit" value="Criar Categoria" class="btn btn-lg btn-success">
        </div>

    </form>


@endsection