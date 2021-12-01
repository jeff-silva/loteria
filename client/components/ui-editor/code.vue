<template>
    <div ref="monaco" style="width:100%; min-height:150px;"></div>
</template>

<script>
import * as monaco from 'monaco-editor/esm/vs/editor/editor.api';

export default {
    props: {
        value: [Boolean, String],
        language: {default: "html"},
        theme: {default: "vs-dark"},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
            monaco: false,
        };
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.$el.contains(document.activeElement)) return;
            this.props = JSON.parse(JSON.stringify(value));
            this.setValue(this.props.value);
        }},
    },
    
    methods: {
        monacoInit() {
            setTimeout(() => {
                let target = this.$refs.monaco;
                if (! target) return;

                this.monaco = monaco.editor.create(target, {
                    value: this.props.value,
                    language: this.props.language,
                    theme: this.props.theme,
                    automaticLayout: true,
                });

                this.monaco.getModel().onDidChangeContent(evt => {
                    this.props.value = this.monaco.getModel().getValue();
                    this.emitValue();
                });

                this.monaco.getModel().setValue(this.props.value);
            }, 100);
        },

        emitValue() {
            this.$emit('value', this.props.value);
            this.$emit('input', this.props.value);
            this.$emit('change', this.props.value);
        },

        setValue(value) {
            if (this.$el.contains(document.activeElement)) return;
            this.monaco.getModel().setValue(value);
        },
        
        getValue() {
            return this.props.value = this.monaco.getModel().getValue();
        },
    },

    mounted() {
        this.monacoInit();
    },
}
</script>