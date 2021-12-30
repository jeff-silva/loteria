<template>
    <div class="loteria-numbers">
        <div v-infinite-scroll="infiniteScroll">
            <table class="table table-sm table-striped table-borderless m-0">
                <colgroup>
                    <col width="200px">
                    <col width="*">
                </colgroup>
                <tbody>
                    <tr v-for="s in _sorteios">
                        <td>
                            <a href="javascript:;" @click="emitValue(s.numbersData)">
                                <div>{{ s.number }}</div>
                                <div>{{ s.date|dateFormat }}</div>
                            </a>
                        </td>
                        <td class="px-0 py-1" valign="middle">
                            <a href="javascript:;"
                                class="btn m-1 rounded-0"
                                :class="btnClasses(nn)"
                                style="font-family:monospace;"
                                v-for="nn in s.numbersData"
                                @click="numberToggle(nn)"
                            >{{ nn }}</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <a href="javascript:;" class="btn btn-outline-primary w-100"
            @click="infiniteScroll()"
            v-if="props.loadMore"
        >Carregar mais</a>
    </div>
</template>

<script>
export default {
    props: {
        value: Array,
        sorteios: Array,
        loadMore: {default:true},
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = JSON.parse(JSON.stringify(value));
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

        btnClasses(number) {
            if (this.props.value.indexOf(number)>=0) {
                return ['btn-primary'];
            }
            return ['btn-outline-primary'];
        },

        infiniteScroll() {
            if (!this.props.loadMore) return;
            this.maxItems += 10;
        },
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
            maxItems: 10,
        };
    },

    computed: {
        _sorteios() {
            let sorteios = [...this.props.sorteios];
            if (this.props.loadMore && sorteios.length>=this.maxItems) {
                sorteios.length = this.maxItems;
            }
            return sorteios;
        },
    },
}
</script>