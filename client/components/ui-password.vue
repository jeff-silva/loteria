<template>
    <div class="input-group form-control p-0">
        <input :type="props.show? 'text': 'password'" :placeholder="props.placeholder" class="form-control border-0" v-model="props.value" @keyup="emitvalue()">

        <div class="input-group-btn">
            <button type="button" class="btn" @click="props.show=!props.show">
                <i class="fas fa-eye" v-if="props.show"></i>
                <i class="fas fa-eye-slash" v-else></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {default:''},
        show: {default:false},
        placeholder: {default:''},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        emitvalue() {
            this.$emit('input', this.props.value);
            this.$emit('value', this.props.value);
            this.$emit('change', this.props.value);
        },
    },
}
</script>