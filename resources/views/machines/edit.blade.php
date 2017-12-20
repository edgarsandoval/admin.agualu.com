 @extends('layouts.default')

{{-- Page title --}}
@section('title')
    Editar Máquina
    @parent
@stop
{{-- page level styles --}}
@section('styles')
   <!-- plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('vendor/jasny-bootstrap/css/jasny-bootstrap.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('vendor/bootstrapvalidator/css/bootstrapValidator.min.css')}}" />
    <!--end of page level css-->
    <style>
        /* Always set the map height explicitly to define the size of the div
        * element that contains the map. */
        #map {
            height: 100%;
            width: 100%;
            min-height: 300px;
            max-height: 500px;
        }

    </style>
@stop


{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-pencil"></i>
                        Editar Máquina
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
                            <a href="#">Máquinas</a>
                        </li>
                        <li class="breadcrumb-item active">Editar Máquina</li>
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
                        <h4>Información de la máquina</h4>
                    </div>
                    {!! Form::model($machine, ['route' => ['update_machine', $machine->id], 'method' => 'PUT', 'id' => 'tryitForm', 'class' => 'form-horizontal login_validator'])!!}
                        @include('partials.machine-form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
@stop
{{-- page level scripts --}}
@section('scripts')
    <!-- plugin scripts-->
    <script type="text/javascript" src="{{asset('js/pluginjs/jasny-bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/holderjs/js/holder.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
    <!-- end of plugin scripts-->
    {{-- <script type="text/javascript" src="{{asset('js/pa¿ges/validation.js')}}"></script> --}}
    <script>

    function initMap() {
        var lat = 20.674455;
        var lng = -103.387334;
        var latlng = new google.maps.LatLng(lat, lng);
        var mapOptions = {
            center: new google.maps.LatLng(lat, lng),
            zoom: 17,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
        });
        var input = document.getElementById('address-field');
        google.maps.event.addDomListener(input, 'keydown', function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
            }
        });

        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setPosition(place.geometry.location);

                $('#lat').val(place.geometry.location.lat());
                $('#lng').val(place.geometry.location.lng());
            });
        });

        marker.setPosition(new google.maps.LatLng($('#lat').val(), $('#lng').val()));
        map.setCenter(marker.getPosition());

    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQbixxOtWXFUYuT9zNaCS_1zTPHK7k-lA&callback=initMap&libraries=places"
    async defer></script>
    <!-- end of page level scripts-->
@stop
