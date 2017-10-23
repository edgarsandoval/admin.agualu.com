@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Productos Biostyle
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
                        <i class="fa fa-pagelines"></i>
                        Productos Biostyle
                    </h4>
                </div>
                <div class="col-lg-6 col-sm-8 col-12">
                    <ol class="breadcrumb float-right  nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i> Dashboard
                            </a>
                        </li>
                        <li class="active breadcrumb-item">Productos Biostyle</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-header bg-white">
                    Catalogo de productos
                </div>
                <div class="card-block m-t-35">
                    <div class="row product-container">
                        @foreach ($products as $product)
                            <div class="product-item col-md-3">
                                <a href="{{ route('view_product', $product->id)}}">
                                        <img src="http://system.agualu.com/files/bbs/categorias/t1j4oTOTAL_COFFEE.jpg" class="image">
                                            <div class="overlay">
                                                <div class="text">{{ $product->name }}
                                                    <p>{{ $product->short_description }}</p>
                                                </div>
                                            </div>
                                        </a>
                            </div>
                @endforeach
                    </div>
                <div>
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
    @if(isset($toastr))
    <script type="text/javascript">
        toastr.{{ $toastr['class'] }}('{{ $toastr['message']}}', '{{ $toastr['status'] ? '¡Exito!' : '¡Error!'}}');
    </script>
    @endif
@stop
