<template>
    <div>
        <div class="row g-0">
            <div class="col-2 bg-dark" style="height:100vh; position:sticky; top:0;">
                <div class="list-group list-group-flush">
                    <a :href="i.url" class="list-group-item bg-transparent text-white" v-for="i in menuItems">
                        {{ i.label }}
                    </a>
                </div>
            </div>
            <div class="col-10">
                <slot></slot>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        let menuItems = [{
            label: "Home",
            url: "/",
        }];

        this.$page.props.tiposAposta.forEach(tipoAposta => {
            menuItems.push({
                label: tipoAposta.type.name,
                url: `/loteria/${tipoAposta.type.id}`,
            });
        });

        return {
            menuItems,
        };
    },
}
</script>