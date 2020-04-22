@extends('library.layouts.default')

@section('title', 'Мой аккаунт')

@section('content')
    <div class="container profile-wrapper">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6 mr-auto ml-auto">
                <div class="well profile col-sm-12">
                    <div class="col-sm-12">
                        <div class="col-12">
                            <h2 class="text-center">Мой аккаунт</h2>
                            <div class="preview-field" style="background-image: url(/storage/{{$avatar}})">
                            </div>
                            {!! Form::open(['url' => route('userpanel.profile.uploadAvatar'), 'files' => true]) !!}
                            @csrf

                            <div class="form-group row">
                                {!! Form::label('avatar', 'Аватар', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                <div class="col-md-7">

                                    {!! Form::file('avatar', ['accept' => 'image']) !!}

                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 d-flex justify-content-between">
                                    {!! Form::submit('Загрузить аватар', ['class' => 'btn btn-secondary']); !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                            <p><strong>Имя: </strong> {{ auth()->user()->name }} </p>
                            <p><strong>Email: </strong> {{ auth()->user()->email }} </p>
                            <p><strong>Опубликованных книг: </strong> {{ $books->count() }} </p>
                            <a class="btn btn-primary" href="{{ route('password.change') }}">Изменить пароль</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
