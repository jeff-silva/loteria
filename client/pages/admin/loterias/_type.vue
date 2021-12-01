<template>
    <div v-if="loteriasType">
        <table class="table">
            <colgroup>
                <col width="50px">
                <col width="*">
                <col width="200px">
            </colgroup>

            <thead>
                <tr>
                    <th>Sorteio</th>
                    <th>Números</th>
                    <th>Sorteado em</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="t in loteriasType.numbers">
                    <td>{{ t.number }}</td>
                    <td><pre>{{ t.numbersData.join(', ') }}</pre></td>
                    <td>{{ t.date|dateFormat }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    middleware: 'auth',
    layout: 'admin',

    data() {
        return {
            loteriasType: false,
        };
    },

    methods: {
        loteriasTypeLoad() {
            return this.$axios.get(`/api/loteria-sorteios/type/${this.$route.params.type}`).then(resp => {
                this.loteriasType = resp.data;
            });
        },
    },

    mounted() {
        this.loteriasTypeLoad();
    },
}
</script>