@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Reportes de Máquina
    @parent
@stop
@section('styles')
   <!-- plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('vendor/jasny-bootstrap/css/jasny-bootstrap.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('vendor/bootstrapvalidator/css/bootstrapValidator.min.css')}}" />
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
                        Editar Máquina
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
                            <a href="#">Máquinas</a>
                        </li>
                        <li class="breadcrumb-item active">Editar Máquina</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-block m-t-25">
                    <form class="report-form" method="POST">
                        <div class="form-group row">
                            <div class="col-12 col-lg-3 text-lg-right">
                                <label class="col-form-label">Máquina</label>
                            </div>
                            <div class="col-12 col-xl-6 col-lg-8">
                                <select class="form-control" name="machine_id">
                                    @foreach($machines as $machine)
                                        <option value="{{ $machine->id }}">Máquina #{{ $machine->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-lg-3 text-lg-right">
                                <label class="col-form-label">Periodos</label>
                            </div>
                            <div class="col-12 col-xl-6 col-lg-8">
                                <select class="form-control" name="machine_id">
                                    @foreach($reports as $report)
                                        <option value="{{ $report->id }}">Periodo {{ $report->period }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <br>
            <div class="card">
                xd
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
@stop
{{-- page level scripts --}}
@section('scripts')
    <!-- plugin scripts-->
    <script type="text/javascript" src="{{asset('js/pluginjs/jasny-bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/holderjs/js/holder.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
    <!-- end of plugin scripts-->
@stop
