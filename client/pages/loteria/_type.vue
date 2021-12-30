<template>
    <div>
        <div v-if="!loteria">
            Carregando
        </div>

        <div v-if="loteria">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">Simular</div>
                        <div class="card-body" style="overflow:auto;">
                            <loteria-table v-model="numbers" :loteria="loteria.type" ref="loteriaTable"></loteria-table>
                        </div>
                        <div class="card-footer text-end">
                            <a href="javascript:;" class="btn btn-outline-primary" @click="$refs.loteriaTable.numberSet([])">Limpar tudo</a>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">Sorteios com selecionados</div>
                        <div class="card-body" style="overflow:auto;">
                            <loteria-analysis v-model="numbers"
                                :loteria="loteria.type"
                                :sorteios="loteria.numbers"
                            ></loteria-analysis>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">Todos os sorteios</div>
                        <div class="card-body" style="overflow:auto;">
                            <loteria-numbers v-model="numbers"
                                :sorteios="loteria.numbers"
                                ref="loteriaNumbers"
                                style="max-height:90vh; overflow:auto;"
                            ></loteria-numbers>
                        </div>
                    </div>
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