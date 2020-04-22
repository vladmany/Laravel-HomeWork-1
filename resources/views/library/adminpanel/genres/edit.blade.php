@extends('library.layouts.default')

@section('title', 'Редактирование книги')

@section('content')
    <div class="container">
        <div class="row justify-content-center auth-form">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Редактирование жанра ') . $genre->name }}</div>

                    <div class="card-body">
                        {!! Form::open(['url' => route('adminpanel.genres.update', compact('genre')), 'files' => true]) !!}
                        @csrf

                        @method('PUT')

                        @include('library.adminpanel.genres.blocks.form.fields')

                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-4 d-flex justify-content-between">
                                {!! Form::submit('Применить изменения', ['class' => 'btn btn-secondary']); !!}
                                <button class="btn btn-outline-danger" onclick="
                                    if(confirm('Вы действительно хотите удалить книгу {{ $genre->name }} ?'))
                                    $('#destroy-form').submit();
                                    return false;
                                    ">Удалить</button>
                                <a class="btn btn-outline-secondary" href="{{ route('adminpanel.genres.index') }}">Отмена</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <form id="destroy-form" action="{{ route('adminpanel.genres.destroy', $genre->id) }}" method="POST">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
