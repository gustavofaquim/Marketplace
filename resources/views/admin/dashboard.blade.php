@extends('layouts.app')

@section('content')

<div class="row">
    <h1>Painel Administrativo</h1>

    @if(!$store)
        <div class="">
            Você ainda não possui nenhuma Loja cadastrada, deseja criar uma nova loja agora? 
            <a href="{{ route('admin.stores.create') }}" class="btn btn-lg btn-success">Criar Loja</a>
        </div>
    @else
    @endif
</div>

@endsection