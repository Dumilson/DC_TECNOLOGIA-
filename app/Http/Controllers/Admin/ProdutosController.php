<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStoreUpdateProduto;
use App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index(){
        $data = Produtos::all();
        return view("users.index" , compact('data'));
    }

    public function store(RequestStoreUpdateProduto $requestStoreUpdateProduto){
        Produtos::create($requestStoreUpdateProduto->all());
        return redirect()->back()->with('success');
    }
}
