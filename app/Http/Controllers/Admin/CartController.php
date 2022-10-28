<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addCart(Request $request){


        $product = Produtos::where("id", $request->id)->first();
        if(!$product){
            return redirect()->withErrors("Produto não encontrado");
        }
        \Cart::session(Auth::user()->id)->add(array(
            'id' => $product->id,
            'name' => $product->nome,
            'price' => $product->preco,
            'quantity' => $request->quantidade ?? 1,
        ));

         return redirect()->back()->with('succes',"Produto Adicionado");
    }



}
