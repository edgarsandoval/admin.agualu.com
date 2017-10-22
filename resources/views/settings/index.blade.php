@extends('layouts.default')

@section('title')
    Administrar Parámetros
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
                        <i class="fa fa-pencil"></i>
                        Administrar Parámetros
                    </h4>
                </div>
                <div class="col-lg-6 col-sm-8 col-12">
                    <ol class="breadcrumb float-right  nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Parámetros</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-header bg-white">
                    Parámetros de multinivel
                </div>
                <div class="card-block m-t-35">
                    {!! Form::open(['route' => 'update_parameter', 'method' => 'PUT', 'id' => 'parameterForm', 'class' => 'form-horizontal parameter-validator']) !!}
                    <fieldset>
                        <!-- Name input-->

                        @foreach ($sections as $section)
                            <legend>{{ $section->name }}</legend>
                            @foreach ($section->fields as $field)
                                <div class="form-group row">
                                    <div class="col-lg-10 push-lg-1">
                                        <label for="email" class="col-form-label form-group-horizontal">
                                            {{ $field->label }}
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-leaf"></i></span>
                                            {!! Form::number($field->name, $field->value, ['class' => 'form-control', 'min' => 0]) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                        <div class="form-group row">
                            <div class="col-lg-11 push-lg-1">
                                <button class="btn btn-primary btn-lg pull-right send_btn">Guardar cambios</button>
                            </div>
                        </div>
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
<script>
$(document).ready(function() {
    $('.send_btn').click(function(event) {
        event.preventDefault();

        var elements = [
            'owner_percentage',
            'level_1_percentage',
            'level_2_percentage',
            'level_3_percentage',
            'level_4_percentage',
            'level_5_percentage',
            'level_6_percentage',
            'level_7_percentage',
        ];

        var percentage = 0;

        for(var element of elements)
            percentage += parseFloat($('input[name=' + element + ']').val());

        if(percentage == 99)
            $('#parameterForm').submit();
        else
            swal(
                '¡Error!',
                'La suma de los porcentajes deja utilidades sin asignar o mal asignadas',
                'error'
            );
    });
});
</script>
@stop
