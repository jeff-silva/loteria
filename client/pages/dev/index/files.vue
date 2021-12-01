<template>
    <div>
        <ui-playground class="mb-4" :value='[
            `<ui-upload @change="$refs.files.refresh()" folder="/test"></ui-upload>`,
            `<br><br>`,
            `<ui-file ref="files" folder="/test"></ui-file>`,
        ].join("\n")'></ui-playground>
    </div>
</template>

<script>
export default {
    head() {
        return {
            title: "Arquivos",
        };
    },

    data() {
        return {
            upload: '',
            files: [],
        };
    }
}
</script>