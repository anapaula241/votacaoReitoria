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
        <h2>Comprovante de Votação</h2>
        <h2>Obrigado pela participação.</h2>
        <hr/>
        <p>{{$voto->data_hora->format('d/m/Y H:i:s')}} - {{$voto->id}}</p>

    </div>

</body>
</html>
