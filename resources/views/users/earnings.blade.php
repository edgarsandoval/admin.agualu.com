@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Ver ganancias
    @parent
@stop

{{-- page level styles --}}
@section('styles')
    <!-- plugin styles-->
    <!--end of page level css-->
    <style media="screen">

    ul.mws-summary {
        margin: 0;
        padding: 0;
    }

    ul.mws-summary li {
        padding: 0;
        margin: 0;
        list-style-type: none;
        font-size: 14px;
        color: #666666;
        padding: 2px 4px;
        border-bottom: 1px dotted #ababab;
        overflow: hidden;
        display: block;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    ul.mws-summary li span {
        font-size: 26px;
        text-align: right;
        margin-right: 3px;
        width: 150px;
        color: #444444;
        display: inline-block;
    }
   </style>
@stop

{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-users"></i>
                        Ver ganancias
                    </h4>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('users') }}">Usuarios</a>
                        </li>
                        <li class="breadcrumb-item active">Ver ganancias</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-header bg-white">
                    Mis ganancias
                </div>
                <div class="card-block m-t-25">
                    <h3>Gancias generadas en el periodo: <span>{{ $period }}</span></h3>
                    <h3>Usuario: <span>{{ sprintf('%s - %s', $user->full_name, $user->member_code) }}</span></h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Total compras Compensables Por Nivel</div>
                                <div class="panel-body">
                                    <ul class="mws-summary">
                                        @foreach ($sales as $sale)
                                            <li>
                                                <span>${{ number_format($sale->amount, 2) }}</span> Nivel {{ $sale->level }}
			                                </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Total Compensación por Nivel</div>
                                <div class="panel-body">
                                    <ul class="mws-summary">
                                        @foreach ($earnings as $earning)
                                            <li>
                                                <span>${{ number_format($earning->amount, 2) }}</span> Nivel {{ $earning->level }} - {{ $earning->percentage }}%
			                                </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
@stop

@section('scripts')
@stop
