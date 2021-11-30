<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eleição para Diretor(a) e Vice-Diretor(a) - UEMG 2021</title>
</head>
<style>
    #corpo {
        border: 1px solid black;
        text-align: center;
        width: 90%;
        height: auto;
    }

    #corpo p {
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>
<body>
    <div id="corpo">
        <h1>Eleição para Diretor(a) e Vice-Diretor(a) - UEMG 2021</h1>
        <hr/>
        <h2>{{$dados['nome']}}, segue abaixo os dados de acesso ao painel de votação:</h2>
        <hr/>
        <p>CPF: {{$dados['cpf']}}</p>
        <p>Senha: {{$dados['senha']}}</p>
        <span>Link: </span> <a href="http://eleicao.uemg.br/">http://eleicao.uemg.br/</a>
        <hr/>
        <p>*Essa mensagem é pessoal e sigilosa, tendo sido enviada de forma automática. Favor não responder a esse e-mail.</p>
    </div>

</body>
</html>
