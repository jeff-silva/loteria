<template>
    <div class="ui-editor">
        <ui-editor-code v-model="props.value" v-if="props.type=='code'" @change="emitValue()"></ui-editor-code>
        <ui-editor-html v-model="props.value" v-if="props.type=='html'" @change="emitValue()"></ui-editor-html>
    </div>
</template>

<script>
export default {
    props: {
        value: [Boolean, String],
        type: {default: "html"}, // html|code
        language: {default: "html"},
        theme: {default: "vs-dark"},
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.$el.contains(document.activeElement)) return;
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
            let value = this.props.value;
            
            this.$emit('value', value);
            this.$emit('input', value);
            this.$emit('change', value);
        },
    },
}
</script>