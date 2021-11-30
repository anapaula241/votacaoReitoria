<template>
    <div>
        <a data-toggle="modal" :data-target="idModal()" class="btn btn-dark float-right text-white font-weight-bold">Votar Nulo</a>


        <!-- Modal -->
        <div class="modal fade" data-backdrop="static" :id="id + '-voto'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{this.unidade}} - Confirmação de voto</h5>
                    </div>
                    <form :action="url" method="POST" :id="id + '-form-nulo'">
                        <input type="hidden" name="_token" :value="csrf">
                        <div class="modal-body">
                            <p>Você selecionou <b>Votar Nulo.</b></p>
                            <p>Deseja confirmar seu voto?</p>
                        </div>
                        <div v-if="confirma == true">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p>Processando...</p>
                        </div>
                        <div class="modal-footer" v-if="confirma == false">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Corrigir</button>
                            <button class="btn btn-success" @click="submete()">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BotaoVotoNulo",
        data() {
            return {
                confirma: false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        props: ['url', 'id', 'identificador', 'unidade'],
        methods: {
            idModal(){
                return '#' + this.id + '-voto';
            },
            submete(){
                this.confirma = true;
                setTimeout( ()  => {
                    let formid = this.id + '-form-nulo';
                    document.getElementById(formid).submit();
                }, 1000);


            }
        },
        mounted() {
        }
    }
</script>

<style scoped>

</style>
