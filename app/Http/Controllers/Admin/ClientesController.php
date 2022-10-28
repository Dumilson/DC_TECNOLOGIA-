<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestRegisterCliente;
use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index(){
        $data = Clientes::all();
        return view('users.clientes',compact('data'));
    }
    public function store(RequestRegisterCliente $requestRegisterCliente){
        Clientes::create($requestRegisterCliente->all());
        return redirect()->back()->with('success');
    }
}
