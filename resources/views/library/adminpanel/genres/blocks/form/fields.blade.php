<div class="form-group row">
    {!! Form::label('name', 'Название', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-6">
        {!! Form::text('name', $genre->name ?? null, ['class' => 'form-control']) !!}

        @error('name')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

