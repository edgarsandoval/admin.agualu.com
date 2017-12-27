@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Editar Usuario
    @parent
@stop
{{-- page level styles --}}
@section('styles')
   <!-- plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/jasny-bootstrap/css/jasny-bootstrap.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/bootstrapvalidator/css/bootstrapValidator.min.css') }}" />
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
                        Editar Usuario
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
                        <li class="breadcrumb-item active">Invitar Usuario</li>
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
                        <h4>Información Personal</h4>
                    </div>
                    {!! Form::open(['route' => ['store_user'], 'method' => 'POST', 'id' => 'tryitForm', 'class' => 'form-horizontal login_validator'])!!}
                        @include('partials.user-form')
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
    <script type="text/javascript" src="{{ asset('js/pluginjs/jasny-bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/holderjs/js/holder.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrapvalidator/js/bootstrapValidator.min.js') }}"></script>
    <!-- end of plugin scripts-->
    <script type="text/javascript">

    $(document).ready(function() {
        $('#state').change(function(event) {
            var state_id = $(this).val();
            $('#city').empty();
            $.ajax({
                type: 'GET',
                url: '{{ url('state') }}/' + state_id,
                success: function(response) {
                    $('#city').empty();

                    response.state.cities.forEach(city => {
                        $('#city').append(
                            $('<option>', {
                                value: city.id,
                                html: city.name
                            })
                        );

                    });
                }
            });
        });
    })

    </script>
    <!-- end of page level scripts-->
@stop
