<template>
    <div>
        <div v-if="html" v-html="html"></div>
        <div v-else class="text-muted">Nenhum conteúdo criado</div>
    </div>
</template>

<script>
export default {
    props: {
        html: {default:''},
    },
}
</script>