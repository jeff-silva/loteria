<template>
    <div>
        <table class="table">
            <tbody>
                <tr v-for="l in loteriasTypes">
                    <td>
                        <nuxt-link :to="`/admin/loterias/${l.id}`">{{ l.name }}</nuxt-link>
                    </td>
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
            loteriasTypes: [],
        };
    },

    methods: {
        loteriasTypesLoad() {
            return this.$axios.get('/api/loteria-sorteios/types').then(resp => {
                this.loteriasTypes = resp.data;
            });
        },
    },

    mounted() {
        this.loteriasTypesLoad();
    },
}
</script>