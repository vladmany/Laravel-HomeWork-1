@extends('library.layouts.default')

@section('title', 'Добавление нового жанра')

@section('content')
    <div class="container">
        <div class="row justify-content-center auth-form">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Добавление нового жанра') }}</div>

                    <div class="card-body">
                        {!! Form::open(['url' => route('adminpanel.genres.store')]) !!}
                            @csrf

                            @include('library.adminpanel.genres.blocks.form.fields')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    {!! Form::submit('Добавить жанр', ['class' => 'btn btn-secondary']); !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
