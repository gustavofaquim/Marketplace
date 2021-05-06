@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
          <a href="{{route('admin.notifications.read.all')}}" class="btn btn-lg btn-success">Marcar todas como lidas</a>
          <hr>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Notificação</th>
                <th>Criado em</th>
                <th>Tempo de espera</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($naoLidas as $nl)
                <tr>
                    <td>{{$nl->data['message']}}</td>
                    <!-- Carbon PHP, metodos para formatação de horas -->
                    <td>{{$nl->created_at->format('d/m/y h:m:s')}}</td>
                    <td>{{$nl->created_at->locale('pt')->diffForHumans()}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('admin.notifications.read', ['id'=> $nl->id])}}" class="btn btn-sm btn-primary">Marcar como lida</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="alert alert-warning">Não existem notificações</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
    
    </div>
@endsection