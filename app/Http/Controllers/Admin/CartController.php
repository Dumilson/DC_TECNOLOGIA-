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



    public function removeCart($id_shop, $id_product){
        \Cart::session($id_shop)->remove($id_product);

        return view('shop.includes.data_cart');
    }

    public function removeCartCheckout($id_shop, $id_product){
        \Cart::session($id_shop)->remove($id_product);

        return view('shop.includes.cart_checkout');
    }

    public function updateCart($id_shop, $id_product,$quant){
        $product = DB::table('stocks')
        ->join('products','stocks.id_produto_fk','=','products.id')
        ->select("nome_produto",'preco_venda','quant_existente','image','products.id')
        ->where('stocks.id_produto_fk','=', $id_product)->first();


        if($quant == 0){
            \Cart::session($id_shop)->remove($id_product);
            return view('shop.includes.data_cart');
        }

        if($cart = \Cart::session(session('id_shop'))->get($id_product)){
            if($cart->quantity <= $product->quant_existente){
                 if($quant <= $product->quant_existente){
                    if($quant === 0){
                        \Cart::session(session('id_shop'))->remove($id_product);
                        return view('shop.includes.data_cart');
                    }
                    \Cart::session($id_shop)->update($id_product, array (
                        'quantity' => array(
                            'relative' => false,
                            'value' => $quant
                        ),
                    ));
                }
                return  view('shop.includes.data_cart');
            }
        }

        \Cart::session($id_shop)->update($id_product, array (
            'quantity' => array(
                'relative' => false,
                'value' => $quant
            ),
        ));

        return view('shop.includes.data_cart');
    }


    public function subTotal(){
        return view('shop.includes.subtotal');
    }

    public function cartCheckout(){
        return view('shop.includes.cart_checkout');
    }

    public function good(){
        return number_format(\Cart::session(session('id_shop'))->getTotal(),2,',','.')." AO";
    }


    public function countCart(){
        return view('shop.includes.count_cart');
    }

}
