@extends('adminlte::page')

@section('title', 'Editar Produto')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Produto</h3>
            </div>


            <form action="{{route('products.update',[$product->id])}}" method="post" enctype="multipart/form-data">
                @csrf 
                @method('PUT')
                <div class="card-body">
                
                <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"  value="{{$category->name}}" name='name' id="name" 
                            placeholder="Digite um nome" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input type="codigo" class="form-control @error('codigo') is-invalid @enderror" name="codigo"
                            id="codigo" placeholder="Digite o código" value="{{ $product->codigo }}" required>
                        @error('codigo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="icone">Imagem</label>
                        <img src="/img/icon/{{ $product->image }}" alt="" class="mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                        <input type="file" class="form-control" id="image" name="image" value="{{ $product->image }}">
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
                    <a href="{{route('products.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>


    </div>

</div>

@stop