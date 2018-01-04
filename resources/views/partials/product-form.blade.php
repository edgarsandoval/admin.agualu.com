<div class="row">
    <div class="col-xl-12">
        <div class="form-group row m-t-25">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="u-name" class="col-form-label">SKU *</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"> <i class="fa fa-archive text-primary"></i></span>
                    {!! Form::text('sku', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="form-group row m-t-25">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="u-name" class="col-form-label">Nombre *</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"> <i class="fa fa-archive text-primary"></i></span>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="u-name" class="col-form-label">Descripción corta</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    {!! Form::textarea('short_description', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        @ckeditor('short_description')

        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="u-name" class="col-form-label">Descripción</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        @ckeditor('description')

        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="u-name" class="col-form-label">Beneficios</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    {!! Form::textarea('benefits', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        @ckeditor('benefits')

        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="u-name" class="col-form-label">Recomendaciones</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    {!! Form::textarea('recommendations', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        @ckeditor('recommendations')

        <div class="form-group row">
            <div class="col-12 col-lg-9 push-lg-3">
                <button class="btn btn-primary" type="submit">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>
