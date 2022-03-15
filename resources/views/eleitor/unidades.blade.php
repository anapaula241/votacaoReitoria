@extends('eleitor.base')

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
                <span class="title">Selecione a unidade para votar !</span>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-auto">

                        <div class="card text-center" style="width: 20rem;">
                            <a href="{{route('eleitor-chapas', $dadosUnidade->id)}}">
                                <img src="/img/chapas/{{$dadosUnidade->num}}/unidade.jpg" class="card-img-top" alt="">
                            </a>
                            <div class="card-body">
                                <p class="card-text">{{$dadosUnidade->nome}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
