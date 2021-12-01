<template>
    <div>
        <div class="d-flex">
            <div class="bg-dark text-white" style="min-width:200px; height:100vh; overflow:auto;">
                <ui-nav :items="pages" mode="vertical" text-color="#fff"></ui-nav>
            </div>
            <div class="flex-grow-1" style="height:100vh; overflow:auto;">
                <div class="bg-light shadow-sm p-2 px-3 fw-bold text-uppercase" v-for="p in pages" v-if="p.to==$route.path">{{ p.label }}</div>
                <div class="p-3">
                    <nuxt-child></nuxt-child>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            pages: [],
        };
    },

    mounted() {
        this.$helpers.routes('/dev/').then(links => {
            this.pages.push({to:"/", label:"Home"});
            links.forEach(page => this.pages.push(page));
        });
    },
}
</script>