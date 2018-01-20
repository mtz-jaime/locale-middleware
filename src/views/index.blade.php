<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Page | Middleware</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .sub-title {
            font-size: 34px;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
        .links a {
            text-decoration: none;
            color: #636b6f;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            {{ trans('languageTest.title') }}
        </div>
        <div class="sub-title m-b-md">
            {{ trans('languageTest.subTitle') }}
        </div>
        <hr>
        <div class="links m-b-md">
            <a href="{{route('middleware.cookieRedirect', 'en')}}">EN</a> |
            <a href="{{route('middleware.cookieRedirect', 'es')}}">ES</a> |
            <a href="{{route('middleware.cookieRedirect', 'de')}}">DE</a>
        </div>
    </div>
</div>
</body>
</html>