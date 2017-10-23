@extends('layouts.default')

@section('title')
    Carrito
    @parent
@stop

@section('styles')
@stop

@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6 col-sm-4">
                    <h4 class="nav_top_align">
                        <i class="fa fa-shopping-cart"></i>
                        Carrito de compras
                    </h4>
                </div>
                <div class="col-lg-6 col-sm-8 col-12">
                    <ol class="breadcrumb float-right  nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Carrito de compras</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-header bg-white">
                    Carrito de compras
                </div>
                <div class="card-block m-t-35">
                    <table id="shopping-cart" class="table table-hover">
                        <thead>
                            <th>SKU</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                            <th><i class="fa fa-trash text-danger"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                <tr class="cart-item" data-sku="{{ $item->id }}">
                                    <td>
                                        <p>{{ $item->id }}</p>
                                        <img src="http://system.agualu.com/files/bbs/categorias/t1j4oTOTAL_COFFEE.jpg" class="image">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->price, 2) }} créditos</td>
                                    <td>{{ number_format($item->getPriceSum(), 2) }} créditos</td>
                                    <td>
                                        <a class="delete hidden-xs hidden-sm btn-delete" data-toggle="tooltip" data-placement="top" title="Eliminar" href="#">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="no-cart" style="display: {{ $cart->count() == 0 ? 'table-row' : 'none' }}">
                                <td colspan="6">No hay articulos en el carrito</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">&nbsp;</td>
                                <td style="text-align: left;"><strong>Subtotal:</strong></td>
                                <td><span>{{ number_format($subtotal, 2) }}</span> créditos </td>
                            </tr>
                            <tr>
                                <td colspan="4">&nbsp;</td>
                                <td style="text-align: left;"><strong>Saldo en monedero:</strong></td>
                                <td><span>{{ number_format($balance, 2) }}</span> créditos </td>
                            </tr>
                            <tr>
                                <td colspan="4">&nbsp;</td>
                                <td style="text-align: left;"><strong>Total:</strong></td>
                                <td><span>{{ number_format($balance - $subtotal, 2) }}</span> créditos </td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="pull-right">
                        <button type="button" name="button" class="btn btn-lg btn-primary btn-cart" {{ $cart->count() == 0 || $balance - $subtotal < 0 ? 'disabled' : ''}}>Proceeder con la compra <i class="fa fa-check" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
<script>

$(document).ready(function() {
    $('.btn-delete').click(function(event) {
        var row = $(this).parents('tr');

        var data = {
            'sku': row.data('sku')
        };

        $.post('{{ route('cart_delete') }}', data, function(response) {
            if(response.status) {
                row.fadeOut();
                row.remove();

                var container = $('tfoot');

                container.find('span:eq(0)').html(response.data.subtotal);
                container.find('span:eq(1)').html(response.data.balance);
                container.find('span:eq(2)').html(response.data.total);

                if(parseFloat(response.data.total) < 0)
                    $('.btn-cart').prop('disabled', true);
                else
                    $('.btn-cart').prop('disabled', false);

                if($('.cart-item').length == 0) {
                    $('.no-cart').fadeIn();
                    $('.btn-cart').prop('disabled', true);
                }

                toastr.success(response.message, '¡Hecho!');
            }
            else
                toastr.error(response.message, '¡Error!');
        });

    });

    $('.btn-cart').click(function(event) {
        swal({
            text: "¿Estás seguro que deseas continuar con la operación?",
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
        }).then(function() {
            $.post('{{ route('cart_process') }}', null, function(response) {
                window.location.href = '{{ route('products') }}';
            });
        }, function (dismiss) {
            if (dismiss === 'cancel') {
                // DO NOTHING
            }
        });
    })
});

</script>
@stop
