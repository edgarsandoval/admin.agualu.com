@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Detalles de producto
    @parent
@stop
{{-- page level styles --}}
@section('styles')
    <!--Plugin css-->
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/prettyphoto/css/prettyPhoto.css') }}">
    <!--End off plugin css-->
    <!--Page level css-->
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-pagelines"></i>
                        Detalles de producto
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
                            <a href="{{ route('products') }}">Productos Biostyle</a>
                        </li>
                        <li class="active breadcrumb-item">Ver Producto</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-header bg-white">
                    {{ $product->name . ' - ' . $product->short_description }}
                </div>
                <div class="card-block m-t-35">
                    <div class="product-container">
                        <h1>{{ $product->name }}</h1>
                        {{-- <div id="pictures" class="owl-slider">
                            <a class="item" href="http://lorempixel.com/800/400/food/1/" rel="prettyPhoto" title="This is the description">
                                <img src="http://lorempixel.com/300/150/food/1/" width="300" height="150" alt="title" />
                            </a>
                            <a class="item" href="http://lorempixel.com/800/400/food/1/" rel="prettyPhoto" title="This is the description">
                                <img src="http://lorempixel.com/300/150/food/1/" width="300" height="150" alt="title" />
                            </a>
                            <a class="item" href="http://lorempixel.com/800/400/food/1/" rel="prettyPhoto" title="This is the description">
                                <img src="http://lorempixel.com/300/150/food/1/" width="300" height="150" alt="title" />
                            </a>
                            <a class="item" href="http://lorempixel.com/800/400/food/1/" rel="prettyPhoto" title="This is the description">
                                <img src="http://lorempixel.com/300/150/food/1/" width="300" height="150" alt="title" />
                            </a>
                        </div> --}}
                        <legend>&nbsp;</legend>
                        <div class="video-container">{!! Embed::make($product->video)->parseUrl()->getIframe() !!}</div>
                        <p>Descarga la ficha técnica <a href="http://www.biostyle.com.mx/files/pagina/fichas_tecnicas/1if7mTOTAL_COFFEE.pdf" target="_blank">aquí.</a>&nbsp;</p>
                        <h3>Descripción: </h3>
                        <div>{!! $product->description !!}</div>
                        <h3>Beneficios: </h3>
                        <div>{!! $product->benefits !!}</div>
                        <h3>Recomendaciones: </h3>
                        <div>{!! $product->recommendations !!}</div>
                        <div class="price-container">
                            <p>Obtenlo por solo <span>{{ $product->public_price }}</span> créditos</p>
                        </div>
                        <div class="pull-right">
                            <button type="button" name="button" class="btn btn-lg btn-primary btn-cart" data-id="{{ $product->id }}">Añadir al carrito <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
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
    <script type="text/javascript" src="{{ asset('vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/prettyphoto/js/jquery.prettyPhoto.js') }}"></script>
    <script type="text/javascript">

    $(document).ready(function () {
        $("a[rel^='prettyPhoto']").prettyPhoto();
        $(".owl-slider").owlCarousel({

            autoPlay: 3000, //Set AutoPlay to 3 seconds

            items: 4,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3]

        });

        $('.btn-cart').click(function(event) {
            var data = {
                'product_id': $(this).data('id')
            };

            $.post('{{ route('cart_add') }}', data, function(response) {

                if(response.status)
                    swal('¡Hecho!', response.message, 'success');
                else
                    swal('¡Error!', response.message, 'error');

            });
        });
    });

    </script>
@stop
