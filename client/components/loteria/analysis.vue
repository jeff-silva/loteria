<template>
    <div class="loteria-analysis">
        <div class="list-group">
            <div class="list-group-item" v-if="props.value.length==0">
                Selecione números para a análise
            </div>
        
            <div class="list-group-item" v-if="props.value.length && _sorteiosComSelecionados.length">
                <div class="mb-1">{{ _sorteiosComSelecionados.length }} Jogos com os {{ props.value.length }} números selecionados:</div>
                <div style="max-height:150px; overflow:auto;">
                    <pre class="m-0" v-for="s in _sorteiosComSelecionados">• N°{{ s.number }} &nbsp; {{ s.date|dateFormat }} <br>&nbsp; {{ s.numbersData.join(', ') }}</pre>
                </div>
            </div>
        </div>
        <!-- <pre>_sorteiosComSelecionados: {{ _sorteiosComSelecionados }}</pre> -->
        <!-- <pre>$data: {{ $data }}</pre> -->
    </div>
</template>

<script>
export default {
    props: {
        value: Array,
        loteria: Object,
        sorteios: Array,
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = JSON.parse(JSON.stringify(value));
            // this.analysisLoad();
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

        arrayIntersection(a, b) {
            return [...new Set(a)].filter(x => (new Set(b)).has(x));
        },
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
            analysis: false,
        };
    },

    computed: {
        _sorteiosComSelecionados() {
            if (this.props.value.length==0) return [];
            return this.props.sorteios.filter(item => {
                let intersecs = this.arrayIntersection(item.numbersData, this.props.value);
                // console.log(intersecs.length, this.props.value.length);
                return intersecs.length == this.props.value.length;
            });
        },
    },

    mounted() {
        this.analysisLoad();
    },
}
</script>