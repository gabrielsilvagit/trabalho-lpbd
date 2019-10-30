@extends("layouts.main")

@section("content")
    <div>
    <tr>
        <td>Nome</td>
        <td>Email</td>
        <td>Visitar perfil</td>
    </tr>
    </div>
    <div>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td><a href="{{ route('show.user', $user) }}">Perfil</a></td>
        </tr>
    @endforeach
    </div>
@endsection
