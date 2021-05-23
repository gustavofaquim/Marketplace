<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Marketplace</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/3359b3a2da.js" crossorigin="anonymous"></script>
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 40px;">
            <a class="navbar-brand" href="{{ route('home') }}">Marketplace</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                @auth
                    <ul class="navbar-nav mr-auto">
                        
                        @if(auth()->user()->store()->exists())
                            <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                                <a class="nav-link" href="{{ route('admin.stores.index') }}">Loja <span class="sr-only">(página atual)</span></a>
                            </li>
                            
                            <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                                <a class="nav-link" href="{{ route('admin.products.index') }}">Produtos</a>
                            </li>

                            <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                                <a class="nav-link" href="{{ route('admin.categories.index') }}">Categorias</a>
                            </li>

                            <li class="nav-item @if(request()->is('admin/orders*')) active @endif">
                                <a class="nav-link" href="{{ route('admin.orders.my') }}">Pedidos <span class="sr-only">(página atual)</span></a>
                            </li>
                        @endif
                    </ul>
                
                    <div class="my2-2 my-lg-0">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="{{route('admin.notifications.index')}}" class="nav-link">
                                   @if((auth()->user()->unreadNotifications()->count()) > 0 )
                                    <span class="badge badge-danger">{{auth()->user()->unreadNotifications()->count()}}</span>
                                   @endif
                                   <i class="fa fa-bell"></i> </a>
                            </li>
                            <li class="nav-link">
                                <span>{{ auth()->user()->name}}</span>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('form.logout').submit();">Sair</a>
                                <form action="{{ route('logout') }}"  class='logout' method="POST" style="display:none;"> @csrf </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </nav>


        <div class="container">
             @if(session('msg'))
                <div class="alert alert-success msg" role="alert">
                    <i class="fas fa-check"></i> {{ session('msg') }}
                </div>
             @elseif(session('msg-warning'))
                 <div class="alert alert-warning msg" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('msg-warning') }}
                </div>
             @endif
             
            @yield('content')
        </div>

        <!-- <script 
            src="https://code.jquery.com/jquery-3.6.0.min.js" 
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
            crossorigin="anonymous">
        </script>-->

        
        <script src="{{asset('js/app.js')}}"></script>
        @yield('scripts')
    </body>
</html>