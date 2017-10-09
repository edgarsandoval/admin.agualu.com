<div class="row">
    <div class="col-xl-12">
        <div class="form-group row m-t-25">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="u-name" class="col-form-label">Nombre *</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"> <i class="fa fa-user text-primary"></i></span>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<legend></legend>
<h4><b>Asignación de permisos</b></h4>
@foreach ($permissions as $permission)
    <div class="form-group gender_message row">
        <div class="col-12 col-lg-3 text-lg-right">
            <label class="col-form-label">{{ ucfirst($permission->name) }}</label>
        </div>
        <div class="col-12 col-xl-6 col-lg-8">
            <div class="custom-controls-stacked">
                <label class="custom-control custom-checkbox">
                    {{ Form::checkbox('permissions[]', $permission->id, null, ['class' => 'custom-control-input']) }}
                    <span class="custom-control-indicator"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12 col-lg-9 push-lg-3">
            <button class="btn btn-primary" type="submit">
                Guardar
            </button>
        </div>
    </div>
@endforeach
