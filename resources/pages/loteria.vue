<template>
    <div>
        <div class="d-flex">
            <div class="p-2" v-for="ta in tiposAposta">
                <a :href="`/loteria/${ta.type.id}`">{{ ta.type.name }}</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        tiposAposta: Array,
    },
}
</script>