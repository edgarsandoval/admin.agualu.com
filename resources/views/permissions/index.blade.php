@extends('layouts.default')

@section('title')
    Administrar Permisos
    @parent
@stop

@section('styles')
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/pages/dataTables.bootstrap.css') }}"/>
    <!--End of plugin styles-->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/pages/tables.css') }}"/>
    <!-- end of page level styles -->
@stop

@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6 col-sm-4">
                    <h4 class="nav_top_align">
                        <i class="fa fa-cogs"></i>
                        Administrar Permisos
                    </h4>
                </div>
                <div class="col-lg-6 col-sm-8 col-12">
                    <ol class="breadcrumb float-right  nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Permisos</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-header bg-white">
                    Permisos
                </div>
                <div class="card-block m-t-35">
                    <div>
                        <div class="m-b-10">
                            <a href="{{ route('add_permission') }}" class="btn btn-success">
                                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                                Añadir permiso
                            </a>
                        </div>
                        <div>
                            <table class="table  table-striped table-bordered table-hover dataTable no-footer" id="editable_table" role="grid">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc wid-20" tabindex="0" rowspan="1" colspan="1">Permiso</th>
                                    <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                    <tr role="row" class="even" data-id={{ $permission->id }}>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <a class="edit" data-toggle="tooltip" data-placement="top" title="Editar" href="{{ route('edit_permission', $permission->id)}}">
                                                <i class="fa fa-pencil text-warning"></i>
                                            </a>&nbsp; &nbsp;
                                            <a class="delete hidden-xs hidden-sm btn-delete" data-toggle="tooltip" data-placement="top" title="Eliminar" href="#">
                                                <i class="fa fa-trash text-danger"></i>
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
    </div>
    {!! Form::open(['route' => ['delete_permission', ':ID'], 'method' => 'DELETE', 'class' => 'form-delete']) !!}
    {!! Form::close() !!}
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
