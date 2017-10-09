@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Editar Permiso
    @parent
@stop
{{-- page level styles --}}
@section('styles')
   <!-- plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" />
    <!--end of page level css-->
@stop

@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-pencil"></i>
                        Editar Permiso
                    </h4>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="index">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('permissions') }}">Permisos</a>
                        </li>
                        <li class="breadcrumb-item active">Editar Permiso</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                    <div class="card-header bg-white">
                        Editar permiso
                    </div>
                <div class="card-block m-t-35">
                    {!! Form::model($permission, ['route' => ['update_permission', $permission->id], 'method' => 'PUT', 'id' => 'permission-form', 'class' => 'form-horizontal login_validator'])!!}
                        @include('partials.permission-form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
