@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Abonar saldo
    @parent
@stop
{{-- page level styles --}}
@section('styles')
   <!-- plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('vendor/jasny-bootstrap/css/jasny-bootstrap.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('vendor/bootstrapvalidator/css/bootstrapValidator.min.css')}}" />
    <!--end of page level css-->
    {{-- <link rel="stylesheet" href="{{ asset('css/openpay.css')}}"> --}}
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
                                    <option disabled selected hidden>Selecciona un método de pago...</option>
                                    <option value="1">Tarjeta de débito/crédito</option>
                                    <option value="2">Tiendas de conveniencia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 col-lg-3 text-lg-right">
                            <label for="u-name" class="col-form-label">Cantidad a pagar:</label>
                        </div>
                        <div class="col-12 col-xl-6 col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa fa-money text-primary"></i></span>
                                <input type="number" class="form-control" id="payment-amount" min="0.01" step="0.01" max="2500" value="50">
                            </div>
                        </div>
                    </div>
                    <div class="container payment-container">
                        <div class="method" data-method="1">
                            <div class="panel panel-default">
                                <div class="panel-heading">Tarjeta de crédito/débito</div>
                                <div class="panel-body">
                                    <div class="openpay-container">
                                        <div class="row headers">
                                            <div class="col-md-4">
                                                <label>Tarjetas de crédito</label>
                                            </div>
                                            <div class="col-md-8">
                                                <label>Tarjetas de débito</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="{{ route('card_payment') }}" method="POST" id="payment-form" class="form-inline">
                                                <input type="hidden" name="token_id" id="token_id">
                                                <input type="hidden" name="use_card_points" id="use_card_points" value="false">
                                                <input type="hidden" name="amount" class="amount-field" value="50">
                                                {{ csrf_field() }}
                                                <div class="row">
                        							<div class="form-group">
                    									<label>Nombre del titular</label>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" placeholder="Como aparece en la tarjeta" autocomplete="off" data-openpay-card="holder_name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Número de tarjeta</label>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" autocomplete="off" data-openpay-card="card_number">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <label>Número de tarjeta</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" placeholder="Mes" data-openpay-card="expiration_month">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Número de tarjeta</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" placeholder="Año" data-openpay-card="expiration_year"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Número de tarjeta</label>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" placeholder="3 dígitos" autocomplete="off" data-openpay-card="cvv2">
                                                        </div>
                                                    </div>
                                                </div>

                            							<div class="openpay" style="width: 750px; margin-right: 30px;">
                            								<div style="font-size:24px; float:left;">
                            									<p style="margin-top: 20px; margin-right: 60px; margin-left: 20px;">$ 50.00 MXN</p>
                            								</div>
                            								<div class="logo">Transacciones realizadas vía:</div>
                            								<div class="shield">Tus pagos se realizan de forma segura con encriptación de 256 bits</div>
                            							</div>
                            							<div class="sctn-row">
                            									<a class="button rght" id="pay-button">Pagar</a>
                            							</div>
                            				</form>
                                            </div>
                                        </div>
                                    </div>
                            	</div>
                            </div>
                        </div>
                        <div class="method" data-method="2">
                            <div class="panel panel-default">
                                <div class="panel-heading">Tiendas de conveniencia</div>
                                <div class="panel-body">
                                    <div id="pagos" class="container_full">
                                    	<div class="container" style="padding-left:30px;">
                                    		<div class="">
                                    			<div class="">
                                    				<form action="{{ route('stores_payment') }}" method="POST">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="amount" class="amount-field" value="50">

                                    						<div class="sctn-col half l" style="width:100%; text-align: center;">
                                    							<input type="submit" value="Crear Recibo" class="btn btn-aqua">
                                    						</div>
                                    				</form>
                                    			</div>
                                    		</div>
                                    		<div class="sixteen columns">
                                    			<h1 style="font-size:28px; color:#0089AC; text-align:center; line-height:36px; margin-top:20px;">
                                    				Podrás pagar en cualquiera de las siguientes tiendas.
                                    			</h1>
                                    		</div>
                                            <div class="row">
                                                @for ($i = 1; $i <= 16; $i++)
                                                    <div class="col-md-3" style="margin-bottom: 10px;">
                                                        <img class="img-thumbnail" src="{{ asset('img/openpay/tiendas_conveniencia') }}/{{ str_pad($i, 2, "0", STR_PAD_LEFT)}}.jpg" />
                                                    </div>
                                                @endfor
                                            </div>
                                    	</div>
                                    </div>
                                </div>
                            </div>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#payment-method').change(function(event) {
            var option = $(this).val();
            $('.method').each(function(i, it) {
                $element = $(it);
                if($element.data('method') == option)
                    $element.fadeIn(500);
                else
                    $element.hide();
            });
        });

        $('#payment-amount').change(updateAmount).keyup(updateAmount);
    });

    function updateAmount(){
        $('.openpay p').html('$ ' + Number($('#payment-amount').val()).formatMoney(2, '.', ',') + ' M.N');
        $('.amount-field').val($('#payment-amount').val());
    }
</script>
<script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
<script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		OpenPay.setId('mvmzgrfww4wvppeubcee');
		OpenPay.setApiKey('pk_31b7b77197a24cda92f855ecf3fbe1b6');
		// OpenPay.setSandboxMode(true);
		//Se genera el id de dispositivo
		var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");

		$('#pay-button').on('click', function(event) {
			event.preventDefault();
			$("#pay-button").prop( "disabled", true);
			OpenPay.token.extractFormAndCreate('payment-form', sucess_callbak, error_callbak);
		});

		var sucess_callbak = function(response) {
			var token_id = response.data.id;
			$('#token_id').val(token_id);
			$('#payment-form').submit();
		};

		var error_callbak = function(response) {
			var desc = response.data.description;
			alert(desc);
			$("#pay-button").prop("disabled", false);
		};

	});
</script>
@stop
