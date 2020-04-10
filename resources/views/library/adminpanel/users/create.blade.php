@extends('library.layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center auth-form">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Добавление нового пользователя') }}</div>

                    <div class="card-body">
                        {!! Form::open(['url' => route('adminpanel.users.store')]) !!}
                            @csrf

                            @include('library.adminpanel.users.blocks.form.fields')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    {!! Form::submit('Добавить пользователя', ['class' => 'btn btn-secondary']); !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
