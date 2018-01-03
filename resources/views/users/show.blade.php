@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Perfil de Usuario
    @parent
@stop
{{-- page level styles --}}
@section('styles')
    <!--Plugin css-->
    <link type="text/css" rel="stylesheet" href="{{asset('vendor/jasny-bootstrap/css/jasny-bootstrap.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('vendor/fullcalendar/css/fullcalendar.min.css')}}"/>
    <!--End off plugin css-->
    <!--Page level css-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/timeline2.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/calendar_custom.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/profile.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/gallery.css')}}"/>
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
                        <div class="col-lg-6 m-t-25">
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
                        <div class="col-lg-6 m-t-25">
                            <table class="table">
                                <tr>
                                    <td>Numero de teléfono</td>
                                    @if($user->id == Auth::user()->id)
                                        <td class="inline_edit">
                                            <span class="editable" data-title="Edit Phone Number">{{ $user->phone }}</span>
                                        </td>
                                    @else
                                        <td>{{ $user->phone }}</td>
                                    @endif
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
                                    <td>{{ isset($user->city) ? $user->city->name : 'N/A' }}</td>
                                </tr>
                            </table>
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
    <script type="text/javascript" src="{{asset('vendor/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/bootstrap_calendar/js/bootstrap_calendar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/fullcalendar/js/fullcalendar.min.js')}}"></script>
    <!--End of Plugin scripts-->
@stop
