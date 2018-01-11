@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Ordenes
    @parent
@stop
{{-- page level styles --}}
@section('styles')
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/dataTables.bootstrap.css')}}"/>
    <!--End of plugin styles-->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/tables.css')}}"/>
    <!-- end of page level styles -->
@stop


{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6 col-sm-4">
                    <h4 class="nav_top_align">
                        <i class="fa fa-file-o"></i>
                        Mostrar Ordenes
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
                            <a href="#">Ordenes</a>
                        </li>
                        <li class="active breadcrumb-item">Mostrar Ordenes</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-header bg-white">
                    Ordenes Registradas
                </div>
                <div class="card-block m-t-35" id="user_body">
                    <div class="table-toolbar">
                        <div class="btn-group float-right users_grid_tools">
                            <div class="tools"></div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <table class="table  table-striped table-bordered table-hover dataTable no-footer" id="editable_table" role="grid">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc wid-20" tabindex="0" rowspan="1" colspan="1">id</th>
                                    <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Socio</th>
                                    <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Cantidad de puntos</th>
                                    <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Estado</th>
                                    <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr role="row" class="even">
                                            <td class="sorting_1">{{ $order->id }}</td>
                                            <td class="center">{{ $order->full_name }}</td>
                                            <td class="center">{{ $order->amount }} puntos</td>
                                            @if ($order->status == 'En proceso')
                                                <td class="center"><span class="label label-sm label-warning">{{ $order->status }}</span></td>
                                            @elseif($order->status == 'Completado')
                                                <td class="center"><span class="label label-sm label-success">{{ $order->status }}</span></td>
                                            @else
                                                <td class="center"><span class="label label-sm label-danger">{{ $order->status }}</span></td>
                                            @endif
                                            <td>
                                                <a href="{{ route('view_order', $order->id ) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Ver pedido">
                                                    <i class="fa fa-eye text-success"></i>
                                                </a>&nbsp; &nbsp;
                                                @role('admin')
                                                @if ($order->status == 'En proceso')
                                                    <a class="edit" data-toggle="tooltip" data-placement="top" title="Editar" href="{{ route('edit_order', $order->id)}}">
                                                        <i class="fa fa-pencil text-warning"></i>
                                                    </a>
                                                @endif
                                                @endrole
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
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
