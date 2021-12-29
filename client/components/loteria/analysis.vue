<template>
    <div class="loteria-analysis">
        <pre>{{ $data }}</pre>
    </div>
</template>

<script>
export default {
    props: {
        value: Array,
        loteria: Object,
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = JSON.parse(JSON.stringify(value));
            this.analysisLoad();
        }},
    },

    methods: {
        emitValue() {
            this.$emit('value', this.props.value);
            this.$emit('input', this.props.value);
            this.$emit('change', this.props.value);
        },

        analysisLoad() {
            let params = {typeid:this.props.loteria.id, numbers:this.props.value};
            this.$axios.get('/api/loteria-sorteios/analysis', {params}).then(resp => {
                this.analysis = resp.data;
            });
        },
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
            analysis: false,
        };
    },

    mounted() {
        this.analysisLoad();
    },
}
</script>