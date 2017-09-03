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
    <link rel="stylesheet" href="{{ asset('assets/css/openpay.css')}}">
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
                    <div class="container payment-container">
                        <div class="method" data-method="1">
                            <div class="panel panel-default">
                                <div class="panel-heading">Tarjeta de crédito/débito</div>
                                <div class="panel-body">
                            		<div class="bkng-tb-cntnt">
                            			<div class="pymnts">
                            				<form action="/oficina/pagar_tarjeta" method="POST" id="payment-form">
                            					<div class="pymnt-itm card active">
                            						<div class="pymnt-cntnt">
                            							<div class="card-expl">
                            								<div class="credit">
                                                                <h4>Tarjetas de crédito</h4>
                                                                <img src="{{ asset('assets/img/openpay/cards1.png')}}" alt="">
                                                            </div>
                            								<div class="debit"><h4>Tarjetas de débito</h4></div>
                            							</div>
                            							<div class="sctn-row">
                            								<div class="sctn-col l">
                            									<label>Nombre del titular</label>
                            									<input type="text" placeholder="Como aparece en la tarjeta" autocomplete="off" data-openpay-card="holder_name">
                            								</div>
                            								<div class="sctn-col">
                            									<label>Número de tarjeta</label>
                            									<input type="text" autocomplete="off" data-openpay-card="card_number"></div>
                            							</div>
                            							<div class="sctn-row">
                            								<div class="sctn-col l">
                            									<label>Fecha de expiración</label>
                            									<div class="sctn-col half l">
                            										<input type="text" placeholder="Mes" data-openpay-card="expiration_month">
                            									</div>
                            									<div class="sctn-col half l">
                            										<input type="text" placeholder="Año" data-openpay-card="expiration_year"></div>
                            								</div>
                            								<div class="sctn-col cvv"><label>Código de seguridad</label>
                            									<div class="sctn-col half l"><input type="text" placeholder="3 dígitos" autocomplete="off" data-openpay-card="cvv2"></div>
                            								</div>
                            							</div>

                            							<div class="openpay" style="width: 750px; margin-right: 30px;">
                            								<div style="font-size:24px; float:left;">
                            									<p style="margin-top: 20px; margin-right: 60px; margin-left: 20px;">$ 4 MXN</p>
                            								</div>
                            								<div class="logo">Transacciones realizadas vía:</div>
                            								<div class="shield">Tus pagos se realizan de forma segura con encriptación de 256 bits</div>
                            							</div>
                            							<div class="sctn-row">
                            									<a class="button rght" id="pay-button">Pagar</a>
                            							</div>
                            						</div>
                            					</div>
                            				</form>
                            			</div>
                            		</div>
                            	</div>
                            </div>
                        </div>
                        <div class="method" data-method="2">
                            <div class="panel panel-default">
                                <div class="panel-heading">Tiendas de conveniencia</div>
                                <div class="panel-body">Panel Content</div>
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
    });
</script>
<script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
<script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		OpenPay.setId('myseqv8dilt2otqopeya');
		OpenPay.setApiKey('pk_b3881d98249247bea60a222782b600c5');
		OpenPay.setSandboxMode(false);
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
