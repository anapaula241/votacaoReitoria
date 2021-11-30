<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Chapa extends Model
{
    use Notifiable, Uuid;

    protected $table = 'tb_chapa';

    protected $fillable = [

        'nome_chapa',
        'diretor',
        'foto_diretor',
        'vicediretor',
        'foto_vicediretor',
        'unidade_id'
    ];

    public $incrementing = false;


    public function unidade() {
        return $this->belongsTo('App\Models\Unidade', 'unidade_id', 'id');
    }



}
