@extends('library.layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center auth-form">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Выберите действие</div>

                    <div class="card-body">
                        <p>Пользователь {{ $user->name }} является автором {{ $books->count() }} книг.</p>
                        <p>Вы хотите удалить только пользователя или также все его книги?</p>
                        <div class="d-flex justify-content-between">
                            <form id="destroy-form" action="{{ route('adminpanel.users.delOnlyUser', $user, $books) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-secondary" role="button">Только пользователя</button>
                            </form>
                            <form id="destroy-form" action="{{ route('adminpanel.users.delWithBooks', $user, $books) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-secondary" role="button">Также книги</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
