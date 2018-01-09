@extends('layouts.default')

@section('title')
    Usuarios
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
                        <i class="fa fa-user"></i>
                        Usuarios
                    </h4>
                </div>
                <div class="col-lg-6 col-sm-8 col-12">
                    <ol class="breadcrumb float-right  nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-header bg-white">
                    Usuarios
                </div>
                <div class="card-block m-t-35">
                    <div>
                        <div>
                            <table class="table  table-striped table-bordered table-hover dataTable no-footer" id="editable_table" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc wid-20" tabindex="0" rowspan="1" colspan="1">No. miembro</th>
                                        <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Nombre(s)</th>
                                        <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Apellido</th>
                                        @role('admin')
                                        <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Tipo</th>
                                        @endrole
                                        <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1">Ciudad</th>
                                        <th class="sorting wid-15" tabindex="0" rowspan="1" colspan="1">Estado</th>
                                        <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr role="row" class="even" data-id={{ $user->id }}>
                                            <td class="sorting_1">{{ $user->id }}</td>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->last_name }}</td>
                                            @role('admin')
                                            <td>{{ $user->activeRoles }}</td>
                                            @endrole
                                            <td class="center">{{ isset($user->city) ? $user->city->name : 'N/A' }}</td>
                                            <td class="center">{{ $user->status }}</td>
                                            <td>
                                                @role('partner')
                                                    <a href="{{ route('view_user', $user->id ) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Ver Usuario">
                                                        <i class="fa fa-eye text-success"></i>
                                                    </a>&nbsp; &nbsp;
                                                @endrole
                                                @can('Editar Usuarios')
                                                    <a class="edit" data-toggle="tooltip" data-placement="top" title="Editar" href="{{ route('edit_user', $user->id)}}">
                                                        <i class="fa fa-pencil text-warning"></i>
                                                    </a>&nbsp; &nbsp;
                                                @endcan
                                                @can('Eliminar Usuarios')
                                                    <a class="delete hidden-xs hidden-sm btn-delete" data-toggle="tooltip" data-placement="top" title="Eliminar" href="#">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>&nbsp; &nbsp;
                                                @endcan
                                                <a href="{{ route('network', $user->id ) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Ver red">
                                                    <i class="fa fa-sitemap text-default"></i>
                                                </a>&nbsp; &nbsp;
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
    {!! Form::open(['route' => ['delete_user', ':ID'], 'method' => 'DELETE', 'class' => 'form-delete']) !!}
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
