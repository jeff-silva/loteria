<template>
    <div>
        <ui-form v-model="post"
            method="post"
            action="/api/users/save"
            #default="{validator, loading, submit}"
            @success="onSuccess($event)"
            success-message="Usuário salvo"
        >
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <div class="bg-white shadow rounded">
                        <div class="text-center py-4">
                            <img :src="post.photo" alt=""
                                v-if="post.photo"
                                style="width:100px; height:100px; border-radius:50%; object-fit:cover;">

                            <div v-if="!post.photo" class="d-inline-block" style="width:100px; height:100px; border-radius:50%; background:#eee"></div>
                            
                            <div class="fw-bold mt-4 text-uppercase">{{ post.name }}</div>
                            <ui-upload v-model="post.photo" :preview="false" class="mx-3 mt-4"></ui-upload>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-8">
                    <el-tabs type="border-card">
                        <el-tab-pane label="Acesso">
                            <ui-field label="Nome" :error="validator.error.name">
                                <input type="text" class="form-control" v-model="post.name">
                            </ui-field>
        
                            <ui-field label="E-mail" :error="validator.error.email">
                                <input type="text" class="form-control" v-model="post.email">
                            </ui-field>
                        </el-tab-pane>

                        <el-tab-pane label="Senha">
                            <ui-field label="Senha atual" :error="validator.error.password">
                                <ui-password v-model="post.password"></ui-password>
                            </ui-field>
        
                            <ui-field label="Nova senha" :error="validator.error.email">
                                <ui-password></ui-password>
                            </ui-field>

                            <ui-field label="Repita nova senha" :error="validator.error.email">
                                <ui-password></ui-password>
                            </ui-field>
                        </el-tab-pane>
                        
                        <el-tab-pane label="Endereço">
                            <ui-address v-model="post.address_id"></ui-address>
                        </el-tab-pane>
                    </el-tabs>

                    <div class="card">
                        <div class="card-footer border-0 text-end">
                            <nuxt-link to="/admin/users" class="btn">Voltar</nuxt-link>
                
                            <button type="submit" class="btn btn-primary" v-loading="loading">
                                Salvar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </ui-form>
    </div>
</template>

<script>
export default {
    middleware: 'auth',
    layout: 'admin',

    data() {
        return {
            loading: false,
            userId: (this.$route.params.id || false),
            post: {},
        };
    },

    methods: {
        userLoad() {
            if (! parseInt(this.userId)) return;
            this.loading = true;
            this.$axios.get(`/api/users/find/${this.userId}`).then(resp => {
                this.loading = false;
                this.post = resp.data;
            });
        },

        onSuccess(user) {
            this.$router.push(`/admin/users/${user.id}`);
            this.post = user;
            if (user.id==this.$store.state.auth.user.id) {
                this.$auth.fetchUser();
            }
        },
    },

    mounted() {
        if (this.userId=='me') {
            this.userId = this.$store.state.auth.user.id;
        }
        this.userLoad();
    },
}
</script>