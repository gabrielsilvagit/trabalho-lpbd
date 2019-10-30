@extends("layouts.main")

@section("content")
    <div>
    <tr>
        <td>Prestador</td>
        <td>Titulo</td>
        <td>Descrição</td>
        <td>Preço</td>
        <td>Visitar serviço</td>
    </tr>
    </div>
    <div>
    @foreach($services as $service)
        <tr>
            <td>{{ $service->owner->name }}</td>
            <td>{{ $service->title }}</td>
            <td>{{ $service->description }}</td>
            <td>{{ $service->price }}</td>
            <td><a href="{{ route('service.show', $service) }}">Serviço</a></td>
        </tr>
    @endforeach
    </div>
@endsection
