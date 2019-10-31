@extends("layouts.base")

@section("body")
@include("layouts.partials.header")

	@include("layouts.partials.sidebar")

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

         {{--  PAGETITLE  --}}
        @include("layouts.partials.page_title")

         {{--  CONTENT  --}}
		<div class="panel panel-container">
            @yield("content")
        </div>
    </div>

@endsection
