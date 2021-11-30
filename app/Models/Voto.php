<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Voto extends Model
{
    use Notifiable, Uuid;

    protected $table = 'tb_voto';

    protected $fillable = [
        'data_hora',
        'voto',
        'chapa',
        'tipo',
        'eleitor_id',
        'unidade_id',
        'nome_unidade',
        'ip'
    ];

    public $incrementing = false;

    public function unidade() {
        return $this->belongsTo('App\Models\Unidade', 'unidade_id', 'id');
    }

    public function eleitor() {
        return $this->belongsTo('App\Models\Eleitor', 'eleitor_id', 'id');
    }
}
