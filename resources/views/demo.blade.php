<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" data-cotroller="layouts--html-load">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title','ORCHID')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="apple-touch-icon" sizes="180x180" href="/orchid/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/orchid/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/orchid/favicon/favicon-16x16.png">
    <link rel="manifest" href="/orchid/favicon/manifest.json">
    <link rel="mask-icon" href="/orchid/favicon/safari-pinned-tab.svg" color="#1a2021">
    <meta name="apple-mobile-web-app-title" content="ORCHID">
    <meta name="application-name" content="ORCHID">
    <meta name="theme-color" content="#ffffff">

    <meta name="dashboard-prefix" content="{{Dashboard::prefix()}}">
    <meta name="description"
          content="Laravel Platform application provides a very flexible and extensible way of building your custom application.">
    <meta property="og:title" content="@yield('title','ORCHID')"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:image" content="{{config('content.image','/orchid/img/background.jpg')}}"/>

    <link rel="stylesheet" href="{{mix('/css/orchid.css','orchid')}}" type="text/css"/>
    <script async="async" src="{{mix('/js/orchid.js','orchid')}}" type="text/javascript"></script>
</head>
<body>


<div class="not-found">
    <div class="bg-white wrapper-lg b box-shadow-lg">
    <h1 class="h3 font-thin m-b-md">Demo API Client</h1>
    <hr>
    <form action="{{route('demo.send')}}">

        @if (count($errors) > 0)
            <div class="alert alert-info m-b-none" role="alert">
                <strong>Ответ:</strong>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif


        <div class="form-group">
            <label>Название проекта</label>
            <input type="text" name="name" value="{{old('name')}}" required class="form-control">
            <small class="form-text text-muted">Системное имя проекта</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">API KEY</label>
            <input type="text" name="token" value="{{old('token')}}" required class="form-control">
            <small class="form-text text-muted">Ключ аутентификация</small>
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Сгенерировать случайную ошибку</button>
    </form>
    </div>
</div>


</body>
</html>
