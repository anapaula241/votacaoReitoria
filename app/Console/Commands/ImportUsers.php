<?php

namespace App\Console\Commands;

use App\Models\Eleitor;
use App\Models\Unidade;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:users {arquivo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa os eleitores presentes em eleitores/eleitores.csv';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->leituraCSV();
    }

    /* TIPO
     *
     * 1 => Unidade Frutal
     * 2 => Unidade Passos
     *
    */

    // nome;cpf;tipo;unidade;senha;email

    public function leituraCSV () {

        $arquivo = fopen('eleitores/' . $this->argument('arquivo'), "r");
        while ($linha = fgetcsv($arquivo, 0, ";")) {
            if (self::validaCPF($linha[1])){
                Eleitor::create([
                    'nome' => $linha[0],
                    'cpf' => self::insereMascaraCPF($linha[1]),
                    'tipo' => $linha[2],
                    'unidade_id' => Unidade::where('num', $linha[3])->first()->id,
                    'password' => Hash::make($linha[4]),
                    'senha' => convert_uuencode($linha[4]),
                    'email' => $linha[5]
                ]);
            } else {
                echo "CPF inválido: $linha[1] - Nome: $linha[0] \n";
            }
        }
    }

    protected static function insereMascaraCPF ($cpf){
        return substr($cpf,0,3) . '.' . substr($cpf,3,3). '.' . substr($cpf, 6,3) . '-' . substr($cpf,-2);
    }

    protected static function validaCPF($cpf): bool {

        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;

    }
}
