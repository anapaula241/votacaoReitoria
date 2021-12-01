<?php

namespace App\Http\Middleware;

use App\Models\Voto;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class VerificaVoto
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle($request, Closure $next)
    {
        if(Voto::where('eleitor_id', Auth::id())->count() !== 0){
            return redirect()->route('home')->with('alertas', 'Você já votou!');
        }

        $agora = Carbon::now();

        $dataInicio = Carbon::create(2021, 11, 17, 9, 0, 1);
        $dataTermino = Carbon::create(2021, 12, 01, 20, 58, 59);

        if (($agora < $dataInicio) || ($agora > $dataTermino)){
           return redirect()->route('home')->with('alertas', 'Você está fora do horário de votação.');
        }


        return $next($request);
    }
}
