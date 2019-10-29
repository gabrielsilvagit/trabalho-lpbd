
@extends("layouts.main")

<style>
    
</style>

@section("content")
    <h2>Old</h2>

    @push("scripts")
    <script>
        alert("teste")
    </script>
    @endpush

@endsection
