@extends('library.layouts.default')

@section('content')
    <main role="main">
        <div class="container">
            <!-- Example row of columns -->
            <div class="row mb-2">
                @foreach($data['books'] as $book)
                <div class="col-md-4">
                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static justify-content-between">
                            <div>
                                <div class="preview-field">
                                </div>
                                <h3 class="mb-0">{{ $book->title }}</h3> {{-- Max length 58 --}}
                            </div>
                            <div>
                                <div class="mb-1 text-muted">Жанр: {{ $book->genre_name }}</div>
                                <div class="mb-1 text-muted">Автор: {{ $book->author }}</div>
                                <div class="mb-1 text-muted">Год: {{ $book->year }}</div>
                            </div>
                            <a class="btn btn-sm btn-outline-secondary" href="#">Читать</a>
                        </div>
                    </div>
                </div>
                @endforeach
{{--                <div class="col-md-4">--}}
{{--                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">--}}
{{--                        <div class="col p-4 d-flex flex-column position-static">--}}
{{--                            <strong class="d-inline-block mb-2 text-success">Design</strong>--}}
{{--                            <h3 class="mb-0">Post title</h3>--}}
{{--                            <div class="mb-1 text-muted">Nov 11</div>--}}
{{--                            <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>--}}
{{--                            <a href="#" class="stretched-link">Continue reading</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">--}}
{{--                        <div class="col p-4 d-flex flex-column position-static">--}}
{{--                            <strong class="d-inline-block mb-2 text-success">Design</strong>--}}
{{--                            <h3 class="mb-0">Post title</h3>--}}
{{--                            <div class="mb-1 text-muted">Nov 11</div>--}}
{{--                            <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>--}}
{{--                            <a href="#" class="stretched-link">Continue reading</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div> <!-- /container -->

    </main>
@endsection
