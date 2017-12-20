{!! Form::hidden('lat', null, ['id' => 'lat']) !!}
{!! Form::hidden('lng', null, ['id' => 'lng']) !!}
<div class="row">
    <div class="col-xl-12">
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
        <div class="form-group row m-t-25">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="u-name" class="col-form-label">Dirección</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"> <i class="fa fa-tint text-primary"></i></span>
                    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address-field']) !!}
                </div>
            </div>
        </div>
        <div class="m-t-25 map-container">
            <div id="map"></div>
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
