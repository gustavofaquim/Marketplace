@extends('layouts.app')

@section('content')

    <h1>Atualizar produto</h1>

    <form action="{{ route('admin.products.update', ['product' => $product->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Nome Produto</label>
            <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}">
        
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror

        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" id="" class="form-control @error('description') is-invalid @enderror" value="{{$product->description}}">
        
            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
        
        </div>

        <div class="form-group">
            <label for="">Preço</label>
            <input type="text" name="price" id="" class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}">
        
            @error('price')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
        
        </div>

        <div class="form-group">
            <label for="">Body</label>
            <input type="text" name="body" id="" class="form-control @error('body') is-invalid @enderror" value="{{$product->body}}">
        
            @error('body')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
        
        </div>

  
        <div class="form-group">
            <label for="">Categorias</label>
            <select name="categories[]" id="" class="from-control" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                    
                    @if($product->categories->contains($category)) selected @endif
                    
                    > {{ $category->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-grup">
            <label for="">Fotos do produto</label>
            <input type="file" name="photos[]" class="form-control @error('photos') is-invalid @enderror " multiple>

            @error('photos') 
            
                <div class="invalid-feedback">
                    {{$message}}
                </div>  
            
            @enderror

        </div>

        <div class="form-group">
            <input type="submit" value="Atualizar Produto" class="btn btn-lg btn-success">
        </div>
  
    </form>

    <hr>

    <div class="row">
        @foreach($product->photos as $photo)
            <div class="col-4 text-center">
                <img src="{{asset('storage/'. $photo->image)}}" alt="" class="img-fluid">
                <form action="{{route('admin.photo.remove')}}" method="POST">    
                    @csrf
                    <input type="hidden" name="photoName" value="{{$photo->image}}">
                    <button type="submit" class="btn btn-danger">REMOVER</button>
                </form>
            </div>
        @endforeach
    </div>


@endsection