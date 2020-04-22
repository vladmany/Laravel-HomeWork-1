@extends('library.layouts.default')

@section('title', $book->title)

@section('content')
    <div class="container">
        <h1 class="text-center">{{$book->title}}</h1>
        @foreach($bookBody as $paragraph)
        {!! $paragraph !!}
        @endforeach
    </div>
    <div class="container">
        {{ $bookBody->links() }}
    </div>
@endsection

