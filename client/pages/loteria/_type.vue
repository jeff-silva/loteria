<template>
    <div>
        <div v-if="!loteria">
            Carregando
        </div>

        <div v-if="loteria">
            <div class="row">
                <div class="col-12 col-md-5">
                    <h3>Simulador de aposta</h3>
                    <loteria-table v-model="numbers" :loteria="loteria.type" ref="loteriaTable"></loteria-table>
                    <div class="d-flex mt-2">
                        <div><a href="javascript:;" class="btn btn-outline-primary" @click="$refs.loteriaTable.numberSet([])">Limpar tudo</a></div>
                    </div>
                </div>

                <div class="col-12 col-md-7">
                    <h3>Todos os sorteios</h3>
                    <loteria-numbers v-model="numbers"
                        :items="loteria.numbers"
                        ref="loteriaNumbers"
                        style="max-height:90vh; overflow:auto;"
                    ></loteria-numbers>
                </div>
            </div>
            <!-- <pre>{{ loteria }}</pre> -->
        </div>
    </div>
</template>

<script>
export default {
    watch: {
        '$route.params.type': {deep:true, handler(value) {
            this.loteriaSorteioTypeLoad();
        }},
    },

    data() {
        return {
            numbers: [],
            loteria: false,
        };
    },

    methods: {
        loteriaSorteioTypeLoad() {
            console.log('loteriaSorteioTypeLoad');
            this.$axios.get(`/api/loteria-sorteios/type/${this.$route.params.type}`).then(resp => {
                this.loteria = resp.data;
            });
        },
    },

    mounted() {
        this.loteriaSorteioTypeLoad();
    },
}
</script>