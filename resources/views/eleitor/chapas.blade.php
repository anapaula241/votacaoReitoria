@extends('eleitor.base')

@section('style')
<style>
    .title {
        font-weight: bold;
        font-size: 1.1rem;
        color: #3c6178;
        text-align: center;
    }

    .foto {
        max-width: 170px;
        width: 100%;
        height: auto;
    }

    .nomediretor {
        margin-bottom: 0px;
        font-weight: bold;
        font-size: 0.9rem;
    }

    .nomevicediretor {
        margin-bottom: 0px;
        font-weight: bold;
        font-size: 0.9rem;
    }

    div.nomechapa {
        font-size: 1.1rem;
        font-weight: bold;
        color: #3c6178;

    }

    .cargo {
        font-size: 1.1rem;
    }

    .modal-backdrop
    {
        opacity: 0.8 !important;
    }

</style>

@endsection


@section('body')
    <div class="container mb-4">
        <div class="card">
            <div class="card-header text-center">
                <span class="title">{{$unidade->nome}}</span>
            </div>
            <div class="card-body">
                @foreach ($chapas->sortBy('nome_chapa')->chunk(2) as $chunk)
                    <div class="card-deck">
                        @foreach($chunk as $chapa)
                            <div class="card border-dark mb-4">
                                <div class="card-body" style="margin: 0px; padding: 5px">
                                    <div class="text-center nomechapa">
                                        {{$chapa->nome_chapa}}
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="{{$chapa->foto_diretor}}" class="foto">

                                        </div>
                                        <div class="col-9">
                                            <p class="nomediretor">{{$chapa->diretor}}</p>
                                            <span class="cargo">Diretor(a)</span>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="{{$chapa->foto_vicediretor}}" class="foto">
                                        </div>
                                        <div class="col-9">
                                            <p class="nomevicediretor">{{$chapa->vicediretor}}</p>
                                            <p class="cargo mb-0">Vice-Diretor(a)</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <vote-component id="{{$chapa->id}}" url="{{route('eleitor-voto', $chapa->id)}}" unidade="{{$unidade->nome}}" identificador="{{$chapa->nome_chapa}}"></vote-component>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <branco-component id="idbranco" url="{{route('eleitor-branco')}}" unidade="{{$unidade->nome}}" identificador="Votar Branco"></branco-component>
                <nulo-component id="idnulo" url="{{route('eleitor-nulo')}}" unidade="{{$unidade->nome}}" identificador="Votar Nulo"></nulo-component>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalaviso">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">AVISO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (count($chapas) == 1)
                        A eleição na <b>{{$unidade->nome}}</b> é de <b>Chapa Única</b>.
                    @else
                        A eleição na unidade {{$unidade->nome}} contém duas chapas.
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-block" data-dismiss="modal">Entendido!</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
<script>
    $('#modalaviso').modal('show');
</script>
@endsection
