<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>iService</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<link href="{{  asset("/css/bootstrap.min.css") }}" rel="stylesheet">
	<link href="{{  asset("/css/font-awesome.min.css") }}" rel="stylesheet">
	<link href="{{  asset("/css/datepicker3.css") }}" rel="stylesheet">
    <link href="{{  asset("/vendor/izi-toast/dist/css/iziToast.min.css") }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" rel="stylesheet">

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

    @if(Session::has("sysMessage"))
        <script>
            var color = "";

            @if(Session::get("msgType") == "success")
                color = "green";
            @elseif(Session::get("msgType") == "error")
                color = "red";
            @elseif(Session::get("msgType") == "warning")
                color = "yellow";
            @else
                color = "blue";
            @endif


            iziToast.show({
                title: 'Sucesso',
                message: '{{ Session::get("sysMessage") }}',
                position: 'topCenter',
                color: color
            });
        </script>

    @endif

    @stack("scripts")

</body>
</html>
