<template>
    <div>
        <div class="bg-light mb-4 p-2 shadow-sm">
            <div class="d-flex justify-content-end">
                <div><a href="?import=1" class="btn btn-primary rounded-0">Atualizar</a></div>
            </div>
        </div>

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
                    <th v-for="n in type.numbers" class="text-center">{{ n }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="n in computedItems">
                    <td>{{ n.number }}</td>
                    <td>{{ n.date }}</td>
                    <td v-for="nn in n.numbers" :class="{'bg-dark':nn==selectedNumber}">
                        <a href="javascript:;"
                            style="text-decoration:none;"
                            :class="{'text-white':nn==selectedNumber}"
                            class="d-block text-center"
                            @click="selectNumber(nn)"
                        >{{ nn }}</a>
                    </td>
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

    data() {
        return {
            selectedNumber: false,
        };
    },

    methods: {
        selectNumber(number) {
            this.selectedNumber = number;
        },
    },

    computed: {
        computedItems() {
            return this.items.map(item => {
                item.numbers = item.numbers.split(' ');
                return item;
            });
        },
    },
}
</script>