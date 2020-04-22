@extends('library.layouts.default')

@section('title', 'Изменение учётной записи пользователя')

@section('content')
    <div class="container">
        <div class="row justify-content-center auth-form">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Изменение учётной записи пользователя ') . $user->name }}</div>

                    <div class="card-body">
                        {!! Form::open(['url' => route('adminpanel.users.update', $user->id), 'method' => 'patch']) !!}
                            @csrf

                            @include('library.adminpanel.users.blocks.form.fields')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    {!! Form::submit('Применить правки', ['class' => 'btn btn-secondary']); !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
