<div class="row">
    <div class="col-xl-12">
        <div class="form-group row m-t-25">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="u-name" class="col-form-label">Nombre *</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"> <i class="fa fa-bar-chart text-primary"></i></span>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="u-name" class="col-form-label">Cantidad mínima requerida *</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bar-chart text-primary"></i></span>
                    {!! Form::number('minimum_volume', null, ['class' => 'form-control', 'step' => '0.01']) !!}
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
    </div>
</div>
