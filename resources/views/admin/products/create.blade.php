@extends('layouts.app')

@section('content')

    <h1> Criar Produto</h1>

    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Nome Produto</label>
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
            <label for="">Preço</label>
            <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">
        
            @error('price')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror

        </div>

        <div class="form-group">
            <label for="">Body</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror" value="{{old('body')}}"></textarea>

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
                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="">Quantidade em estoque</label>
            <input type="number" name="in_stock" id="in_stock" class="form-control @error('in_stock') is-invalid @enderror" value="{{old('in_stocktock')}}">
        
            @error('in_stock')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror

        </div>

        <div class="form-grup">
            <label for="">Fotos do produto</label>
            <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror " multiple>

            @error('photos.*') 
            
                <div class="invalid-feedback">
                    {{$message}}
                </div>  
            
            @enderror

        </div>


        <div class="form-group">
            <input type="submit" value="Criar Produto" class="btn btn-lg btn-success">
        </div>

    </form>


@endsection

@section('scripts')
    <script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
    <script>
        $('#price').maskMoney({prefix: 'R$ ', allowNegative: false, thousands: '.', decimal: ','});
    </script>
@endsection