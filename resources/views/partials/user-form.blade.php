<div class="row">
    <div class="col-xl-12">
        {{-- <div class="form-group row m-t-15">
            <div class="col-12 col-lg-3 text-center text-lg-right">
                <label class="col-form-label">Imagen de perfil</label>
            </div>
            <div class="col-12 col-lg-6 text-center text-lg-left">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new img-thumbnail text-center">
                        <img src="{{asset('assets/img/admin.jpg')}}" data-src="img/admin.jpg" alt="not found"></div>
                    <div class="fileinput-preview fileinput-exists img-thumbnail"></div>
                    <div class="m-t-20 text-center">
                                    <span class="btn btn-primary btn-file">
                                    <span class="fileinput-new">Cambiar imagen</span>
                                    <span class="fileinput-exists">Cambiar</span>
                                    <input type="file" name="...">
                                    </span>
                        <a href="#" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="form-group row m-t-25">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="u-name" class="col-form-label">Nombre *</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"> <i class="fa fa-user text-primary"></i></span>
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="u-name" class="col-form-label">Apellido *</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user text-primary"></i></span>
                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="email" class="col-form-label">Email *
                </label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope text-primary"></i></span>
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
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
        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="phone" class="col-form-label">Teléfono *</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone text-primary"></i></span>
                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="phone" class="col-form-label">Celular (opcional)</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone text-primary"></i></span>
                    {!! Form::text('cellphone', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group gender_message row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label class="col-form-label">Género *</label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="custom-controls-stacked">
                    <label class="custom-control custom-radio">
                        {{ Form::radio('gender', 'M', true, ['class' => 'custom-control-input']) }}
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Masculino</span>
                    </label>
                    <label class="custom-control custom-radio">
                        {{ Form::radio('gender', 'F', null, ['class' => 'custom-control-input']) }}
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Femenino</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label class="col-form-label">Estado</label>
            </div>
           <div class="col-12 col-xl-6 col-lg-8">
               {{ Form::select('state_id', $states, null, ['id' => 'state', 'class' => 'form-control', 'disabled' => isset($user)]) }}
           </div>
       </div>
       <div class="form-group row">
           <div class="col-12 col-lg-3 text-lg-right">
               <label class="col-form-label">Ciudad</label>
           </div>
          <div class="col-12 col-xl-6 col-lg-8">
              {{ Form::select('city_id', $cities, null, ['id' => 'city', 'class' => 'form-control']) }}
          </div>
      </div>
        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="address" class="col-form-label">Calle *
                </label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-plus text-primary"></i></span>
                    {!! Form::text('street', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-6 col-lg-3 text-lg-right">
                <label for="address" class="col-form-label">No. ext *
                </label>
            </div>
            <div class="col-6 col-xl-3 col-lg-4">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-plus text-primary"></i></span>
                    {!! Form::text('outdoor_number', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="">
                <label for="address" class="col-form-label">No. int
                </label>
            </div>
            <div class="col-6 col-xl-3 col-lg-4">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-plus text-primary"></i></span>
                    {!! Form::text('indoor_number', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="pincode" class="col-form-label">Colonia *
                </label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-plus text-primary"></i></span>
                    {!! Form::text('suburb', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label for="pincode" class="col-form-label">CP *
                </label>
            </div>
            <div class="col-12 col-xl-6 col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-plus text-primary"></i></span>
                    {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 col-lg-3 text-lg-right">
                <label class="col-form-label">Rango</label>
            </div>
           <div class="col-12 col-xl-6 col-lg-8">
                {{ Form::select('range_id', $ranges, null, ['class' => 'form-control']) }}
           </div>
       </div>
       <div class="form-group gender_message row">
           <div class="col-12 col-lg-3 text-lg-right">
               <label class="col-form-label">Cliente preferente</label>
           </div>
           <div class="col-12 col-xl-6 col-lg-8">
               <div class="custom-controls-stacked">
                   <label class="custom-control custom-checkbox">
                       {{ Form::checkbox('preferential', 1, null, ['class' => 'custom-control-input']) }}
                       <span class="custom-control-indicator"></span>
                   </label>
               </div>
           </div>
       </div>
       <div class="form-group row">
           <div class="col-12 col-lg-3 text-lg-right">
               <label class="col-form-label">Estado</label>
           </div>
          <div class="col-12 col-xl-6 col-lg-8">
              {{ Form::select('status', $status, null, ['class' => 'form-control']) }}
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
