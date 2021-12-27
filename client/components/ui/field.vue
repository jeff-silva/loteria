<template>
    <div>
        <div class="d-flex align-items-center mb-3" v-if="layout=='horizontal'">
            <div :style="{minWidth:labelWidth, maxWidth:labelWidth}">
                <slot name="label">{{ label }}</slot>
            </div>
            <div class="flex-grow-1">
                <slot></slot>
                <div class="ui-field-info">
                    <slot name="info"></slot>
                </div>
                <small class="d-block text-danger" v-if="compError" v-html="compError"></small>
            </div>
        </div>
    
        <div class="mb-3" v-else>
            <div class="form-label">
                <slot name="label">{{ label }}</slot>
            </div>
            <slot></slot>
            <div class="ui-field-info">
                <slot name="info"></slot>
            </div>
            <small class="d-block text-danger" v-if="compError" v-html="compError"></small>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        label: {default:''},
        layout: {default:'vertical'},
        labelWidth: {default:'200px'},
        error: [String, Array, Object],
    },

    computed: {
        compError() {
            let error = [];

            if (typeof this.error=='string') {
                error = [this.error];
            }
            else if (Array.isArray(this.error)) {
                error = this.error;
            }
            else if (typeof this.error=='object') {
                error = Object.values(this.error);
            }

            return error.join('<br>');
        },
    },
}
</script>

<style>
.ui-field-info * {font-size:12px; color:var(--bs-gray) !important;}
</style>