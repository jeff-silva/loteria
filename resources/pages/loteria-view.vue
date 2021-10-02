<template>
    <div>
        <div v-if="sorteio">
            <div class="bg-light mb-4 px-3 py-2 shadow-sm">
                <div class="d-flex justify-content-end">
                    <div class="flex-grow-1">
                        <h2 class="m-0">{{ sorteio.tipoSorteio.name }}</h2>
                    </div>
                    <div><a href="?import=1" class="btn btn-primary btn-sm rounded-0">
                        <i class="fas fa-fw fa-sync"></i>
                    </a></div>
                </div>
            </div>

            <div class="px-3">
                <div class="row g-0">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">Sorteios de {{ props.params.min }} ~ {{ props.params.max }}</div>
                            <div class="card-body p-0">

                                <div class="px-3 pt-3">
                                    <div class="input-group">
                                        <div class="input-group-text">De</div>
                                        <input type="number" class="form-control" v-model="props.params.min" @change="getAnalise()">
                                        <div class="input-group-text">até</div>
                                        <input type="number" class="form-control" v-model="props.params.max" @change="getAnalise()">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary" @click="getAnalise()">Ir</button>
                                        </div>
                                    </div>
                                </div>
            
                                <hr>

                                <div style="overflow:auto; max-height:calc(100vh - 220px);">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr v-for="s in sorteio.sorteios">
                                                <td>
                                                    <a href="javascript:;" @click="selectNumbers(s.numbers, true)">{{ s.number }}</a>
                                                </td>
                                                <!-- <td>{{ s.date|dateFormat }}</td> -->
                                                <td v-for="n in s.numbers" class="p-0">
                                                    <a href="javascript:;" :class="numberClasses(n)" @click="selectNumbers([n])">{{ n }}</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-5 px-3">
                        <div class="card">
                            <div class="card-header">Selecionar ({{ sorteio.tipoSorteio.numbersSelect }} números)</div>
                            <div class="card-body p-0">
                                <div class="m-0 p-3 pb-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            v-model="selectedNumbersString"
                                            placeholder="Informar números"
                                            @keyup.enter="selectedNumbersStringConvert()"
                                        >
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary rounded-0" @click="selectedNumbersStringConvert()">
                                                Ir
                                            </button>
                                        </div>
                                    </div>
                                </div>
    
                                <hr>
    
                                <table class="table table-borderless m-0">
                                    <tbody>
                                        <tr v-for="numbs in sorteio.numbersTable">
                                            <td v-for="n in numbs" class="text-center p-0">
                                                <a href="javascript:;" :class="numberClasses(n)" @click="selectNumbers([n], false)">{{ n }}</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                
                                <div class="p-3 text-end">
                                    <a href="javascript:;" @click="selectNumbers([], true)">Limpar</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="card mb-2" v-for="s in sorteio.probabilidades.items" v-if="s.goods.length && s.bads.length">
                            <div class="card-header">{{ s.label }}</div>
                            <div class="card-body">
                                <div v-if="s.goods.length" class="mb-3">
                                    <div class="px-2">Bons</div>
                                    <div>
                                        <a href="javascript:;" v-for="n in s.goods" :class="numberClasses(n)" @click="selectNumbers([n], false)">{{ n }}</a>
                                    </div>
                                    <a href="javascript:;" class="btn btn-outline-primary btn-sm d-block mt-2" @click="selectNumbers(s.goods, true)">Selecionar todos</a>
                                </div>

                                <div v-if="s.bads.length">
                                    <div class="px-2">Ruins</div>
                                    <div>
                                        <a href="javascript:;" v-for="n in s.bads" :class="numberClasses(n)" @click="selectNumbers([n], false)">{{ n }}</a>
                                    </div>
                                    <a href="javascript:;" class="btn btn-outline-primary btn-sm d-block mt-2" @click="selectNumbers(s.bads, true)">Selecionar todos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        type: String,
        params: Object,
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
            selectedNumbersString: "",
            sorteio: false,
        };
    },

    methods: {
        selectNumbers(numbers, clear=false) {
            let selectedNumbers = clear? []: this.props.params.numbers;

            numbers.forEach(number => {
                if (! clear) {
                    let index = selectedNumbers.indexOf(number);
                    if (index >=0) {
                        selectedNumbers.splice(index, 1);
                        return;
                    }
                }

                selectedNumbers.push(number);
            });

            this.props.params.numbers = selectedNumbers;

            this.refreshUrl();
            this.getAnalise();
        },

        refreshUrl() {
            const url = new URL(window.location);
            url.searchParams.set('max', this.props.params.max);
            url.searchParams.set('min', this.props.params.min);
            url.searchParams.set('numbers', this.props.params.numbers.join("-"));
            // url.searchParams.set('type', this.props.params.type);
            window.history.pushState({}, '', url);
        },

        numberClasses(number) {
            return {
                'loteria-link': true,
                'active': (this.props.params.numbers.indexOf(number)>=0),
            };
        },

        getAnalise() {
            if (this.getAnaliseTimeout) {
                clearTimeout(this.getAnaliseTimeout);
            }

            this.getAnaliseTimeout = setTimeout(() => {
                let params = this.props.params;
                this.$axios.get('/api/loteria/analise', {params}).then(resp => {
                    this.sorteio = resp.data;
                });
            }, 500);
        },

        selectedNumbersStringConvert() {
            let selectedNumbers = this.selectedNumbersString.split(/[^0-9]/).filter(n => n).map(n => {
                n = parseInt(n);
                if (n<10) n = '0'+n;
                return ''+n;
            });

            // this.selectedNumbersString = '';
            this.selectNumbers(selectedNumbers, true);
        },
    },

    computed: {
        computedItems() {
            return this.items.map(item => {
                return item;
            });
        },

        computedSelectNumbers() {
            let r = {};
            r.numbers = [];

            if (this.sorteio) {
                console.log(this.sorteio.tipoSorteio, r.numbers);
                for(let x=1; x<=this.sorteio.tipoSorteio.numbersTotal; x++) {
                    x = x<10? ('0'+x): x.toString();
                    r.numbers.push(x);
                }
    
                r.numbers = ((arr, size) => {
                    return Array.from({ length: Math.ceil(arr.length / size) }, (v, i) => {
                        return arr.slice(i * size, i * size + size);
                    });
                })(r.numbers, this.sorteio.tipoSorteio);
            }

            return r;
        },

        computedSelectedSorteios() {
            let returns = [];
            let _arrayIntersection = (a, b) => { const s = new Set(b); return [...new Set(a)].filter(x => s.has(x)); };

            this.computedItems.forEach((item, itemIndex) => {
                let intersections = _arrayIntersection(item.numbers, this.props.selectedNumbers);
                if (intersections.length >= this.type.numbersPremium) {
                    returns.push({
                        id: item.id,
                        number: item.number,
                        numbers: item.numbers,
                        date: item.date,
                        intersections,
                    });
                }
            });

            returns.sort((a, b) => {
                if (a.intersections.length < b.intersections.length) return 1;
                if (a.intersections.length > b.intersections.length) return -1;
                return 0;
            });

            return returns;
        },
    },

    components: {
        loteriaSelectClear: {
            props: {value: Array},
            template: `<div class="d-flex justify-content-end">
                <div class="ps-2"><a href="javascript:;" class="btn btn-outline-primary btn-sm" style="text-decoration:none;" @click="$parent.selectNumbers(value, true)">Selecionar todos</a></div>
                <div class="ps-2"><a href="javascript:;" class="btn btn-outline-primary btn-sm" style="text-decoration:none;" @click="$parent.selectNumbers([], true)">Limpar</a></div>
            </div>`,
        },
    },

    mounted() {
        this.getAnalise();
    },
}
</script>


<style>
.loteria-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    text-align: center;
    text-decoration: none;
    color: var(--bs-dark);
}

.loteria-link.active {
    background: var(--bs-dark);
    color: #fff;
}
</style>