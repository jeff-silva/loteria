<template>
    <div>
        <table class="table">
            <colgroup>
                <col width="50px">
                <col width="*">
                <col width="50px" v-for="n in type.numbers">
            </colgroup>
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Data</th>
                    <th v-for="n in type.numbers">{{ n }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="n in computedItems">
                    <td>{{ n.number }}</td>
                    <td>{{ n.date }}</td>
                    <td v-for="nn in n.numbers">{{ nn }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        type: Object,
        items: Array,
    },

    computed: {
        computedType() {
            let type = this.type;
            return type;
        },

        computedItems() {
            return this.items.map(item => {
                item.numbers = item.numbers.split(' ');
                return item;
            });
        },
    },
}
</script>