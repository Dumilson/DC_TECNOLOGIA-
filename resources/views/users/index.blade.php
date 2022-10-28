@extends('users.app')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Produtos</h1>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#add-product">
                    Adicionar Produto
                </button>
            </div>
        </div>


        <h2>Lista de Produtos</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Precço</th>
                        <th>Quantidade Existente</th>
                        <th>Data</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->nome}}</td>
                            <td>{{$item->preco}}</td>
                            <td>{{$item->qtd}}</td>
                            <td>{{$item->date}}</td>
                            <td>
                                <button class="btn btn-sm btn-primary">
                                    Adicionar ao carrinho
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <div id="add-product" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Adicionar Produto</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action=" {{ route('store.produto') }} ">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Nome do Produto</span>
                            </div>
                            <input class="form-control" type="text" name="nome" placeholder="Nome do Produto">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Preço</span>
                            </div>
                            <input class="form-control" type="text" name="preco" placeholder="Preço do Produto">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Estoque</span>
                            </div>
                            <input class="form-control" type="text" name="qtd" placeholder="Nome do Produto">
                        </div>

                        <div>
                            <button class="btn btn-primary btn-block" type="submit">Salvar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    Footer
                </div>
            </div>
        </div>
    </div>
@endsection
