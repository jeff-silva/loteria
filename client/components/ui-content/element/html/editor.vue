<template>
    <div>
        editor
    </div>
</template>

<script>
export default {
    props: {
        html: {default:''},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },
}
</script>