@extends("layouts.main")

@section("page-title", "Serviços")

@section("content")
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Prestador</th>
            <th style="width: 80px;"></th>
        </tr>
    </thead>
    <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->title }}</td>
                <td>{{ $service->description }}</td>
                <td>R$ {{ number_format($service->price,2) }}</td>
                <td>{{ $service->owner->name }}</td>
                <td>
                    <a href="{{ route('service.show', $service) }}">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
