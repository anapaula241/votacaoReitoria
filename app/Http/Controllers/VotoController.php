<?php

namespace App\Http\Controllers;

use App\Mail\comprovanteVoto;
use App\Mail\SenhasAcesso;
use App\Models\Chapa;
use App\Models\Eleitor;
use App\Models\Unidade;
use App\Models\Voto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class VotoController extends Controller
{

    public function index($unidade)
    {

        if (Auth::user()->unidade_id != $unidade) {
            return redirect()->route('home')->with('alertas', 'Acesso Inadequado.');
        }

        $unidade = Unidade::find($unidade);
        $chapas = $unidade->chapas;

        return view('eleitor.chapas', compact('chapas', 'unidade'));
    }

    public function saveVote(Request $request, $idChapa)
    {

        $this->validaVotoChapa($idChapa);

        $chapa = Chapa::find($idChapa);
        $unidade = Unidade::find($chapa->unidade_id);

        $voto = Voto::create([
            'data_hora' => Carbon::now(),
            'voto' => $idChapa,
            'chapa' => $chapa->nome_chapa,
            'tipo' => Auth::user()->tipo,
            'eleitor_id' => Auth::id(),
            'unidade_id' => $chapa->unidade_id,
            'nome_unidade' => $unidade->nome,
            'ip' => $request->ip()
        ]);

        if ($voto) {
            $this->enviaEmailConfirmacaoLogout($voto);
            return redirect()->route('eleitor-confirma');
        }
    }

    public function saveVoteBranco(Request $request)
    {

        $unidade = Unidade::find(Auth::user()->unidade_id);

        $voto = Voto::create([
            'data_hora' => Carbon::now(),
            'voto' => 'BRANCO',
            'chapa' => 'BRANCO',
            'tipo' => Auth::user()->tipo,
            'eleitor_id' => Auth::id(),
            'unidade_id' => $unidade->id,
            'nome_unidade' => $unidade->nome,
            'ip' => $request->ip()
        ]);

        if ($voto) {
            $this->enviaEmailConfirmacaoLogout($voto);
            return redirect()->route('eleitor-confirma');
        }
    }

    public function saveVoteNulo(Request $request)
    {

        $unidade = Unidade::find(Auth::user()->unidade_id);

        $voto = Voto::create([
            'data_hora' => Carbon::now(),
            'voto' => 'NULO',
            'chapa' => 'NULO',
            'tipo' => Auth::user()->tipo,
            'eleitor_id' => Auth::id(),
            'unidade_id' => $unidade->id,
            'nome_unidade' => $unidade->nome,
            'ip' => $request->ip()
        ]);

        if ($voto) {
            $this->enviaEmailConfirmacaoLogout($voto);
            return redirect()->route('eleitor-confirma');
        }
    }

    public function enviaEmailConfirmacaoLogout($voto)
    {
        Mail::to(Auth::user()->email)->send(new comprovanteVoto($voto));
        Auth::logout();

        session()->put('rota', Route::current()->getName());
    }


    public function confirmaVoto()
    {
        if (session()->has('rota')) {
            if (array_search(session()->get('rota'), ['eleitor-voto', 'eleitor-branco', 'eleitor-nulo']) !== false) {
                session()->flush();
                return view('eleitor.confirmavoto');
            }
        }
        return redirect()->route('home')->with('alertas', 'Acesso Inadequado.');
    }

    public function contaNumeroVotosEleitor()
    {
        $idUser = Auth::id();

        return Voto::where('eleitor_id', $idUser)->get()->count();

    }


    public function unidadeEleitorIgualUnidadeChapa($idUnidadeEleitor, $idChapa)
    {


        $chapa = Chapa::find($idChapa);

        if ($idUnidadeEleitor === $chapa->unidade_id) {
            return true;
        }

        return false;
    }


    public function existeIdChapa($idChapa)
    {

        if (Chapa::find($idChapa)) {
            return true;
        };
        return false;

    }

    public function validaVotoChapa($idChapa)
    {
        if (!$this->existeIdChapa($idChapa)) {
            return redirect('/')->with('alertas', 'Chapa Inválida.');
        }

        if (!$this->unidadeEleitorIgualUnidadeChapa(Auth::user()->unidade_id, $idChapa)) {
            return redirect('/')->with('alertas', 'O usuário não pode votar em chapas dessa unidade.');
        }

        if ($this->contaNumeroVotosEleitor() !== 0) {
            return redirect('/')->with('alertas', 'Voto cancelado. Você já votou antes...');
        }
    }


    public function solicitaSenha(Request $request)
    {


        $eleitor = Eleitor::where('cpf', $request->cpf)->first();

        if ($eleitor) {
            $now = Carbon::now();
            $ultimaRecuperacaoCarbon = new Carbon($eleitor->solicitasenha);
            if ($now > $ultimaRecuperacaoCarbon->addMinutes(30)) {
                $eleitor->solicitasenha = $now;
                $eleitor->save();
                $eleitor->senha = convert_uudecode($eleitor->senha);
                Mail::to($eleitor->email)->send(new SenhasAcesso($eleitor->toArray()));
            } else {
                return redirect()->route('home')->with('alertas', 'A senha foi enviada para seu e-mail a menos de 30 minutos. Aguarde para poder solicitar novamente...');
            }

        }

        return redirect()->route('home')->with('alertas', 'Caso seu CPF esteja na lista de eleitores, a senha foi reenviada para seu e-mail institucional');


    }

}
