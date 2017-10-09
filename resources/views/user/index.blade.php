@extends('layouts/default')

@section('title')
    Usuarios
    @parent
@stop

{{-- page level styles --}}
@section('styles')
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/select2/css/select2.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/dataTables.bootstrap.css')}}"/>
    <!--End of plugin styles-->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/tables.css')}}"/>
    <!-- end of page level styles -->
@stop


{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6 col-sm-4">
                    <h4 class="nav_top_align">
                        <i class="fa fa-user"></i>
                        Mostrar Usuarios
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
                            <a href="#">Usuarios</a>
                        </li>
                        <li class="active breadcrumb-item">Mostrar Usuarios</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-header bg-white">
                    Usuarios Registrados
                </div>
                <div class="card-block m-t-35" id="user_body">
                    {{-- <div class="table-toolbar">
                        <div class="btn-group float-right users_grid_tools">
                            <div class="tools"></div>
                        </div>
                    </div> --}}
                    <div>
                        <div>
                            <table class="table  table-striped table-bordered table-hover dataTable no-footer" id="editable_table" role="grid">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc wid-20" tabindex="0" rowspan="1" colspan="1">Código de Usuario</th>
                                    <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Nombre(s)</th>
                                    <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Apellido</th>
                                    <th class="sorting wid-20" tabindex="0" rowspan="1" colspan="1">Ciudad</th>
                                    <th class="sorting wid-15" tabindex="0" rowspan="1" colspan="1">Estado</th>
                                    <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr role="row" class="even" data-id={{ $user->id }}>
                                            <td class="sorting_1">{{ $user->member_code }}</td>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->last_name }}</td>
                                            <td class="center">{{ $user->city->name }}</td>
                                            <td class="center">{{ $user->status }}</td>
                                            <td>
                                                <a href="{{ route('view_user', $user->id ) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="Ver Usuario">
                                                    <i class="fa fa-eye text-success"></i>
                                                </a>&nbsp; &nbsp;
                                                <a class="edit" data-toggle="tooltip" data-placement="top" title="Editar" href="{{ route('edit_user', $user->id)}}">
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
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->

    {!! Form::open(['route' => ['delete_user', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
    {!! Form::close() !!}
@stop
{{-- page level scripts --}}
@section('scripts')
    <script type="text/javascript">
    	$(document).ready(function()
    	{

    		$('.btn-delete').click(function(event)
    		{
    			event.preventDefault();
    			event.stopPropagation();

    			if(!confirm('¿Esta seguro que desea eliminar al usuario?'))
    				return;

    			var row 	= $(this).parents('tr');
    			var id 		= row.data('id');
    			var form 	= $('#form-delete');

                if(id == '{{ Auth::user()->id }}') {
                    alert('No te puedes eliminar a ti mismo');
                    return;
                }

    			var url 	= form.attr('action').replace(':USER_ID', id);
    			var data 	= form.serialize();

    			row.fadeOut();

    			$.post(url, data, function(response) {
                    toastr[response.class](response.message, response.status ? '¡Exito!' : '¡Error!');
    			});
    		});
    	});
    </script>
    <!--Plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/vendors/select2/js/select2.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.colVis.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.html5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.print.min.js')}}"></script>
    <!--End of plugin scripts-->
    <!--Page level scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pages/users.js')}}"></script>
    <!-- end page level scripts -->
@stop
