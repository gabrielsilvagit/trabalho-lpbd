@extends("layouts.base")

@section("body")

@include('layouts.partials.header')
@yield("content")
@include('layouts.partials.footer')

@endsection