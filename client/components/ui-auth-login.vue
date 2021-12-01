<template>
    <div>
        <form @submit.prevent="submit()">
            <slot name="fields" :loading="loading" :error="error">
                <ui-field :error="validator.error.email">
                    <input type="text" class="form-control" v-model="post.email" placeholder="E-mail"
                        @change="validator.validate(post, 'email')">
                </ui-field>

                <ui-field :error="validator.error.password">
                    <ui-password v-model="post.password" placeholder="Senha"
                        @change.native="validator.validate(post, 'password')"
                    ></ui-password>
                </ui-field>
            </slot>

            <slot name="action" :loading="loading" :error="error">
                <button type="submit" class="btn btn-primary w-100" :disabled="validator.invalid()">
                    <i class="fas fa-spin fa-spinner me-1" v-if="loading"></i> Login
                </button>
            </slot>

            <nuxt-link :to="redirect" class="btn btn-primary w-100 mt-3" v-if="$store.state.auth.user && redirect">
                Continuar como {{ $store.state.auth.user.name }}
            </nuxt-link>

            <slot name="after" :loading="loading" :error="error"></slot>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        redirect: {default:''},
    },

    data() {
        return {
            loading: false,
            error: {},
            post: {},

            validator: this.$validator({
                email: {
                    presence: true,
                    email: true
                },
                password: {
                    presence: true,
                },
            }),
        };
    },

    methods: {
        submit() {
            this.validator.validate(this.post);
            if (this.validator.invalid()) return;

            this.loading = true;
            this.error = false;
            this.$auth.loginWith('jwt', {data:this.post}).then(resp => {
                this.loading = false;
                this.$emit('success', resp.data);
                this.post = {};

                if (this.redirect) {
                    this.$router.push(this.redirect);
                }
            }).catch(err => {
                this.loading = false;
                this.error = err.response.data.error;
            });
        },
    },
}
</script>