@extends('users.layouts.default')

@section('title', 'Информация о пользователе')

@section('content')
    <div class="jumbotron">
        <div class="container">

            <h1 class="display-3">Пользователь {{$user['employee_name']}}</h1>
            <div class="col-7">
                <div>
                    <h2>Имя: {{$user['employee_name'] }}</h2>
                    <h2>Возраст: {{$user['employee_age'] }}</h2>
                    <h2>Зарплата: {{$user['employee_salary'] }}</h2>
{{--                    <a class="btn btn-secondary" href="/users/{{ $loop->index }}" role="button">Подробнее</a>--}}
                </div>
            </div>
            <p><a class="btn btn-primary btn-lg" href="/users" role="button">Back</a></p>
        </div>
    </div>
@endsection
