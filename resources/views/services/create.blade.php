@extends("layouts.main")

@section("page-title", "Criar servico" )

@section("content")
    <form action="{{ route('service.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="staticEmail">Titulo</label>
                    <input type="text" class="form-control" name="title" value="{{ old("title") }}">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="staticEmail">Descrição</label>
                    <input type="text" class="form-control" name="description" value="{{ old("description") }}">
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="staticEmail">Preço</label>
                    <input type="text" class="form-control" name="price" value="{{ old("price") }}">
                    @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Salvar</button>
    </form>
@endsection
