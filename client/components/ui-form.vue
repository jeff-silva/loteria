<template>
    <form :method="method" :action="action" @submit.prevent="submit">
        <slot
            :method="method"
            :action="action"
            :loading="loading"
            :submit="submit"
            :validator="validate"
        ></slot>
    </form>
</template>

<script>
export default {
    props: {
        value: Object,
        method: {default:'get'},
        action: {default:''},
        validator: Object,
        successMessage: {default:''},
    },

    data() {
        return {
            loading: false,
            validate: this.$validator(this.validator),
        };
    },

    methods: {
        submit() {
            this.loading = true;
            
            let axios;
            if (this.method=='post') {
                axios = this.$axios.post(this.action, this.value);
            }
            else {
                axios = this.$axios.get(this.action, {params:this.value});
            }

            axios.then(resp => {
                this.loading = false;
                this.$emit('success', resp.data);
                if (this.successMessage) {
                    this.$swal.fire('', this.successMessage, 'success');
                }
            }).catch(err => {
                this.loading = false;
                this.validate.setError(err.response.data.fields);
            });
        },
    },
}
</script>