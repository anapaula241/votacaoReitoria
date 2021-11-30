<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnidadeController extends Controller
{

    public function index(){

        $dadosUnidade = Unidade::find(Auth::user()->unidade_id);

        return view('eleitor.unidades', compact('dadosUnidade'));
    }
}
