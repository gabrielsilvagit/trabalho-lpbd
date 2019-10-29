<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bem-Vindo</title>
        <style>
            .box {
                height: 100%;
            }
        </style>
    </head>
    <body>
    @include('layouts.menu')
    <div class="container">
        <div class="box shadow-lg p-3 mb-5 bg-white rounded">
            <h1 class="nav justify-content-center">BEM VINDO</h1>
        </div>
    </div>
    </body>
</html>
