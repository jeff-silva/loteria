<template>
    <div>
        <div class="row no-gutters">
            <div class="col-2 p-0 bg-dark" style="height:100vh; position:sticky; top:0;">
                <div class="list-group list-group-flush">
                    <a :href="i.url" class="list-group-item bg-transparent text-white" v-for="i in menuItens">
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
        return {
            menuItens: [
                {
                    label: "Home",
                    url: "/",
                },
                {
                    label: "Loteria",
                    url: "/loteria",
                },
            ],
        };
    },
}
</script>