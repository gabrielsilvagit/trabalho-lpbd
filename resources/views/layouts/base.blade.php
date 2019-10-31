<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("APP_NAME") }}</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<link href="{{  asset("/css/bootstrap.min.css") }}" rel="stylesheet">
	<link href="{{  asset("/css/font-awesome.min.css") }}" rel="stylesheet">
	<link href="{{  asset("/css/datepicker3.css") }}" rel="stylesheet">
    <link href="{{  asset("/css/styles.css") }}" rel="stylesheet">
    {{--  <link href="{{  asset("/css/font-awesome.min.css") }}" rel="stylesheet">  --}}


    <link rel="stylesheet" href="{{ asset("/css/app.css") }}">

    @stack("styles")
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>

    @yield("body")


    @include("layouts.partials.scripts")
    @stack("scripts")

</body>
</html>
