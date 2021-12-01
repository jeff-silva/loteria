<template>
    <div>
        <lazy-ui-upload ref="upload" @change="$refs.upload.clear(); $refs.file.refresh();"></lazy-ui-upload>
        <div class="mb-3"></div>
        <lazy-ui-file ref="file"></lazy-ui-file>
    </div>
</template>

<script>
export default {
    middleware: 'auth',
    layout: 'admin',
}
</script>