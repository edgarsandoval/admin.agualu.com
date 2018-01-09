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
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/bootstrap-select/css/bootstrap-select.min.css') }}" />
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
                        <li class="breadcrumb-item active">Editar Usuario</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-block m-t-25">
                    <div class="row">
                        <div class="col-xl-12">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a data-toggle="tab" href="#personal-information" class="nav-link active">Información Personal</a></li>
                                <li class="nav-item"><a data-toggle="tab" href="#network" class="nav-link">Red multinivel</a></li>
                                @if (isset($user))
                                    <li class="nav-item"><a data-toggle="tab" href="#change-password" class="nav-link">Cambiar contraseña</a></li>
                                @endif
                            </ul>

                            <div class="tab-content">
                              <div id="personal-information" class="tab-pane active">
                                {!! Form::model($user, ['route' => ['update_user', $user->id], 'method' => 'PUT', 'id' => 'tryitForm', 'class' => 'form-horizontal login_validator'])!!}
                                    @include('partials.user-form')
                                {!! Form::close() !!}
                            </div>

                            <div id="network" class="tab-pane">
                                <div class="form-group row m-t-25">
                                    <div class="col-12 col-lg-3 text-lg-right">
                                        <label class="col-form-label">Tipo de padre</label>
                                    </div>
                                    <div class="col-12 col-xl-6 col-lg-8">
                                        <select class="form-control" id="father_kind">
                                            <option selected disabled hidden>Ningún tipo seleccionado</option>
                                            <option value="Asociado">Asociado</option>
                                            <option value="Maquina">Máquina</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-12 col-lg-3 text-lg-right">
                                        <label class="col-form-label">Padre</label>
                                    </div>
                                    <div class="col-12 col-xl-6 col-lg-8">
                                        <select class="form-control selectpicker">
                                            <option>Mustard</option>
                                            <option>Ketchup</option>
                                            <option>Relish</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="change-password" class="tab-pane">
                                <div class="form-group row">
                                    <div class="col-12 col-lg-3 text-lg-right">
                                        <label for="pwd" class="col-form-label">Contraseña *</label>
                                    </div>
                                    <div class="col-12 col-xl-6 col-lg-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock text-primary"></i></span>
                                            {!! Form::password('password', ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-lg-3 text-lg-right">
                                        <label for="cpwd" class="col-form-label">Confirm Password *</label>
                                    </div>
                                    <div class="col-12 col-xl-6 col-lg-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock text-primary"></i></span>
                                            {!! Form::password('confirmpassword', ['class' => 'form-control']) !!}
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
    <!-- plugin scripts-->
    <script type="text/javascript" src="{{ asset('js/pluginjs/jasny-bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/holderjs/js/holder.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrapvalidator/js/bootstrapValidator.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
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
