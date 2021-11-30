<?php

namespace App\Http\Controllers;

use App\Models\Voto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function autentica (Request $request){

        $credentials = $request->only('cpf', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('eleitor-unidade');
        }

        Auth::logout();
        return redirect('/')->with('alertas', 'Dados inválidos.');

    }


    public function login(){
        Auth::logout();
        return view('login.index');

    }


    public function logout () {

        Auth::logout();
        return redirect('/')->with('alertas', 'Logout realizado com sucesso.');

    }

}
