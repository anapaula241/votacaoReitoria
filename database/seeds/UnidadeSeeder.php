<?php

use App\Models\Unidade;
use Illuminate\Database\Seeder;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unidades =
            [
                [
                    'id' => 'e03d165e-bc9f-48a9-b08f-417e22dd5a1a',
                    'nome' => 'Unidade Cláudio',
                    'num' => 1
                ],
                [
                    'id' => '6a0aa383-52ae-4f77-9faa-22348f4c09be',
                    'nome' => 'Unidade Ituiutaba',
                    'num' => 2
                ],
                // [
                //     'id' => '7a0aa783-52ae-4f77-9faa-22348f4c09be',
                //     'nome' => ' Unidade Poços de Caldas',
                //     'num' => 3
                // ],

            ];


        foreach ($unidades as $unidade) {
            $insertUnidades = Unidade::create($unidade);
        }


    }
}
