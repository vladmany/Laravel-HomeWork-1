<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="text-muted" href="#">Подписаться</a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="/">Библиотека</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a class="text-muted" href="#" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Поиск</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
                </a>
                @guest
                    <a class="btn btn-sm btn-outline-secondary" href="{{route('login')}}">Войти</a>
                    @if (Route::has('register'))
                        <a class="btn btn-sm btn-outline-secondary" href="{{route('register')}}">Регистрация</a>
                    @endif
                @else
                    <div class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link {{ (Auth::user()->role_id == 2) ? 'nav-admin-font' : 'nav-user-font' }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}">Мои книги</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">Мой аккаунт</a>
                            @if(Auth::user()->role_id == 2)
                                <hr>
                                <a class="dropdown-item menu-admin-font" href="">Управление пользователями</a>
                                <a class="dropdown-item menu-admin-font" href="">Управление жанрами</a>
                                <a class="dropdown-item menu-admin-font" href="">Управление книгами</a>

                            @endif
                            <hr>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </header>

    @if(request()->path() == '/')
        @include('library.layouts.blocks.nav.genres')
    @endif
</div>

