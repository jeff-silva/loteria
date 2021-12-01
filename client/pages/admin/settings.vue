<template>
    <div>
        <div class="d-flex">
            <div class="bg-dark" style="min-width:150px!important; max-width:150px!important;">
                <ui-nav :items="pages" mode="vertical" text-color="#fff"></ui-nav>
            </div>

            <div class="flex-grow-1">
                <ui-form method="post" action="/api/settings/save-all" v-model="settings" #default="{loading}" success-message="Configurações alteradas">
                    <div class="card-header">
                        <div v-for="p in pages" v-if="p.to==$route.path">{{ p.label }}</div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <nuxt-child :settings="settings" :settings-get-all="settingsGetAll" :settings-save-all="settingsSaveAll"></nuxt-child>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary" v-loading="loading">
                                Salvar
                            </button>
                        </div>
                    </div>
                </ui-form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    middleware: 'auth',
    layout: 'admin',

    data() {
        return {
            settings: {},
            pages: [],
        };
    },

    methods: {
        settingsGetAll() {
            this.$axios.get('/api/settings/get-all').then(resp => {
                this.settings = resp.data;
            });
        },

        settingsSaveAll() {
            this.$axios.post('/api/settings/save-all').then(resp => {
                this.settings = resp.data;
                this.$store.dispatch('app/init');
            });
        },
    },

    mounted() {
        this.settingsGetAll();

        this.$helpers.routes('/admin/settings/').then(resp => {
            this.pages = resp;
        });
    },
}
</script>