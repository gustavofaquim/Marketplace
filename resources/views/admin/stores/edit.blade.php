@extends('layouts.app')

@section('content')

    <h1> Criar Loja</h1>

    <form action="{{ route('admin.stores.update', ['store' => $store->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label for="">Nome Loja</label>
            <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror"" value="{{$store->name}}">
        
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror

        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" id="" class="form-control @error('description') is-invalid @enderror"" value="{{$store->description}}">

            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror

        </div>

        <div class="form-group">
            <label for="">Telefone</label>
            <input type="text" name="phone" id="" class="form-control @error('phone') is-invalid @enderror"" value="{{$store->phone}}">
       
            @error('phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
       
        </div>

        <div class="form-group">
            <label for="">WhatsApp</label>
            <input type="text" name="mobile_phone" id="" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{$store->mobile_phone}}">
        
        
            @error('mobile_phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
        
        </div>

        <div class="form-grup">
            <p>
                <img src="{{asset('storage/' . $store->logo)}}" alt="">
            </p>
            <label for="">Logo da loja</label>
            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">


            @error('logo')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror

        </div>        


        <div class="form-group">
            <input type="submit" value="Atualizar Loja" class="btn btn-lg btn-success">
        </div>

    </form>


@endsection