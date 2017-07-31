@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Abonar saldo
    @parent
@stop
{{-- page level styles --}}
@section('styles')
   <!-- plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" />
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
                        Abonar saldo
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
                            <a href="#">Usuarios</a>
                        </li>
                        <li class="breadcrumb-item active">Abonar saldo</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-block m-t-25">
                    <div>
                        <h4>Selecciona una de nuestras opciones disponible para abonar saldo a tu cuenta</h4>
                    </div>
                    <div class="form-group row m-t-25">
                        <div class="col-12 col-lg-3 text-lg-right">
                            <label for="u-name" class="col-form-label">Tipo de pago:</label>
                        </div>
                        <div class="col-12 col-xl-6 col-lg-8">
                            <div class="input-group">
                                            <span class="input-group-addon"> <i class="fa fa-money text-primary"></i>
                        </span>
                                <select class="form-control" id="payment-method">
                                    <option value="1">Tarjeta de débito/crédito</option>
                                    <option value="2">Tiendas de conveniencia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="container" id="payment-container">

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
<script type="text/javascript">
    $(document).ready(function() {
        $('#payment-method').change(function(event) {
            var option = $(this).val();

            $.ajax({
                type: 'GET',
                url: {{ route('switch-payment') }}
                data: { option: option }
            })
        });
    });
</script>
@stop
