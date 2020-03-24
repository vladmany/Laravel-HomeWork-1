@extends('users.layouts.default')

@section('title', 'Список пользователей')

@section('content')
    <div class="jumbotron">
        <div class="container">

            <h1 class="display-3">Список пользователей</h1>
            <div class="col-7">
                <ul type="none">
                    @forelse($users as $user)
                        <li class="mt-1">
                            <div class="d-flex justify-content-between">
                                <h2>{{$loop->iteration}}. {{ $user->employee_name }}</h2>
                                <a class="btn btn-secondary" href="/users/{{ $loop->index }}" role="button">Подробнее</a>
                            </div>

{{--                            <div class="row user-info d-block">--}}
{{--                                <h5>Id пользователя: {{ $user->id }}</h5>--}}
{{--                                <h5>Возраст: {{ $user->employee_age }}</h5>--}}
{{--                                <h5>Зарплата: {{ $user->employee_salary }}</h5>--}}
{{--                            </div>--}}
                        </li>
                    @empty
                        No users
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
