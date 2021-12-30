<template>
    <div>
        <ui-playground class="mb-4" value="<ui-html value='Hello World'></ui-html>"></ui-playground>
        <ui-playground class="mb-4" value="<ui-code value='Hello World'></ui-code>"></ui-playground>
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