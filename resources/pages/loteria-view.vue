<template>
    <div>
        <div class="bg-light mb-4 p-2 shadow-sm">
            <div class="d-flex justify-content-end">
                <div><a href="?import=1" class="btn btn-primary rounded-0">Atualizar</a></div>
            </div>
        </div>

        <div class="p-2">
            <div class="row">
                <div class="col-3">
                    <div class="card mb-3" v-for="a in analise.analises">
                        <div class="card-header">{{ a.title }}</div>
                        <div class="card-body">
                            <div class="mb-3" v-if="a.goods.length">
                                <div class="form-label">Bons:</div>
                                <div><a href="javascript:;" :class="numberClasses(n)" v-for="n in a.goods" @click="selectNumbers([n], true)">{{ n }}</a></div>
                                <div class="pt-2"><loteria-select-clear v-model="a.goods"></loteria-select-clear></div>
                            </div>

                            <div class="mb-3" v-if="a.bads.length">
                                <div class="form-label">Ruins:</div>
                                <div><a href="javascript:;" :class="numberClasses(n)" v-for="n in a.bads" @click="selectNumbers([n], true)">{{ n }}</a></div>
                                <div class="pt-2"><loteria-select-clear v-model="a.bads"></loteria-select-clear></div>
                            </div>
                        </div>
                    </div>
    
                    <div class="card mb-3">
                        <div class="card-header">Média geral:</div>
                        <div class="card-body">
                            <div class="mb-3" v-if="analise.goods.length">
                                <div class="form-label">Bons:</div>
                                <div><a href="javascript:;" :class="numberClasses(n)" v-for="n in analise.goods" @click="selectNumbers([n], true)">{{ n }}</a></div>
                                <div class="pt-2"><loteria-select-clear v-model="analise.goods"></loteria-select-clear></div>
                            </div>

                            <div class="mb-3" v-if="analise.bads.length">
                                <div class="form-label">Ruins:</div>
                                <div><a href="javascript:;" :class="numberClasses(n)" v-for="n in analise.bads" @click="selectNumbers([n])">{{ n }}</a></div>
                                <div class="pt-2"><loteria-select-clear v-model="analise.bads"></loteria-select-clear></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="card">
                        <div class="card-header">Selecionar ({{ type.numbersSelect }} números)</div>
                        <div class="card-body p-0">
                            <table class="table table-bordered m-0">
                                <tbody>
                                    <tr v-for="numbs in computedSelectNumbers.numbers">
                                        <td v-for="n in numbs" class="text-center">
                                            <a href="javascript:;" :class="numberClasses(n)" @click="selectNumbers([n], false)">{{ n }}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="p-3 text-end">
                                <a href="javascript:;" @click="selectNumbers([], true)">Limpar</a>
                            </div>
                            <!-- <div class="alert alert-warning rounded-0 m-0" v-if="selectedNumbers.length>type.numbersSelect">
                                Para este tipo de jogo são necessários {{ type.numbersSelect }} números
                            </div> -->

                            <div class="border-top" style="max-height:400px; overflow:auto;" v-if="computedSelectedSorteios.length">
                                <table class="table table-borderless m-0">
                                    <tbody>
                                        <tr v-for="s in computedSelectedSorteios">
                                            <td>{{ s.number }}</td>
                                            <td>{{ s.intersections.length }} acertos</td>
                                            <td v-for="n in s.intersections">
                                                <a href="javascript:;" :class="numberClasses(n)" @click="selectNumbers([n], false)">{{ n }}</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-header">Todos os sorteios</div>
                        <div class="card-body p-0 overflow-scroll" style="max-height:600px;">
                            <table class="table">
                                <colgroup>
                                    <col width="50px">
                                    <col width="*">
                                    <col width="*" v-for="n in type.numbers">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Data</th>
                                        <th v-for="n in type.numbers">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="n in computedItems">
                                        <td><a href="javascript:;" @click="selectNumbers(n.numbers, true)">{{ n.number }}</a></td>
                                        <td><a href="javascript:;" @click="selectNumbers(n.numbers, true)">{{ n.date|dateFormat('d/m/Y') }}</a></td>
                                        <td v-for="nn in n.numbers">
                                            <a href="javascript:;" :class="numberClasses(nn)" @click="selectNumbers([nn], true)">{{ nn }}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
        type: Object,
        items: Array,
        analise: Object,
    },

    data() {
        return {
            selectedNumbers: [],
        };
    },

    methods: {
        selectNumbers(numbers, clear=false) {
            let selectedNumbers = this.selectedNumbers;

            if (clear) {
                selectedNumbers = [];
            }

            numbers.forEach(number => {
                let index = selectedNumbers.indexOf(number);
                if (index >=0) {
                    selectedNumbers.splice(index, 1);
                    return;
                }

                selectedNumbers.push(number);
            });

            this.selectedNumbers = selectedNumbers;
        },

        numberClasses(number) {
            return {
                'loteria-link': true,
                'active': (this.selectedNumbers.indexOf(number)>=0),
            };
        },
    },

    computed: {
        computedItems() {
            return this.items.map(item => {
                item.numbers = item.numbers.split(' ');
                return item;
            });
        },

        computedSelectNumbers() {
            let r = {};
            r.numbers = [];

            for(let x=1; x<=this.type.numbersTotal; x++) {
                x = x<10? ('0'+x): x.toString();
                r.numbers.push(x);
            }

            r.numbers = ((arr, size) => {
                return Array.from({ length: Math.ceil(arr.length / size) }, (v, i) => {
                    return arr.slice(i * size, i * size + size);
                });
            })(r.numbers, this.type.numbersLine);

            return r;
        },

        computedSelectedSorteios() {
            let returns = [];
            let _arrayIntersection = (a, b) => { const s = new Set(b); return [...new Set(a)].filter(x => s.has(x)); };

            this.computedItems.forEach((item, itemIndex) => {
                let intersections = _arrayIntersection(item.numbers, this.selectedNumbers);
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