<template>
    <div>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Métodos</th>
                    <th>URI</th>
                    <th>Parâmetros</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="e in endpoints">
                    <td>{{ e.methods.join(', ') }}</td>
                    <td>{{ e.uri }}</td>
                    <td>{{ e.parameters.length==0? 'Nenhum': e.parameters.join(', ') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    head() {
        return {
            title: "Endpoints",
        };
    },

    data() {
        return {
            endpoints: [],
        };
    },

    methods: {
        getEndpoints() {
            this.$axios.get('/api/endpoints').then(resp => {
                this.endpoints = resp.data;
            });
        },
    },

    mounted() {
        this.getEndpoints();
    },
}
</script>