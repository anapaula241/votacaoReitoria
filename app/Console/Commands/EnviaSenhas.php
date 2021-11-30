<?php

namespace App\Console\Commands;

use App\Mail\SenhasAcesso;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnviaSenhas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'envia:senhas {arquivo} {linha=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia as senhas de acesso para os e-mails dos eleitores';

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


    public function leituraCSV () {
        $arquivo = fopen('eleitores/' . $this->argument('arquivo'), "r");

        $count = 0;

        while ($linha = fgetcsv($arquivo, 0, ";")) {
            $count++;
            if ($count < $this->argument('linha')){
                continue;
            }
            $cpfSenha = ['nome' => $linha[0], 'cpf' => $linha[1], 'senha' => $linha[4]];
            $dados = collect($cpfSenha);
            Mail::to($linha[5])->send(new SenhasAcesso($dados));
            echo $count . " - $linha[5]" . "\n";
            sleep(2);

        }

    }
}
