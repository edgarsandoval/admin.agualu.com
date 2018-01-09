
              <div class="form-group row m-t-25">
                  <div class="col-12 col-lg-3 text-lg-right">
                      <label for="u-name" class="col-form-label">No. de miembro</label>
                  </div>
                  <div class="col-12 col-xl-6 col-lg-8">
                      <div class="input-group">
                          <span class="input-group-addon"> <i class="fa fa-user text-primary"></i></span>
                          {!! Form::text('first_name', $user->id, ['class' => 'form-control', 'disabled' => isset($user)]) !!}
                      </div>
                  </div>
              </div>
              <div class="form-group row">
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
              <br>
              <hr>
              <br>
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
                      <label for="address" class="col-form-label">Calle *</label>
                  </div>
                  <div class="col-12 col-xl-6 col-lg-8">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-home text-primary"></i></span>
                          {!! Form::text('street', null, ['class' => 'form-control']) !!}
                      </div>
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-6 col-lg-3 text-lg-right">
                      <label for="address" class="col-form-label">No. ext *</label>
                  </div>
                  <div class="col-6 col-xl-3 col-lg-4">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-home text-primary"></i></span>
                          {!! Form::text('outdoor_number', null, ['class' => 'form-control']) !!}
                      </div>
                  </div>
                  <div class="">
                      <label for="address" class="col-form-label">No. int (opcional)</label>
                  </div>
                  <div class="col-6 col-xl-3 col-lg-4">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-home text-primary"></i></span>
                          {!! Form::text('indoor_number', null, ['class' => 'form-control']) !!}
                      </div>
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-12 col-lg-3 text-lg-right">
                      <label for="pincode" class="col-form-label">Colonia *</label>
                  </div>
                  <div class="col-12 col-xl-6 col-lg-8">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-home text-primary"></i></span>
                          {!! Form::text('suburb', null, ['class' => 'form-control']) !!}
                      </div>
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-12 col-lg-3 text-lg-right">
                      <label for="pincode" class="col-form-label">CP *</label>
                  </div>
                  <div class="col-12 col-xl-6 col-lg-8">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-home text-primary"></i></span>
                          {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
                      </div>
                  </div>
              </div>
              <br>
              <hr>
              <br>
              <div class="form-group row">
                  <div class="col-12 col-lg-3 text-lg-right">
                      <label for="u-name" class="col-form-label">CLABE interbancaria</label>
                  </div>
                  <div class="col-12 col-xl-6 col-lg-8">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-credit-card text-primary"></i></span>
                          {!! Form::text('clabe', null, ['class' => 'form-control']) !!}
                      </div>
                  </div>
              </div>
              <br>
              <hr>
              <br>
              <div class="form-group row">
                  <div class="col-12 col-lg-3 text-lg-right">
                      <label class="col-form-label">Rango</label>
                  </div>
                 <div class="col-12 col-xl-6 col-lg-8">
                      {{ Form::select('range_id', $ranges, null, ['class' => 'form-control']) }}
                 </div>
              </div>
              <div class="form-group row">
                  <div class="col-12 col-lg-3 text-lg-right">
                      <label class="col-form-label">Estado de miembro</label>
                  </div>
                  <div class="col-12 col-xl-6 col-lg-8">
                      {{ Form::select('status', $status, null, ['class' => 'form-control']) }}
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-12 col-lg-3 text-lg-right">
                      <label class="col-form-label">Roles</label>
                  </div>
                  <div class="col-12 col-xl-6 col-lg-8">
                      @foreach ($roles as $role)
                          {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
                          @if ($role->name == 'admin')
                              {{ Form::label($role->name, ucfirst('administrador')) }}<br>
                          @elseif ($role->name == 'partner')
                              {{ Form::label($role->name, ucfirst('asociado')) }}<br>
                          @else
                              {{ Form::label($role->name, ucfirst('personal administrativo')) }}<br>
                          @endif
                      @endforeach
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-12 col-lg-9 push-lg-3">
                      <button class="btn btn-primary" type="submit">
                          Guardar
                      </button>
                  </div>
              </div>
