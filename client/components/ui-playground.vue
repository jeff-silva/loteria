<template>
    <div class="row g-0">
        <div class="col-6">
            <ui-editor-code :value="value" style="height:100%; min-height:50px!important;"></ui-editor-code>
        </div>
        <div class="col-6 ps-2">
            <v-runtime-template :template="`<div>${value}</div>`"></v-runtime-template>
        </div>
    </div>
</template>

<script>
import VRuntimeTemplate from "v-runtime-template";

export default {
    components: { VRuntimeTemplate },

    props: {
        value: {default:''},
    },

    mounted() {
        // console.log(this.$refs.source.innerHTML);
    },
}
</script>