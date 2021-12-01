<template>
    <div>
        <ui-playground class="mb-4" value="<ui-editor type='html' value='Hello World'></ui-editor>"></ui-playground>
        <ui-playground class="mb-4" value="<ui-editor type='code' value='Hello World'></ui-editor>"></ui-playground>
    </div>
</template>

<script>
export default {
    head() {
        return {
            title: "Editor",
        };
    },

    data() {
        return {
            content: (localStorage.getItem('dev-editor-content') || 'Hello <strong>World</strong>'),
        };
    },

    methods: {
        storeValue(value) {
            localStorage.setItem('dev-editor-content', value);
        },
    },
}
</script>