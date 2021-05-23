@extends('layouts.app')

@section('content')

    <h1> Criar Loja</h1>

    <form action="{{ route('admin.stores.store') }}" method="post" enctype="multipart/form-data" >
        @csrf
        <div class="form-group">
            <label for="">Razão Social</label>
            <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">

            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror

        </div>

        <div class="form-group">
            <label for="">CNPJ</label>
            <input type="text" name="cnpj" id="cnpj" class="form-control @error('cnpj') is-invalid @enderror" value="{{old('cnpj')}}">

            @error('cnpj')
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
            <label for="">Telefone</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}">

            @error('phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror

        </div>

        <div class="form-group">
            <label for="">WhatsApp</label>
            <input type="text" name="mobile_phone" id="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{old('mobile_phone')}}">

            @error('mobile_phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror

        </div>

        <div class="form-grup">
            <label for="">Logo da loja</label>
            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">


            @error('logo')
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror

        </div>


        <div class="form-group">
            <input type="submit" value="Criar Loja" class="btn btn-lg btn-success">
        </div>

    </form>


@endsection

@section('scripts')
    <script>


        var phone = document.getElementById("phone");

        var imPhone = new Inputmask("(99) 99999-9999");
        imPhone.mask(phone);

        var mobile_poone = document.getElementById("mobile_phone");

        var imMobile_phone = new Inputmask("(99) 9999-9999");
        imMobile_phone.mask(mobile_phone);

        var cnpj = document.getElementById('cnpj');
        var imCnpj = new Inputmask("99.999.999/0009-99");
        imCnpj.mask(cnpj);

       
    </script>

@endsection