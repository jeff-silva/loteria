<template>
    <div class="loteria-table">
        <table class="table table-bordered m-0">
            <tbody>
                <tr v-for="ns in _numbers">
                    <td class="p-1" v-for="n in ns">
                        <a href="javascript:;"
                            class="btn w-100 rounded-0"
                            :class="{'btn-primary':props.value.indexOf(n)>=0}"
                            @click="numberToggle(n)"
                        >{{ n }}</a>
                    </td>
                </tr>
            </tbody>
        </table>
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
        }},
    },

    methods: {
        emitValue() {
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

        arrayChunk(arr, size=5) {
            return Array.from({ length: Math.ceil(arr.length / size) }, (v, i) => {
                return arr.slice(i * size, i * size + size);
            });
        },
    },

    computed: {
        _numbers() {
            let loteria=this.props.loteria, numbers=[];
            for(let n=loteria.tableNumberStart; n<=loteria.tableNumberFinal; n++) {
                numbers.push(n.toString().padStart(2, '0'));
            }
            return this.arrayChunk(numbers, loteria.tableNumberLine);
        },
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },
}
</script>