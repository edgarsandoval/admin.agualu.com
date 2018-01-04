@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Editar Producto
    @parent
@stop
{{-- page level styles --}}
@section('styles')
   <!-- plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/jasny-bootstrap/css/jasny-bootstrap.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/bootstrapvalidator/css/bootstrapValidator.min.css') }}" />
    <!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-pencil"></i>
                        Editar Producto
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
                            <a href="#">Productos</a>
                        </li>
                        <li class="breadcrumb-item active">Editar Producto</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-block m-t-25">
                    {!! Form::model($product, ['route' => ['update_product', $product->id], 'method' => 'PUT', 'id' => 'tryitForm', 'class' => 'form-horizontal login_validator'])!!}
                        @include('partials.product-form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
@stop
{{-- page level scripts --}}
@section('scripts')
    <!-- plugin scripts-->
    <script type="text/javascript" src="{{ asset('js/pluginjs/jasny-bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/holderjs/js/holder.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrapvalidator/js/bootstrapValidator.min.js') }}"></script>
    <!-- end of plugin scripts-->
    <!-- end of page level scripts-->
@stop
