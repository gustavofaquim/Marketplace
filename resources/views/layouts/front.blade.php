<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style_front.css')}}">
    <script src="https://kit.fontawesome.com/3359b3a2da.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js')}}"></script>

    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
    @yield('stylesheets')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="{{route('home')}}">Marketplace</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <div id="blocoNav" class="ul-search mr-auto">
            <ul class="navbar-nav">
                <form id="buscaMenu" class="form-inline my-2 my-lg-0" action="{{route('search')}}">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar por nome, código, descrição" aria-label="Search" id="a" name="a">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </ul>
        </div>


        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">

                @guest
                    <li class="nav-item dropdown" id="menu-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Entre, ou crie sua conta</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('login')}}">Faça Login</a>
                                <a class="dropdown-item" href="{{route('register')}}">Ainda não é cliente? Crie sua conta</a>
                        </div>
                    </li>
                @endguest

                @auth
                    <li class="nav-item  @if(request()->is('')) active @endif">
                        <a href="{{route('user.edit')}}" class="nav-link"> {{ Auth::user()->name }}</a>
                    </li>

                    <li class="nav-item  @if(request()->is('my-orders')) active @endif">
                        <a href="{{route('user.orders')}}" class="nav-link">Meus Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault();
                                                                  document.querySelector('form.logout').submit(); ">Sair</a>

                        <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                            @csrf
                        </form>
                    </li>
                @endauth

                <li class="nav-item">
                    <a href="{{route('cart.index')}}" class="nav-link">
                        @if(session()->has('cart'))
                            <span class="badge badge-danger">{{count(session()->get('cart'))}}</span>
                        @endif
                        <i class="fa fa-shopping-cart fa-2x"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light  sub-menu">
    <ul class="navbar-nav">
           <!-- <li class="nav-item @if(request()->is('/')) active @endif">
                <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li> -->

           <!-- @if($categories->count() > 0)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorias</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($categories as $category)
                            <a class="dropdown-item" href="{{route('category.single', ['slug' => $category->slug])}}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </li>
            @endif -->

            @foreach($categories as $category)
                <li class="nav-item nav-item @if(request()->is('category/' . $category->slug)) active @endif">
                    <a class="nav-link" href="{{route('category.single', ['slug' => $category->slug])}}">{{ $category->name }}</a>
                </li>
            @endforeach

    </ul>

</nav>

<div class="container" id="container">
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
    @yield('scripts')
</body>
</html>
