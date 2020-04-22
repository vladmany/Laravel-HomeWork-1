<div class="preview-uploaded">

</div>

<div class="d-flex justify-content-center pb-1">
    <div class="img-preview d-none" style="background-image: {{$book->preview_path ?? null ? 'url(/storage/'.$book->preview_path : 'unset'}})"></div>
</div>


<div class="form-group row">
    {!! Form::label('preview', 'Обложка книги', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
    <div class="col-md-7">

        {!! Form::file('preview', ['class' => 'img-input-prev', 'accept' => 'image']) !!}

        @error('preview')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label('body', 'Файл книги(.fb2)', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-7">
        {!! Form::file('body', ['class' => 'book-body', 'accept' => '.fb2']) !!}

        @error('body')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label('title', 'Название', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-7">
        {!! Form::text('title', $book->title ?? null, ['class' => 'form-control book-title']) !!}

        @error('title')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label('annotation', 'Аннотация', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-7">
        {!! Form::textarea('annotation', $book->annotation ?? null, ['class' => 'form-control book-annotation']) !!}

        @error('annotation')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label('author', 'Автор', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-7">
        {!! Form::text('author', $book->author ?? null, ['class' => 'form-control book-author']) !!}

        @error('author')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label('genre_name', 'Жанр', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-7">
{{--        {!! Form::text('genre', null, ['class' => 'form-control book-genre']) !!}--}}
        {!! Form::select('genre_name', $selectGenreFields, $book->genre_name ?? null, ['class' => 'form-control']) !!}

        @error('genre')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label('year', 'Год', ['class' => 'col-md-4 col-form-label text-md-right']) !!}

    <div class="col-md-7">
        {!! Form::text('year', $book->year ?? null, ['class' => 'form-control book-year']) !!}

        @error('year')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>
