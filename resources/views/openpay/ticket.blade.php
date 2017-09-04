@extends('layouts.default')

@section('title')
    Recibo de compra
    @parent
@stop

@section('styles')
{{ Html::style(asset('assets/css/pago_tienda.css')) }}
<style media="screen">
@media print {
    #pagos { border: none !important; }
}
</style>
@endsection

{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-file-text-o"></i>
                        Recibo de compra
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
                            <a href="{{ route('users') }}"> Usuarios</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('budget')}}">Abonar saldo</a>
                        </li>
                        <li class="breadcrumb-item active">Recibo de compra</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div id="pagos" class="container_full">
                	<div class="container" style="">
                		<div class="whitepaper">
                			<div class="Header">
                				<div class="Logo_empresa">
                					<img src="{{ asset('assets/img/openpay/logo.png') }}" alt="Logo">
                				</div>
                				<div class="Logo_paynet">
                					<div>Servicio a pagar</div>
                					<img src="{{ asset('assets/img/openpay/cards1.png') }}" alt="Logo Paynet">
                				</div>
                			</div>
                			<div class="Data">
                				<div class="Big_Bullet">
                					<span></span>
                				</div>
                				<div class="col1">
                					<h3>Fecha límite de pago</h3>
                					<h4>{{ $order->creation_date }}</h4>
                					<img width="300" src="{{ $order->payment_method->barcode_url }}" alt="Código de Barras">
                					<span>{{ $order->payment_method->reference }}</span>
                					<small>En caso de que el escáner no sea capaz de leer el código de barras, escribir la referencia tal como se muestra.</small>

                				</div>
                				<div class="col2">
                					<h2>Total a pagar</h2>
                					<h1>$ {{ number_format($order->amount, 2) }}<small> MXN</small></h1>
                					<h2 class="S-margin">+8 pesos por comisión</h2>
                				</div>
                			</div>
                			<div class="DT-margin"></div>

                			<div>
                				<div class="Big_Bullet">
                					<span></span>
                				</div>
                				<div class="col1">
                					<h3>Como realizar el pago</h3>
                					<ol>
                						<li>Acude a cualquier tienda afiliada</li>
                						<li>Entrega al cajero el código de barras y menciona que realizarás un pago de servicio Paynet</li>
                						<li>Realizar el pago en efectivo por $ {{ number_format($order->amount, 2) }} MXN (más $8 pesos por comisión)</li>
                						<li>Conserva el ticket para cualquier aclaración</li>
                					</ol>
                					<small>Si tienes dudas comunicate a Biostyle al teléfono 01 800 01234 246  o al correo atencionaclientes@agualu.com</small>
                				</div>
                				<div class="col1">
                					<h3>Instrucciones para el cajero</h3>
                					<ol>
                						<li>Ingresar al menú de Pago de Servicios</li>
                						<li>Seleccionar Paynet</li>
                						<li>Escanear el código de barras o ingresar el núm. de referencia</li>
                						<li>Ingresa la cantidad total a pagar</li>
                						<li>Cobrar al cliente el monto total más la comisión de $8 pesos</li>
                						<li>Confirmar la transacción y entregar el ticket al cliente</li>
                					</ol>
                					<small>Para cualquier duda sobre como cobrar, por favor llamar al teléfono 01 800 300 08 08 en un horario de 8am a 9pm de lunes a domingo</small>
                				</div>
                			</div>
                			<div class="logos-tiendas">
                				<div><img width="50" src="{{ asset('assets/img/openpay/eleven.png') }}" alt="Seven Eleven"></div>
                				<div class="margen2"><img width="90" src="{{ asset('assets/img/openpay/extra.png') }}" alt="Extra"></div>
                				<div class="margen2"><img width="90" src="{{ asset('assets/img/openpay/farmacia_ahorro.png') }}" alt="Farmacias del Ahorro"></div>
                				<div class="mg3"><img width="150" src="{{ asset('assets/img/openpay/benavides.png') }}" alt="Benavides"></div>
                				<div class="mg3" style="margin-left:25px; margin-top: 0px;"><button id="imprimir" class="btn btn-aqua">Imprimir</button></div>
                				<div class="mg3"><small>¿Quieres pagar en otras tiendas? <br> visita: <a target="_blank" href="www.agualu.com/web/tiendas_conveniencia">www.agualu.com/web/tiendas_conveniencia</a></small></div>
                			</div>
                		</div>
                	</div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script>
$( "#imprimir" ).click(function() {
    $(this).hide();
    var prtContent = document.getElementById("pagos");
    var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write('<html><head>');
    WinPrint.document.write('<link rel="stylesheet" href="{{ asset('assets/css/pago_tienda.css') }}"><style>@charset "US-ASCII";@import "http://fonts.googleapis.com/css?family=Lato:300,400,700";/** {color: #444;font-family: Lato;font-size: 16px;font-weight: 300;}</style>');
    WinPrint.document.write('</head><body onload="print();close();">');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.write('</body></html>');
    WinPrint.document.close();
    WinPrint.focus();
    $(this).show();
});
</script>
@endsection
