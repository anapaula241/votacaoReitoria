<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Unidade extends Model
{
    use Notifiable, Uuid;

    protected $table = 'tb_unidade';

    protected $fillable = [
        'nome',
        'num',
    ];

    public $incrementing = false;


    public function chapas()
    {
        return $this->hasMany('App\Models\Chapa', 'unidade_id', 'id');

    }
}
