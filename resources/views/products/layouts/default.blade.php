<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Document')</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
@include('products.layouts.blocks.nav.index')

@yield('content')

@include('products.layouts.blocks.footer.index')

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
