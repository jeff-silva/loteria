<template>
    <div>
        <div v-if="error.statusCode==404">
            <ui-content v-model="page.content" v-if="page"></ui-content>
            <div v-else>
                <h1>Página não encontrada</h1>
            </div>
        </div>

        <div v-else>
            <pre>{{ $props }}</pre>
        </div>
    </div>
</template>

<script>
export default {
    props: ['error'],

    data() {
        return {
            page: false,
        };
    },

    methods: {
        loadPage() {
            if (this.error.statusCode != 404) return;
            let params = {slug:this.$route.fullPath.replace('/', '')};
            this.$axios.get('/api/pages/page', {params}).then(resp => {
                this.page = resp.data;
            });
        },
    },

    mounted() {
        this.loadPage();
    },
}
</script>