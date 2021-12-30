<template>
    <div class="loteria-numbers">
        <div v-infinite-scroll="infiniteScroll">

            <div class="list-group rounded-0">
                <div class="list-group-item" v-if="_sorteios.length==0">
                    Nenhum item
                </div>

                <div class="list-group-item" v-for="s in _sorteios" :class="listGroupItemClass(s)">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <a href="javascript:;" @click="emitValue(s.numbersData)">
                                <div>{{ s.number }}</div>
                                <div>{{ s.date|dateFormat }}</div>
                            </a>
                        </div>

                        <div class="col-12 col-md-8">
                            <a href="javascript:;"
                                class="btn m-1 rounded-0"
                                :class="btnClasses(nn)"
                                style="font-family:monospace;"
                                v-for="nn in s.numbersData"
                                @click="numberToggle(nn)"
                            >{{ nn }}</a>
                        </div>
                    </div>
                </div>
            </div>
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
        value: {default:()=>([])},
        sorteios: {default:()=>([])},
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

        arrayIntersection(a, b) {
            return [...new Set(a)].filter(x => (new Set(b)).has(x));
        },

        listGroupItemClass(sorteio) {
            let intersects = this.arrayIntersection(sorteio.numbersData, this.props.value);

            if (intersects.length && intersects.length==sorteio.numbersData.length) {
                return ['list-group-item-primary'];
            }

            return [];
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