<template>
    <div>
        <ValidationObserver ref="form">
            <div class="card-body text-center">
                <form id="frmLogin" @submit="onSubmit" method="post" action="/autentica">
                    <slot name="csrf"></slot>
                    <div class="form-group row justify-content-center">
                        <div class="">
                            <div class="text-left text-white">
                                <label for="cpf"><strong>CPF</strong></label>
                            </div>
                            <ValidationProvider rules="required|ruleCPF" v-slot="{ errors }" name="CPF" mode="eager">
                                <input type="text" class="form-control" name="cpf" id="cpf" v-model="cpf" v-mask="'###.###.###-##'">
                                <span class="validacao">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="">
                            <div class="text-left text-white">
                                <label for="Senha"><strong>Senha</strong></label>
                            </div>
                            <div class="">
                                <ValidationProvider rules="required|length:8" v-slot="{ errors }" name="Senha" mode="eager">
                                    <input type="password" name="password" class="form-control" id="senha" v-model="password" maxlength="8">
                                    <span class="validacao">{{ errors[0] }}</span>
                                </ValidationProvider>

                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="acessar" class="btn btn-success">Acessar</button>

                    </div>
                </form>
            </div>
        </ValidationObserver>

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

        name: "FormLogin",
        data () {
            return {
                cpf: '',
                password: '',
                erro: null,
                desabilitaEnviar: null,
            }


        },
        props: [


        ],
        computed:{

        },
        methods: {
            onSubmit: function (e){
                this.$refs.form.validate().then(success => {
                    if (!success) {
                        e.preventDefault();
                    }
                });


            },



        }

    }
</script>
<style scoped>
    .validacao {
        font-weight: bold;
        color: yellow;
        font-size: 0.8rem;

    }

    input {
        text-align: center;
        font-weight: bold;
        width: 30vw;
        min-width: 300px;
        max-width: 100vw;

    }

    input:focus {
        border-color: black;
        border-width: 2px;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    div label {
        font-size: 1.3rem;
    }
</style>
