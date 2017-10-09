@extends('layouts.default')

@section('title')
    Crear Rol
    @parent
@stop

@section('styles')
   <!-- plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/jasny-bootstrap/css/jasny-bootstrap.min.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/bootstrapvalidator/css/bootstrapValidator.min.css') }}"/>
    <!--end of page level css-->
@stop

@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6 col-sm-4">
                    <h4 class="nav_top_align">
                        <i class="fa fa-cogs"></i>
                        Crear rol
                    </h4>
                </div>
                <div class="col-lg-6 col-sm-8 col-12">
                    <ol class="breadcrumb float-right  nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('roles') }}">Roles</a>
                        </li>
                        <li class="breadcrumb-item active">Crear Rol</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                    <div class="card-header bg-white">
                        Crear Rol
                    </div>
                <div class="card-block m-t-35">
                    {!! Form::open(['route' => 'store_role', 'method' => 'POST', 'id' => 'role-form', 'class' => 'form-horizontal login_validator'])!!}
                        @include('partials.role-form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <!-- plugin scripts-->
    <script type="text/javascript" src="{{ asset('js/pluginjs/jasny-bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/holderjs/js/holder.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrapvalidator/js/bootstrapValidator.min.js') }}"></script>
    <!-- end of plugin scripts-->
    {{-- <script type="text/javascript" src="{{asset('assets/js/pages/validation.js')}}"></script> --}}
    <script type="text/javascript" src="{{ asset('js/pages/forms.js') }}"></script>
    <!-- end of page level scripts-->
@stop
