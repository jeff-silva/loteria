<template>
    <div>
        <form @submit.prevent="passwordResetStart()" v-if="step=='email'">
            <ui-field :error="error">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="post.email" placeholder="Informe seu e-mail">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary">
                            Enviar
                        </button>
                    </div>
                </div>
            </ui-field>
        </form>

        <form @submit.prevent="passwordResetchange()" v-if="step!='email'">
            <ui-field>
                <div class="form-control">{{ post.email }}</div>
            </ui-field>
            
            <ui-field v-if="step=='token'">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="post.token" placeholder="Informe o código recebido">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary" @click="step='password'">
                            Confirmar
                        </button>
                    </div>
                </div>
            </ui-field>

            <template v-if="step=='password'">
                <div class="alert alert-success" v-if="success">
                    Senha alterada
                </div>

                <template v-else>
                    <ui-field>
                        <input type="password" class="form-control" v-model="post.password" placeholder="Informe a senha nova">
                    </ui-field>
        
                    <ui-field>
                        <input type="password" class="form-control" v-model="post.password_confirm" placeholder="Repita a senha nova">
                    </ui-field>
                </template>
            </template>

            <button type="submit" class="btn btn-primary w-100" v-if="!success">
                Alterar
            </button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        let email = (new URLSearchParams(window.location.search)).get('email');

        return {
            step: (email? 'token': 'email'),
            error: {},
            success: false,
            post: { email },
        };
    },

    methods: {
        passwordResetStart() {
            this.error = false;
            this.$axios.post('/api/password-reset-start/', this.post).then(resp => {
                this.step = 'token';
            }).catch(err => this.error = err.response.data.message);
        },

        passwordResetchange() {
            this.error = false;
            this.$axios.post('/api/password-reset-change/', this.post).then(resp => {
                this.post.token = '';
                this.post.password = '';
                this.post.password_confirm = '';
                this.success = true;
            }).catch(err => this.error = err.response.data.message);
        },
    },
}
</script>