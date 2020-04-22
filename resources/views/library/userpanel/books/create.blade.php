@extends('library.layouts.default')

@section('title', 'Добавление новой книги')

@section('content')
    <div class="container">
        <div class="row justify-content-center auth-form">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Добавление новой книги') }}</div>

                    <div class="card-body">
                        {!! Form::open(['url' => route('userpanel.books.store'), 'files' => true]) !!}
                            @csrf

                            @include('library.userpanel.books.blocks.form.fields')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 d-flex justify-content-between">
                                    {!! Form::submit('Добавить книгу', ['class' => 'btn btn-secondary']); !!}
                                    <a class="btn btn-outline-secondary" href="{{ route('userpanel.books.index') }}">Отмена</a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
