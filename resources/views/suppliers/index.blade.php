@extends('adminlte::page')

@section('title', 'Lista de Fornecedores')

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
                <h3 class="card-title">Lista de fornecedores</h3>
                @can('categories.create')
                <a href="{{route('suppliers.create')}}" class="btn btn-sm btn-success float-right">NOVO FORNECEDOR</a>
                @endcan
            </div>

            <div class="card-body">
                <div id="list" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">

                            <table id="list-suppliers" class="table table-bordered table-striped dataTable dtr-inline"
                                aria-describedby="list-suppliers">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOME</th>
                                        <th>NOME FANTASIA</th>
                                        <th>CNPJ</th>
                                        <th>TELEFONE</th>
                                        <th>CRIADO</th>
                                        <th>ATUALIZADO</th>
                                        <th style="width: 20px;">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->id }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->name_fantasy }}</td>
                                        <td>{{ $supplier->cnpj }}</td>
                                        <td>{{ $supplier->phone }}</td>
                                        <td>{{ $supplier->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $supplier->updated_at->format('d/m/Y H:i') }}</td>
                                        <td style="display: inline-block; width: 110px;">
                                            @can('suppliers.update')<a href="{{route('suppliers.edit',[$supplier->id])}}"
                                                class="btn btn-sm btn-success float-left">Editar</a>@endcan
                                            @can('suppliers.delete')
                                            <form action="{{route('suppliers.delete', $supplier->id)}}" method="post"
                                                class="delete-supplier">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>

                                    @empty
                                    <tr>
                                        <td colspan="5"> Ainda não há Fornecedores cadastrados.</td>
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

        $("#list-suppliers").DataTable({
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

    $('.delete-supplier').submit(function(ev) {
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