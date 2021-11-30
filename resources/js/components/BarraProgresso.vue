<template>
    <div class="mt-2">
        <div class="progress">
            <div class="progress-bar" role="progressbar" :style="retornaProgresso()" :aria-valuenow="contador" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BarraProgresso",
        data() {
            return {
                contador: 0,
            }
        },
        mounted() {
            this.incrementa();

        },
        methods: {
            retornaProgresso: function () {
                return 'width:' + this.contador + '%';
            },

            incrementa() {
                if (this.contador < 101) {

                    setTimeout(() => {
                        this.contador += 2.4;
                        this.incrementa();
                    }, 143)

                }
            },
        },
        computed: {

        }
    }
</script>
