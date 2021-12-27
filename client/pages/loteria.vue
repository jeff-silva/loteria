<template>
    <div>
        <ui-app>
            <template #header>
                <!--  -->
            </template>

            <template #sidebar>
                <ui-nav :items="navItems" v-bind="{textColor:'#fff'}"></ui-nav>
            </template>
        
            <nuxt-child></nuxt-child>
        </ui-app>
    </div>
</template>

<script>
export default {
    data() {
        return {
            navItems: [],
        };
    },

    methods: {
        loteriaSorteioTypesLoad() {
            this.$axios.get('/api/loteria-sorteios/types').then(resp => {
                this.navItems = resp.data.map(loteria => {
                    return {
                        to: `/loteria/${loteria.id}`,
                        label: loteria.name,
                    };
                });
            });
        },
    },

    mounted() {
        this.loteriaSorteioTypesLoad();
    },
}
</script>

<!--
api/loteria-sorteios/types
api/loteria-sorteios/type/{type}
-->