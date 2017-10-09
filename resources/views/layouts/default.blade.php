<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
         | Agualu.com
        @show
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}"/>

    <!-- global styles-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/components.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/custom.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/mint_black_skin.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/vendor.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/patch.css') }}">
    <!-- end of global styles-->

    @yield('styles')
</head>

<body  class="fixed_menu">
<div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 999999">
        <img src="{{asset('img/loader.gif')}}" style=" width: 40px;" alt="loading...">
    </div>
</div>
<div class="bg-dark" id="wrap">
    <div id="top">
        <!-- .navbar -->
        <nav class="navbar navbar-static-top">
            <div class="container-fluid m-0">
                <a class="navbar-brand float-left text-center" href="index">
                    <h4 class="text-white"><img src="{{asset('img/logow.png')}}" class="admin_img" alt="logo"> AGUALU</h4>
                </a>
                <div class="menu">
                    <span class="toggle-left" id="menu-toggle">
                        <i class="fa fa-bars text-white"></i>
                    </span>
                </div>
                <div class="topnav dropdown-menu-right float-right">
                    <div class="btn-group">
                        <div class="user-settings no-bg">
                            <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                                <img src="{{asset('img/admin.jpg')}}" class="admin_img2 rounded-circle avatar-img" alt="avatar"> <strong>{{ Auth::user()->first_name }}</strong>
                                <span class="fa fa-sort-down white_bg"></span>
                            </button>
                            <div class="dropdown-menu admire_admin">
                                <a class="dropdown-item title" href="{{ route('profile')}}" disabled>
                                    {{ Auth::user()->full_name }}</a>
                                <a class="dropdown-item" href="lockscreen" ><i class="fa fa-lock"></i>
                                    Bloquear Pantalla</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>
                                    Salir</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.container-fluid --> </nav>
        <!-- /.navbar -->
        <!-- /.head --> </div>
    <!-- /#top -->
    <div class="wrapper">
        <div id="left" class="fixed">
            <div class="menu_sction menu_scroll">
                <div class="media user-media bg-dark dker">
                    <div class="user-media-toggleHover">
                        <span class="fa fa-user"></span>
                    </div>
                    <div class="user-wrapper bg-dark">
                        <a class="user-link" href="">
                    <img class="media-object img-thumbnail user-img rounded-circle admin_img3" alt="User Picture" src="{{asset('img/admin.jpg')}}"></a>
            </div>
        </div>
        <!-- #menu -->
        <ul id="menu" class="bg-blue dker">
            @role('admin')
            <li {!! (Request::is('index')? 'class="active"':"") !!}>
                <a href="{{ route('home') }} ">
                    <i class="fa fa-home"></i>
                    <span class="link-title">&nbsp;Dashboard</span>
                </a>
            </li>
            @endrole
            <li {!! (Request::is('users')|| Request::is('add_user') ? 'class="active"':"")!!}>
            <a href="#">
                    <i class="fa fa-user"></i>
                    <span class="link-title">&nbsp; Usuarios</span>
                    <span class="fa arrow"></span>
                </a>
                <ul>
                    <li {!! (Request::is('usuarios')? 'class="active"':"") !!}>
                        <a href="{{ route('users')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Mostrar Usuarios
                        </a>
                    </li>
                    <li {!! (Request::is('usuarios/añadir')? 'class="active"':"") !!}>
                        <a href="{{ route('add_user')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Añadir Usuario
                        </a>
                    </li>
                </ul>
            </li>

            <li {!! (Request::is('rangos')|| Request::is('rangos/añadir') ? 'class="active"':"")!!}>
            <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span class="link-title">&nbsp; Rangos</span>
                    <span class="fa arrow"></span>
                </a>
                <ul>
                    <li {!! (Request::is('rangos')? 'class="active"':"") !!}>
                        <a href="{{ route('ranges')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Mostrar Rangos
                        </a>
                    </li>
                    <li {!! (Request::is('rangos/añadir')? 'class="active"':"") !!}>
                        <a href="{{ route('add_range')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Añadir Rango
                        </a>
                    </li>
                </ul>
            </li>
            <li {!! (Request::is('productos') ? 'class="active"':"")!!}>
                <a href="{{ route('products') }}">
                    <i class="fa fa-pagelines"></i>
                    &nbsp; Productos Biostyle
                </a>
            </li>
            <li {!! (Request::is('roles')|| Request::is('permisos') ? 'class="active"':"")!!}>
            <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span class="link-title">&nbsp; Configuración </span>
                    <span class="fa arrow"></span>
                </a>
                <ul>
                    <li {!! (Request::is('roles')? 'class="active"':"") !!}>
                        <a href="{{ route('roles')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Administrar Roles
                        </a>
                    </li>
                    <li {!! (Request::is('permisos')? 'class="active"':"") !!}>
                        <a href="{{ route('permissions')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Administrar Permisos
                        </a>
                    </li>
                </ul>
            </li>



        </ul>
                </div>
        <!-- /#menu -->
    </div>
    <!-- /#left -->
    <div id="content" class="bg-container">
        <!-- Content -->
        @yield('content')
        <!-- Content end -->
    </div>

</div>
<!-- # right side -->
</div>

<!-- global scripts-->
<script type="text/javascript" src="{{ asset('js/components.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vendor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/core.js') }}"></script>
<!-- end of global scripts-->
<!-- page level js -->
@yield('scripts')
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script type="text/javascript">

@if($errors->any())
   @foreach ($errors->all() as $error)
      toastr.error('{{ $error }}', '¡Error!');
  @endforeach
@endif

if(lscache.get('user') == null)
    lscache.set('user', JSON.parse('{!! json_encode(Auth::user()->toArray()) !!}'));
</script>
<!-- end page level js -->
</body>
</html>
