<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Eleitor extends Authenticatable
{
    use Notifiable, Uuid;

    protected $table = 'tb_eleitor';

    // 1=> aluno   2=> administrativo    3=>professor

    protected $fillable = [
        'nome',
        'cpf',
        'password',
        'senha',
        'email',
        'tipo',
        'unidade_id'
    ];



    protected $casts = [

    ];

    public $incrementing = false;

    public function unidade(){
        return $this->belongsTo('App\Models\Unidade', 'unidade_id', 'id');
    }

}
