@extends('adminlte::page')

@section('title', 'Novo Fornecedor')  

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Novo Fornecedor</h3>
            </div>


            <form action="{{route('suppliers.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name='name'
                            id="name" placeholder="Digite um nome" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="codiname_fantasygo">Nome fantasia</label>
                        <input type="text" class="form-control @error('name_fantasy') is-invalid @enderror" name="name_fantasy"
                            id="name_fantasy" placeholder="Digite o nome fantasia" value="{{ old('name_fantasy') }}" required>
                        @error('name_fantasy')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" class="form-control @error('cnpj') is-invalid @enderror" name="cnpj"
                            id="cnpj" placeholder="Digite o nome fantasia" value="{{ old('cnpj') }}" required >
                        @error('cnpj')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            id="phone" placeholder="Digite o telefone" value="{{ old('phone') }}" required >
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" 
                            name="description" id="description" placeholder="Digite a descrição" value="{{ old('description') }}">
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('suppliers.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>

    </div>

</div>

@stop
