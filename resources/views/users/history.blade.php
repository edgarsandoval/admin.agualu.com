@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Ver historial
    @parent
@stop

{{-- page level styles --}}
@section('styles')
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/pages/dataTables.bootstrap.css') }}"/>
    <!--End of plugin styles-->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/pages/tables.css') }}"/>
    <!-- end of page level styles -->
@stop

{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-users"></i>
                        Ver historial
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
                        <li class="breadcrumb-item active">Ver historial</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-header bg-white">
                    Mi historial
                </div>
                <div class="card-block m-t-25">
                    <div>
                        <div>
                            <table class="table  table-striped table-bordered table-hover dataTable no-footer" id="editable_table" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc wid-20" tabindex="0" rowspan="1" colspan="1">Periodo</th>
                                        <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Inicio</th>
                                        <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Fin</th>
                                        <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $report->period }}</td>
                                            <td>{{ date('l d \d\e M \d\e\l Y', strtotime($report->from)) }}</td>
                                            <td>{{ date('l d \d\e M \d\e\l Y', strtotime($report->to)) }}</td>
                                            <td>
                                                <a class="delete hidden-xs hidden-sm" data-toggle="tooltip" data-placement="top" title="Ver reporte" href="{{ route('history', $report->period)}}">
                                                    <i class="fa fa-file text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    <!--Plugin scripts-->
    <script type="text/javascript" src="{{ asset('vendor/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/buttons.colVis.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/buttons.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/buttons.print.min.js') }}"></script>
    <!--End of plugin scripts-->
    <!--Page level scripts-->
    <script type="text/javascript" src="{{ asset('js/pages/datatables.js') }}"></script>
    <!-- end page level scripts -->
@stop
