<template>
    <div>
        <transition name="custom-unique-name" enter-active-class="animate__animated animate__fadeIn" leave-active-class="animate__animated animate__fadeOut">
            <div class="modal show" tabindex="-1" style="display:block; background:#00000044; animation-duration:200ms;" v-if="props.value" @click.self="props.value=false; emitValue();">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <slot name="header"></slot>
                            <button type="button" class="btn-close" @click="props.value=false; emitValue();"></button>
                        </div>
                        <div class="modal-body">
                            <slot name="body"></slot>
                        </div>
                        <div class="modal-footer">
                            <slot name="footer"></slot>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    props: {
        value: [Boolean, String, Array, Object],
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = JSON.parse(JSON.stringify(value));
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        emitValue() {
            this.$emit('value', this.props.value);
            this.$emit('input', this.props.value);
            this.$emit('change', this.props.value);
        },
    },
}
</script>