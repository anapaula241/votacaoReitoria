<?php

use App\Models\Chapa;
use App\Models\Unidade;
use Illuminate\Database\Seeder;

class ChapaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chapas = [
            [
                'nome_chapa' => 'Chapa Única',
                'diretor' => ' Valdilene Gonçalves Machado Silva',
                'foto_diretor' => '/img/chapas/1/chapa1/diretor.jpg',
                'vicediretor' => 'Walesson Gomes da Silva ',
                'foto_vicediretor' => '/img/chapas/1/chapa1/vicediretor.jpg',
                'unidade_id' => Unidade::where('num', 1)->first()->id
            ],

            [
                'nome_chapa' => 'Chapa Única',
                'diretor' => 'Stella Hernandez Maganhi',
                'foto_diretor' => '/img/chapas/2/chapa2/diretor.png',
                'vicediretor' => 'Patrícia Alves Cardoso',
                'foto_vicediretor' => '/img/chapas/2/chapa2/vicediretor.jpg',
                'unidade_id' => Unidade::where('num', 2)->first()->id
            ],

            // [
            //     'nome_chapa' => 'Chapa Única',
            //     'diretor' => 'Mario Ruela Filho',
            //     'foto_diretor' => '/img/chapas/3/chapa1/diretor.png',
            //     'vicediretor' => ' Ernesto de Oliveira Canedo Junior ',
            //     'foto_vicediretor' => '/img/chapas/3/chapa1/vicediretor.png',
            //     'unidade_id' => Unidade::where('num', 3)->first()->id
            // ],

        ];

        foreach ($chapas as $chapa) {
            $insertChapas = Chapa::create($chapa);
        }
    }
}
