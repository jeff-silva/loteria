<template>
    <div class="loteria-numbers" v-infinite-scroll="infiniteScroll">
        <table class="table table-sm table-bordered m-0">
            <colgroup>
                <col width="200px">
                <col width="*">
            </colgroup>
            <tbody>
                <tr v-for="s in _items">
                    <td>
                        <div>{{ s.number }}</div>
                        <div>{{ s.date|dateFormat }}</div>
                    </td>
                    <td class="p-0">
                        <a href="javascript:;"
                            class="btn m-1 rounded-0"
                            :class="btnClasses(nn)"
                            style="font-family:monospace;"
                            v-for="nn in s.numbersData"
                        >{{ nn }}</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- <pre>{{ $data }}</pre> -->
    </div>
</template>

<script>
export default {
    props: {
        value: Array,
        items: Array,
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

        btnClasses(number) {
            if (this.props.value.indexOf(number)>=0) {
                return ['btn-primary'];
            }
            return ['btn-outline-primary'];
        },

        infiniteScroll() {
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
        _items() {
            let items = [...this.props.items];
            if (items.length>=this.maxItems) {
                items.length = this.maxItems;
            }
            return items;
        },
    },
}
</script>