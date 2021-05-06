@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.products.create') }}" class="btn btn-lg btn-success">Criar Produto</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Loja</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $ap)
                <tr>
                    <td>{{$ap->id }}</td>
                    <td>{{$ap->name}}</td>
                    <td>R$ {{ number_format($ap->price, 2,',','.') }}</td>
                    <td>{{$ap->store->name}}</td>
                    <td>
                        <div class="btn-group">

                        <a href="{{ route('admin.products.edit', ['product' => $ap->id])}}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('admin.products.destroy', ['product' => $ap->id])}}" method=POST>
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-sm btn-danger">Remover</button>
                        </form>

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
    {{$products->links()}}
    </div>
@endsection