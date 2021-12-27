<template>
    <div>
        <div v-if="!loteria">
            Carregando
        </div>

        <div v-if="loteria">
            <div class="row">
                <div class="col-6" style="max-height:400px; overflow:auto;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sorteio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="s in loteria.numbers">
                                <td class="p-2">
                                    <a href="javascript:;"
                                        @click="$refs.loteriaNumbers.numberSet(s.numbersData)"
                                    >{{ s.number }}</a>
                                </td>
                                <td class="p-0" v-for="n in s.numbersData">
                                    <a href="javascript:;" class="btn w-100 rounded-0"
                                        :class="{'btn-primary':numbers.indexOf(n)>=0}"
                                        @click="$refs.loteriaNumbers.numberToggle(n)"
                                    >{{ n }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="col-6">
                    <loteria-numbers v-model="numbers" :loteria="loteria.type" ref="loteriaNumbers"></loteria-numbers>
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