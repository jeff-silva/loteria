<template>
    <div class="ui-editor-html">
        <div class="p-2 border border-bottom-0">
            <div class="btn-group me-2" role="group" aria-label="Paragrafo">
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('bold');"><i class="fas fa-bold"></i></button>
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('italic');"><i class="fas fa-italic"></i></button>
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('strikeThrough');"><i class="fas fa-strikethrough"></i></button>
            </div>

            <div class="btn-group me-2" role="group" aria-label="Alinhamento">
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('justifyLeft');"><i class="fas fa-align-left"></i></button>
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('justifyCenter');"><i class="fas fa-align-center"></i></button>
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('justifyFull');"><i class="fas fa-align-justify"></i></button>
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('justifyRight');"><i class="fas fa-align-right"></i></button>
            </div>
            
            <div class="btn-group me-2" role="group" aria-label="Especial">
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('removeFormat');"><i class="fas fa-remove-format"></i></button>
                <button type="button" class="btn btn-sm" @click="codeMode=!codeMode; setValue(props.value, false);" :class="{'btn-primary text-white':codeMode}"><i class="fas fa-code"></i></button>
            </div>
        </div>

        <ui-editor-code v-if="codeMode" v-model="props.value" language="html" style="min-height:100px;" @change="emitValue()"></ui-editor-code>
        <div v-else class="form-control rounded-0" style="min-height:100px;" contenteditable="true" ref="editor" @keyup="props.value=$event.target.innerHTML; emitValue();"></div>

    </div>
</template>

<script>
export default {
    props: {
        value: [Boolean, String],
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
            codeMode: false,
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
        emitValue() {
            this.$emit('value', this.props.value);
            this.$emit('input', this.props.value);
            this.$emit('change', this.props.value);
        },

        setValue(value, ignoreFocused=true) {
            setTimeout(() => {
                if (ignoreFocused && this.$el.contains(document.activeElement)) return;
                this.$refs.editor.innerHTML = value;
            }, 100);
        },

        getValue() {
            return this.$refs.editor.innerHTML;
        },

        command(a, b, c) {
            if (codeMode) return;
            document.execCommand(a, b, c);
            this.props.value = this.$refs.editor.innerHTML;
            this.emitValue();
        },
    },

    mounted() {
        this.setValue(this.props.value);
    },
}
</script>