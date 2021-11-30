
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @csrf
    <meta name="description"
          content="Eleição de Diretores - UEMG 2021">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Eleição para Diretor(a) e Vice-Diretor(a) - UEMG 2021</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div id="app" style="margin-top: 10px;">
        @yield('body')
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    @yield('javascript')
</body>
</html>

