@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Detalle de pedido
    @parent
@stop
{{-- page level styles --}}
@section('styles')
    <!--Plugin css-->
    <link type="text/css" rel="stylesheet" href="{{asset('vendor/jasny-bootstrap/css/jasny-bootstrap.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('vendor/fullcalendar/css/fullcalendar.min.css')}}"/>
    <!--End off plugin css-->
    <!--Page level css-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/timeline2.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/calendar_custom.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/profile.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/gallery.css')}}"/>
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-file-o"></i>
                        Detalle de pedido
                    </h4>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('orders') }}">Pedidos</a>
                        </li>
                        <li class="active breadcrumb-item">Ver Pedido</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-block">
                    <div class="m-t-25">
                        <h3>Detalle del pedido</h3>
                        <div class="form-group row">
                            <div class="col-12 col-lg-4 text-lg-right">
                                <label class="col-form-label">Nombre del Asociado</label>
                            </div>
                            <div class="col-12 col-xl-6 col-lg-8">
                                {{ $order->full_name }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-lg-4 text-lg-right">
                                <label class="col-form-label">Fecha del pedido</label>
                            </div>
                            <div class="col-12 col-xl-6 col-lg-8">
                                {{ $order->created_at }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-lg-4 text-lg-right">
                                <label class="col-form-label">Total de puntos</label>
                            </div>
                            <div class="col-12 col-xl-6 col-lg-8">
                                {{ number_format($order->amount, 2) }} puntos
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-lg-4 text-lg-right">
                                <label class="col-form-label">Estado del pedido</label>
                            </div>
                            <div class="col-12 col-xl-6 col-lg-8">
                                @if ($order->status == 'En proceso')
                                    <span class="label label-sm label-warning">{{ $order->status }}</span>
                                @elseif($order->status == 'Completado')
                                    <span class="label label-sm label-success">{{ $order->status }}</span>
                                @else
                                    <span class="label label-sm label-danger">{{ $order->status }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="m-t-25">
                        <h3>Productos adquiridos</h3>
                        <div class="col-12">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nombre del producto</th>
                                        <th>Precio</th>
                                        <th>Cantitdad</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ number_format($product->pivot->price, 2) }} puntos</td>
                                            <td>{{ $product->pivot->quantity }}</td>
                                            <td>{{ number_format(floatval($product->pivot->price) * floatval($product->pivot->quantity), 2) }}</td>
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
    <!-- /.outer -->
@stop
{{-- page level scripts --}}
@section('scripts')
    <!--Plugin scripts-->
    <script type="text/javascript" src="{{asset('vendor/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/bootstrap_calendar/js/bootstrap_calendar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/fullcalendar/js/fullcalendar.min.js')}}"></script>
    <!--End of Plugin scripts-->
@stop
