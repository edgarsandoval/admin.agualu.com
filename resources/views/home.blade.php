@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Dashboard
    @parent
@stop

{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="nav_top_align">
                        <i class="fa fa-home"></i>
                        Dashboard
                    </h4>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-block m-t-25">
                    <div>
                        <h4>Bienvenido {{ Auth::user()->full_name }}</h4>
                    </div>
                    <div class="form-group row m-t-25">
                        <p style="padding: 35px;">El contenido principal de esta vista está aún por definirse, sin embargo puedes navegar por el menú de la izquierda.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
@stop

{{-- page level scripts --}}
@section('scripts')
    <!--page level scripts -->
    <script type="text/javascript" src="{{ asset('js/pages/dashboard.js') }}"></script>
    <!-- end page level scripts -->
@stop
