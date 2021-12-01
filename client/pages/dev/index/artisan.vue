<template>
    <div>
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>Comando</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="c in ($store.state.env.artisanCommands || [])">
                    <td>php artisan {{ c.name }}</td>
                    <td>{{ c.description }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    head() {
        return {
            title: "Comandos Artisan",
        };
    },
}
</script>