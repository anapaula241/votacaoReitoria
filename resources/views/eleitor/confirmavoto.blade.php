@extends('eleitor.base2')

@section('style')
<style>

    .title {
        font-weight: bold;
        font-size: 1.5rem;
        color: #3c6178;
        text-align: center;
    }
</style>

@endsection


@section('body')
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <span class="title">Voto confirmado!</span>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                    <h2 class="text-center">Obrigado pela participação!</h2>
                    <hr/>
                    <p class="text-center">Estamos enviando um comprovante de votação para seu e-mail...</p>
                    </div>
                </div>
                <progresso-component></progresso-component>
            </div>

        </div>
    </div>

@endsection

@section('javascript')
    <script>
        let timer = setTimeout(function() {
            window.location='{{route('home')}}'
        }, 7000);
    </script>
@endsection
