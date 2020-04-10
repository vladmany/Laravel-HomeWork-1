

<div class="form-group row">
    {!! Form::label('name', 'Имя', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-6">
        {!! Form::text('name', $user->name ?? null, ['class' => 'form-control']) !!}

        @error('name')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label('email', 'E-mail адрес', ['class' => "col-md-4 col-form-label text-md-right"]) !!}

    <div class="col-md-6">
        {!! Form::text('email', $user->email ?? null, ['class' => 'form-control']) !!}

        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label('password', 'Пароль', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-6">
        {!! Form::password('password', ['class' => 'form-control']) !!}

        @error('password')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<script src="{{ mix('js/custom.js') }}"></script>
{{--<div class="form-group row">--}}
{{--    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Повторите пароль') }}</label>--}}

{{--    <div class="col-md-6">--}}
{{--        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">--}}
{{--    </div>--}}
{{--</div>--}}
