<template>
    <div class="row" v-if="loteria">
        <div class="col-12 col-md-6">
            <loteria-table v-model="numbers" :loteria="loteria.type"></loteria-table>
        </div>

        <div class="col-12 col-md-6">
            <loteria-numbers
                :sorteios="loteria.numbers"
            ></loteria-numbers>
        </div>
    </div>
</template>

<script>
export default {
    middleware: 'auth',
    layout: 'admin',

    data() {
        return {
            loteria: false,
        };
    },

    methods: {
        loteriaLoad() {
            return this.$axios.get(`/api/loteria-sorteios/type/${this.$route.params.type}`).then(resp => {
                this.loteria = resp.data;
            });
        },
    },

    mounted() {
        this.loteriaLoad();
    },
}
</script>