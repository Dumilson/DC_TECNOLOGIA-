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

            <div>
                @if (\Cart::session(Auth::user()->id)->getContent()->count() > 0)
                    <button class="btn btn-success" data-toggle="modal" data-target="#add-venda">
                        Registrar  Venda
                    </button>
                @endif
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
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nome }}</td>
                            <td>    {{number_format( $item->preco,2,',','.')}} </td>
                            <td>{{ $item->qtd }}</td>
                            <td>{{ $item->date }}</td>
                            <td>
                                <form class="form-inline" method="post" action=" {{ route('cart.add') }} ">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="number" placeholder="quantidade" class="form-control mr-2"
                                        name="quantidade" value="1">
                                    <button class="btn btn-sm btn-primary">
                                        Adicionar ao carrinho
                                    </button>
                                </form>
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


    <div id="add-venda" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
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
                        <table class="table table-light">
                            <thead>
                                <tr>
                                    <th>
                                        Nome
                                    </th>
                                    <th>
                                        Quantidade
                                    </th>
                                    <th>
                                        Preço
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\Cart::session(Auth::user()->id)->getContent() as $cart)
                                <tr>
                                    <td> {{$cart->name}} </td>
                                    <td> {{$cart->quantity}} </td>
                                    <td> {{number_format($cart->price,2,',','.')}} RS</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="form-group">
                            <label for="clientes">Selecione o Cliente</label>
                            @foreach ($clientes as $item)
                            <select id="clientes" class="form-control" name="id_cliente" required>
                                <option value=" {{$item->id}} "> {{$item->nome_cliente}} </option>
                            </select>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="clientes">Pagamento</label>
                            <select id="clientes" class="form-control" name="id_cliente" required onclick="getPagamento(this)">
                                <option value="">Selecione a Forma de Pagamento</option>
                                <option value="1"> Pagamento a Vista</option>
                                <option value="2"> Pagamento Parcelado</option>
                            </select>
                        </div>
                        <div class="pagamento">

                        </div>


                        <div class="m-2" >
                            <b>Total a Pagar: </b> {{number_format(Cart::session(Auth::user()->id)->getTotal(),2,',','.')}}
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

    @push('js')
    <script>
        function getPagamento(e){
            if(e.id == 1){
                alert("1")
            }
        }
    </script>
    @endpush

@endsection
