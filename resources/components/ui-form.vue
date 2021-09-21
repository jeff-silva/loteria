<template>
    <form @submit.prevent="submit()">
        <slot></slot>
        <pre>value: {{ value }}</pre>
    </form>
</template>

<script>
export default {
    props: {
        value: Object,
        action: String,
        method: String,
        swal: {default:true},
        success: String,
    },

    methods: {
        submit() {
            return new Promise((resolve, reject) => {
                let axios;

                let onSuccess = (resp) => {
                    if (this.success) {
                        this.$swal.fire('', this.success, 'success');
                    }
                    this.$emit('success', resp);
                };

                let onError = () => {
                    alert('Error');
                };

                if (this.method=='post') {
                    return this.$axios.post(this.action, this.value).then(onSuccess).catch(onError);
                }
                
                return this.$axios.get(this.action, {params:this.value}).then(onSuccess).catch(onError);
            });
        },
    },

    mounted() {
        // this.$swal.fire('', 'Sucesso', 'success');
    },
}
</script>