<div class="container">
    <div class="py-1 mb-2">
        <nav class="nav d-flex justify-content-between flex-wrap genres">
            <a class="p-2 text-muted {{ (($data['selGenre'] == 'all') or $data['selGenre'] == null) ? 'active' : '' }}" href="/?genre=all">Все жанры</a>
            @foreach($data['genres'] as $genre)
                <a class="p-2 text-muted {{ ($data['selGenre'] == $genre->name) ? 'active' : '' }}" href="?genre={{$genre->name}}">{{$genre->name}}</a>
            @endforeach
        </nav>
    </div>
</div>

