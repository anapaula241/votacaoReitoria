
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @csrf
    <meta name="description"
          content="Eleição de Diretores - UEMG 2021">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <title>Eleição para Diretor(a) e Vice-Diretor(a) - UEMG 2021</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-4">
                    {{--<h1 class="mt-2">UEMG 2021</h1>
                    <h2 class="mt-2">Eleição de Diretores</h2>--}}
                    <img src="/img/banner.jpg" class="banner">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <login-component>
                        <template slot="csrf">
                            {{ csrf_field() }}
                        </template>
                    </login-component>
                    @if (session('alertas'))
                        <div class="alert alert-danger alert-dismissable text-center alertas" style="margin-top: 10px;">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('alertas') }}
                        </div>
                    @endif
                </div>

                <div class="col-12">
                    <hr/>
                    <senha-component>
                        <template slot="csrf">
                            {{ csrf_field() }}
                        </template>
                    </senha-component>
                </div>
            </div>



        </div>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>



