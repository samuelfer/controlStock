@extends('adminlte::page')

@section('title', 'Lista de Produtos')

@section('content_header')
<h3></h3>
@stop

@section('content')


<div class="row">
    <div class="col-12">
        @include('shared.success-message')
        @include('shared.error-message')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de produtos</h3>
                @can('products.create')
                <a href="{{route('products.create')}}" class="btn btn-sm btn-success float-right">NOVO PRODUTO</a>
                @endcan
            </div>

            <div class="card-body">
                <div id="list" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">

                            <table id="list-products" class="table table-bordered table-striped dataTable dtr-inline"
                                aria-describedby="list-products">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOME</th>
                                        <th>CÓDIGO</th>
                                        <th>ÍCONE</th>
                                        <th>CRIADO</th>
                                        <th>ATUALIZADO</th>
                                        <th style="width: 20px;">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->codigo }}</td>
                                        <td class="text-center align-middle">
                                            <img src="/img/icon/{{ $product->icone }}" alt="" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                        </td>
                                        <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                                        <td style="display: inline-block; width: 110px;">
                                            @can('products.update')<a href="{{route('products.edit',[$product->id])}}"
                                                class="btn btn-sm btn-success float-left">Editar</a>@endcan
                                            @can('products.delete')
                                            <form action="{{route('categories.delete', $product->id)}}" method="post"
                                                class="delete-product">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>

                                    @empty
                                    <tr>
                                        <td colspan="5"> Ainda não há Produtos cadastrados.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    @stop


    @section('js')

    @if(session('successDel'))
    <script>
    Swal.fire({
        title: "Excluído!",
        text: <?= session('successDel')  ?>,
        icon: "success"
    });
    </script>
    @endif

    @if(session('errorDel'))
    <script>
    Swal.fire({
        title: "Atenção!",
        text: '<?= session('errorDel')  ?>',
        icon: "warning"
    });
    </script>
    @endif

    <script>
    $(function() {

        $("#list-products").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "search": "Pesquisar",
            "paginate": {
                "next": "Próximo",
                "previous": "Anterior",
                "first": "Primeiro",
                "last": "Último"
            },
            "language": {
                "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
            },
        });
    });

    $('.delete-product').submit(function(ev) {
        ev.preventDefault();

        Swal.fire({
            title: "Tem certeza que deseja excluir?",
            text: "O registro será excluído!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, excluir!"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
    </script>

    @stop