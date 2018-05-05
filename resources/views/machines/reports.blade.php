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
    <style media="screen">
    .widget_icon_bgclr.icon_align.bg-white {
        padding: 2em;
    }

    .bg_icon.bg_icon_success.float-left {
        font-size: 25px;
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
                        <i class="fa fa-pencil"></i>
                        Reportes de Máquina
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
                        <li class="breadcrumb-item active">Reportes de Máquina</li>
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
                                <select class="form-control" name="period_id" id="period-select">
                                    @foreach($reports as $report)
                                        <option value="{{ $report->id }}">Periodo {{ $report->period }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <div class="alert-message" style="display: none;">
                                    <div class="alert alert-info">
                                        El periodo seleccionado comprende del <strong>&nbsp;</strong> al <strong>&nbsp;</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-lg-9 push-lg-3">
                                <button class="btn btn-primary" type="submit">
                                    Calcular
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <br>
            <div class="row m-t-25">
                <div class="col-sm-6 col-12 col-lg-3 media_max_991">
                    <div class="widget_icon_bgclr icon_align bg-white">
                        <div class="bg_icon bg_icon_success float-left">
                            <i class="fa fa-money text-success" aria-hidden="true"></i>
                        </div>
                        <div class="text-right">
                            <h3 id="widget_count2">$0.00</h3>
                            <p>Ingresos</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-12 col-lg-3 media_max_991">
                <div class="widget_icon_bgclr icon_align bg-white">
                    <div class="bg_icon bg_icon_success float-left">
                        <i class="fa fa-tint text-danger" aria-hidden="true"></i>
                    </div>
                    <div class="text-right">
                        <h3 id="widget_count3">$0.00</h3>
                        <p>Compras</p>
                    </div>
                </div>
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
    <script type="text/javascript" src="{{asset('js/pluginjs/jasny-bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/holderjs/js/holder.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
    <!-- end of plugin scripts-->

    <script type="text/javascript">

    $(document).ready(function(){
            $('.media_max_991').fadeOut();

        $('#period-select').change(function() {
            $.get('/reports/' + $(this).val(), function(response) {
                $('.alert-message strong').first().text(response.data.report.from);
                $('.alert-message strong').last().text(response.data.report.to);
                $('.alert-message').show();
            });
        });


        $('.report-form').submit(function(event) {


            event.preventDefault();
            event.stopPropagation();

            console.log($(this).serialize());

            $.post('/reports', $(this).serialize(), function(response) {
                $('#widget_count2, #widget_count3').html('$' + response.data.amount);
                $('.media_max_991').fadeIn();
            });

        });
    });

    </script>
@stop
