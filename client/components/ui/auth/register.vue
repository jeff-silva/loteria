<template>
    <div>
        <form @submit.prevent="submit()">
            <slot name="after" :error="validator.error"></slot>

            <slot name="fields" :error="validator.error">
                <ui-field :error="validator.error.name">
                    <input type="text" class="form-control" v-model="post.name" placeholder="Name"
                        @change="validator.validate(post, 'name')">
                </ui-field>

                <ui-field :error="validator.error.email">
                    <input type="text" class="form-control" v-model="post.email" placeholder="E-mail"
                        @change="validator.validate(post, 'email')">
                </ui-field>

                <ui-field :error="validator.error.password">
                    <input type="password" class="form-control" v-model="post.password" placeholder="Senha"
                        @change="validator.validate(post, 'password')">
                </ui-field>

                <ui-field :error="validator.error.password_confirmation">
                    <input type="password" class="form-control" v-model="post.password_confirmation" placeholder="Repita senha"
                        @change="validator.validate(post, 'password_confirmation')">
                </ui-field>
            </slot>

            <slot name="action" :error="validator.error">
                <button type="submit" class="btn btn-primary w-100" :disabled="validator.invalid()">
                    <i class="fas fa-spin fa-spinner me-1" v-if="loading"></i>
                    Cadastrar
                </button>
            </slot>

            <slot name="after" :error="validator.error"></slot>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            post: {},

            validator: this.$validator({
                name: {
                    presence: true,
                },
                email: {
                    presence: true,
                    email: {message:"inválido"},
                },
                password: {
                    presence: true,
                },
                password_confirmation: {
                    presence: true,
                    equality: "password",
                },
            }),
        };
    },

    methods: {
        submit() {
            this.validator.validate(this.post);
            if (this.validator.invalid()) return;

            this.loading = true;
            this.$axios.post('/api/register', this.post).then(resp => {
                this.loading = false;
            }).catch(err => {
                this.loading = false;
                this.validator.setError(err.response.data.fields);
            });
        },
    },
}
</script>