<template>
    <div class="loteria-analysis">
        <div v-if="_sorteiosComSelecionados.length==0">Selecione números</div>
        <div v-if="_sorteiosComSelecionados.length>0">{{ _sorteiosComSelecionados.length }} sorteios com os {{ props.value.length }} números selecionados</div>
        <div class="mb-2"></div>
        <loteria-numbers v-model="props.value"
            :sorteios="_sorteiosComSelecionados"
            :load-more="false"
            @change="emitValue()"
        ></loteria-numbers>
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
        emitValue(value=null) {
            if (value!==null) { this.props.value = value; }
            this.$emit('value', this.props.value);
            this.$emit('input', this.props.value);
            this.$emit('change', this.props.value);
        },

        numberToggle(n) {
            let ns = Array.isArray(n)? n: [n];
            ns.forEach(n => {
                let index = this.props.value.indexOf(n);
                if (index==-1) this.props.value.push(n);
                else this.props.value.splice(index, 1);
            });
            this.emitValue();
        },

        numberSet(n) {
            this.props.value = [];
            let ns = Array.isArray(n)? n: [n];
            ns.forEach(n => {
                this.props.value.push(n);
            });
            this.emitValue();
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