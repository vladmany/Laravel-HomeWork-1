@extends('library.layouts.default')

@section('title', 'Мои книги')

@section('content')
    <div class="container">
        <h1 class="display-4" style="text-align: center">Мои книги</h1>
        <div class="row mb-2">
            <div class="col-md-4">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static justify-content-center text-center book-add-block" onclick="location.href='{{ route('userpanel.books.create') }}'">
                        <span class="book-add-link">+</span>
                        <span class="book-add-link-text">Добавить новую книгу</span>
                    </div>
                </div>
            </div>
            @foreach($books as $book)
                <div class="col-md-4">
                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static justify-content-between">
                            <div>
                                <div class="preview-field" style="background-image: url(/storage/{{$book->preview_path}})" onclick="location.href='{{ route('books.show', compact('book')) }}'">
                                </div>
                                <h3 class="mb-0">{{ $book->title }}</h3> {{-- Max length 58 --}}
                            </div>
                            <div class="book-info">
                                <div class="mb-1 text-muted">Жанр: {{ $book->genre_name }}</div>
                                <div class="mb-1 text-muted">Автор: {{ $book->author }}</div>
                                <div class="mb-1 text-muted">Год: {{ $book->year }}</div>
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <a class="btn btn-sm btn-outline-secondary flex-fill mr-1" href="{{ route('books.show', compact('book')) }}">Подробнее</a>
                                <a class="btn btn-sm btn-outline-secondary flex-fill" href="{{ route('userpanel.books.edit', compact('book')) }}">Редактировать</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
