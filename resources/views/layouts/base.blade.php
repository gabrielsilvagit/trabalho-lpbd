<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("APP_NAME") }}</title>

    <link rel="stylesheet" href="{{ asset("/css/app.css") }}">
    @stack("styles")
</head>
<body>

    @yield("body")
    @stack("scripts")
    <script src="{{ asset("/js/app.js") }}"></script>

</body>
</html>
