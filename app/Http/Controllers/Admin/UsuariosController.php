<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestRegisterUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index(){
        $data = User::all();
        return view('users.users',compact('data'));
    }
    public function store(RequestRegisterUsuario $requestRegisterUsuario){
        User::create([
            "nome" => $requestRegisterUsuario->nome,
            "email" => $requestRegisterUsuario->email,
            "password" => Hash::make($requestRegisterUsuario->password)
        ]);
        return redirect()->back()->with('success');
    }
}
