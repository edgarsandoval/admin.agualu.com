@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Perfil de Usuario
    @parent
@stop
{{-- page level styles --}}
@section('styles')
    <!--Plugin css-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/fullcalendar/css/fullcalendar.min.css')}}"/>
    <!--End off plugin css-->
    <!--Page level css-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/timeline2.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/calendar_custom.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/profile.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/gallery.css')}}"/>
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-user"></i>
                        Perfil de Usuario
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
                            <a href="{{ route('users') }}">Usuarios</a>
                        </li>
                        <li class="active breadcrumb-item">Ver Perfil</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-lg-6 m-t-35">
                            <div class="text-center">
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumb_zoom zoom admin_img_width">
                                            <img src="{{asset('assets/img/admin.jpg')}}" alt="admin" class="admin_img_width"></div>
                                        <div class="fileinput-preview fileinput-exists thumb_zoom zoom admin_img_width"></div>
                                        <div class="btn_file_position">
                                                    {{-- <span class="btn btn-primary btn-file">
                                                        <span class="fileinput-new">Cambiar imagen</span>
                                                        <span class="fileinput-exists">Cambiar</span>
                                                        <input type="file" name="Changefile">
                                                    </span> --}}
                                            <a href="#" class="btn btn-warning fileinput-exists"
                                               data-dismiss="fileinput">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 m-t-25">
                            <div>
                                <ul class="nav nav-inline view_user_nav_padding">
                                    <li class="nav-item card_nav_hover">
                                        <a class="nav-link active" href="#user" id="home-tab"
                                           data-toggle="tab" aria-expanded="true">Información básica</a>
                                    </li>
                                    <li class="nav-item card_nav_hover">
                                        <a class="nav-link" href="#tab2" id="hats-tab" data-toggle="tab">Información de contacto</a>
                                    </li>
                                    {{-- @if($user->id == Auth::user()->id)
                                    <li class="nav-item card_nav_hover">
                                        <a class="nav-link" href="#tab3"  id="followers" data-toggle="tab">Monedero</a>
                                    </li>
                                    @endif --}}
                                </ul>
                                <div id="clothing-nav-content" class="tab-content m-t-10">
                                    <div role="tabpanel" class="tab-pane fade show active" id="user">
                                        <table class="table" id="users">
                                            <tr>
                                                <td>Código de miembro</td>
                                                {{-- <td class="inline_edit">
                                                        <span class="editable"
                                                              data-title="Edit User Name">Micheal</span>
                                                </td> --}}
                                                <td>{{ $user->member_code }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nombre(s)</td>
                                                {{-- <td>
                                                    <span class="editable" data-title="Edit E-mail">gankunding@hotmail.com</span>
                                                </td> --}}
                                                <td>{{ $user->first_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Apellido(s)</td>
                                                {{-- <td>
                                                    <span class="editable" data-title="Edit E-mail">gankunding@hotmail.com</span>
                                                </td> --}}
                                                <td>{{ $user->last_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Correo electrónico</td>
                                                {{-- <td>
                                                    <span class="editable" data-title="Edit E-mail">gankunding@hotmail.com</span>
                                                </td> --}}
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Miembro desde: </td>
                                                {{-- <td>
                                                    <span class="editable" data-title="Edit E-mail">gankunding@hotmail.com</span>
                                                </td> --}}
                                                <td>{{ $user->created_at }}</td>
                                            </tr>

                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tab2">
                                        <div class="card_nav_body_padding">
                                            <table class="table">
                                                <tr>
                                                    <td>Numero de teléfono</td>
                                                    {{-- <td>
                                                        <span class="editable" data-title="Edit Phone Number">(999)999-9999</span>
                                                    </td> --}}
                                                    <td>{{ $user->phone }}</td>
                                                </tr>
                                                @if(isset($user->cellphone))
                                                    <tr>
                                                        <td>Numero de celular</td>
                                                        {{-- <td>
                                                            <span class="editable" data-title="Edit Phone Number">(999)999-9999</span>
                                                        </td> --}}
                                                        <td>{{ $user->cellphone }}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td>Calle</td>
                                                    {{-- <td>
                                                        <span class="editable" data-title="Edit Address">Australia</span>
                                                    </td> --}}
                                                    <td>{{ $user->street }}</td>
                                                </tr>
                                                <tr>
                                                    <td>No. ext</td>
                                                    <td>{{ $user->outdoor_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td>No. int</td>
                                                    <td>{{ $user->intdoor_number ?: 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Colonia</td>
                                                    {{-- <td>
                                                        <span class="editable" data-title="Edit City">Nakia</span>
                                                    </td> --}}
                                                    <td>{{ $user->suburb}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Código Postal</td>
                                                    {{-- <td>
                                                        <span class="editable" data-title="Edit Pincode">522522</span>
                                                    </td> --}}
                                                    <td>{{ $user->postal_code }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Estado</td>
                                                    {{-- <td>
                                                        <span class="editable" data-title="Edit Pincode">522522</span>
                                                    </td> --}}
                                                    <td>{{ $user->state->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ciudad</td>
                                                    {{-- <td>
                                                        <span class="editable" data-title="Edit Pincode">522522</span>
                                                    </td> --}}
                                                    <td>{{ $user->city->name }}</td>
                                                </tr>
                                            </table>
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
    <!-- /.outer -->
@stop
{{-- page level scripts --}}
@section('scripts')
    <!--Plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/bootstrap_calendar/js/bootstrap_calendar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fullcalendar/js/fullcalendar.min.js')}}"></script>
    <!--End of Plugin scripts-->
    <!--Page level scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pages/mini_calendar.js')}}"></script>
    <!--End of Page level scripts-->
@stop
