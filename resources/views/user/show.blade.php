@extends("layouts.main")

@section("page-title", $user->name )

@section("content")


    <form action="{{ route('user.update', $user) }}" method="POST">

        @csrf
        @method("put")

        <fieldset {{ Auth::user() == $user ? "" : "disabled=disabled" }}>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="staticEmail">Nome</label>
                        <input type="text" class="form-control" name="name" value="{{ old("name", $user->name) }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="staticEmail" >Email</label>
                        <input type="text" class="form-control" name="email" value="{{ old("email", $user->email) }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col-xs-12 text-right">
                <a href="{{ route('user.index') }}" class="btn btn-sm btn-secondary">Voltar</a>
                @if( Auth::user() == $user)
                <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
                <a href="{{ route('service.create', $user) }}" class="btn btn-sm btn-info">Adicionar Serviço</a>
    </form>
                <button type="submit" class="btn btn-sm btn-danger btnDel" data-form="frmDel{{ $user->id }}">
                    Excluir
                </button>
                <form action="{{ route('user.delete', $user) }}" method="POST" id="frmDel{{ $user->id }}">
                    @method('DELETE')
                    @csrf
                </form>
                @endif
            </div>
        </div>

    <h1>Serviços</h1>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th style="width: 80px;"></th>
            </tr>
        </thead>
        @foreach ($services as $service)
        @if( $service->user_id == $user->id )
        <tbody>
            <tr>
                <td><a href="{{ route('service.show', $service) }}">{{ $service->title }}</a></th>
                <td>{{ $service->description }}</td>
                <td>R$ {{ number_format($service->price,2) }}</td>
                <td>
                    <a href="{{ route('service.show', $service) }}" class="mr-2">
                        <i class="fa fa-eye"></i>
                    </a>
                    @if( Auth::user() == $service->owner)
                    <button type="submit" class="btn btn-link btnDel" data-form="frmDel{{ $service->id }}">
                        <i class="fa fa-trash text-danger"></i>
                    </button>
                    <form action="{{ route('service.delete', $service) }}" method="POST" id="frmDel{{ $service->id }}">
                        @method('DELETE')
                        @csrf
                    </form>
                    @endif
                </td>
            </tr>
        </tbody>
        @endif
        @endforeach
    </table>
    {{ $services->links() }}
    <h1>Clientes</h1>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Serviço</th>
            </tr>
        </thead>
        @foreach($services as $service)
            @foreach($service->user as $user)
                <tbody>
                    <tr>
                    <td><a href="{{ route('show.user', $user) }}">{{ $user->name }}</a></td>
                    <td><a href="{{ route('service.show', $service) }}">{{ $service->title }}</a></td>
                    </tr>
                </tbody>
            @endforeach
        @endforeach
    </table>
@endsection

@push("scripts")
<script>
    $("button.btnDel").click(function(e){
        e.preventDefault();
        var form = $(this).attr("data-form");

        swal.fire({
            title: 'Tem certeza?',
            text: "Esta ação é irreversivel!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $("#"+form).submit();
            }
        });

    })
    </script>
@endpush
