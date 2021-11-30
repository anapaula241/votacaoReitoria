<template>
    <div>
        <a data-toggle="modal" data-target="#modal-solicita-senha" class="btn btn-dark btn-lg btn-block float-right text-white font-weight-bold">Solicitar reenvio de senha</a>

        <!-- Modal -->
        <div class="modal fade" id="modal-solicita-senha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Identifique-se</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <ValidationObserver ref="form2">
                    <form id="formsolicitasenha" @submit="onSubmit" method="post" action="/solicitasenha">
                        <slot name="csrf"></slot>
                        <div class="modal-body">
                            <label for="cpfrecupera"><strong>Informe seu CPF para que possamos reenviar a senha para seu e-mail</strong></label>
                            <ValidationProvider rules="required|ruleCPF" v-slot="{ errors }" name="CPF" mode="eager">
                                <input type="text" class="form-control" name="cpf" id="cpfrecupera" v-model="cpf" v-mask="'###.###.###-##'">
                                <span class="validacao">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Confirmar</button>
                        </div>
                    </form>
                    </ValidationObserver>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import { ValidationProvider, ValidationObserver } from 'vee-validate';
    import { extend } from 'vee-validate';
    import * as rules from 'vee-validate/dist/rules';
    import {TheMask} from 'vue-the-mask';
    import { localize } from 'vee-validate';
    import br from 'vee-validate/dist/locale/pt_BR.json';

    localize('br', br);

    Object.keys(rules).forEach(rule => {
        extend(rule, rules[rule]);
    });

    extend('ruleCPF', value => {

        var valido;
        var cpf = value;
        cpf = cpf.replace(/[^\d]+/g,'');
        if(cpf == '') return false;
        // Elimina CPFs invalidos conhecidos
        if (cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")

            valido = false;
        // Valida 1o digito
        var add = 0;
        for (var i=0; i < 9; i ++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        var rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            valido = false;

        // Valida 2o digito
        add = 0;
        for (var i = 0; i < 10; i ++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10)))
            valido = false;


        if (valido == false) {
            return 'CPF informado não é válido';
        }
        return true;
    });

    export default {
        components: {
            ValidationProvider,
            ValidationObserver,
            TheMask,
        },
        name: "SolicitaSenha",
        data() {
            return {
                cpf: '',
            }
        },
        props: [],
        methods: {
            onSubmit: function (e){
                this.$refs.form2.validate().then(success => {
                    if (!success) {
                        e.preventDefault();
                    }
                });

            },
        },
        mounted() {
        }
    }
</script>

<style scoped>

    .validacao {
        font-weight: bold;
        color: #ff0000;
        font-size: 0.8rem;

    }
</style>
