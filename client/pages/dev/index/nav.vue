<template>
    <div>
        <div class="row g-0">
            <div class="col-12 col-md-6 bg-dark">
                <ui-nav class="dev-nav-1" v-model="nav" :items="navItems" mode="horizontal"></ui-nav>
            </div>
            <div class="col-12 col-md-6">
                <ui-nav class="dev-nav-2" v-model="nav" :items="navItems" mode="horizontal"></ui-nav>
            </div>
            <div class="col-2 bg-dark">
                <ui-nav class="dev-nav-3" v-model="nav" :items="navItems" mode="vertical"></ui-nav>
            </div>
            <div class="col-2">
                <ui-nav class="dev-nav-4" v-model="nav" :items="navItems" mode="vertical"></ui-nav>
            </div>
            <div class="col-8 bg-light">
                <pre class="bg-light m-0 p-3" style="max-height:400px; overflow:auto;">{{ $data }}</pre>
            </div>
        </div>        
    </div>
</template>

<script>
export default {
    head() {
        return {
            title: "Navegação",
        };
    },

    data() {
        return {
            nav: "",
            navItems: [
                {to:"", icon:"fas fa-globe", label:"Home", children:[]},
                {to:"", icon:"fas fa-globe", label:"Shop", children:[
                    {to:"", icon:"fas fa-globe", label:"Produtos", children:[
                        {to:"", icon:"fas fa-globe", label:"Criar", children:[]},
                        {to:"", icon:"fas fa-globe", label:"Buscar", children:[]},
                    ]},
                ]},
                {to:"", icon:"fas fa-globe", label:"Configurações", children:[
                    {to:"", icon:"fas fa-globe", label:"Loja", children:[]},
                    {to:"", icon:"fas fa-globe", label:"Site", children:[]},
                    {to:"", icon:"fas fa-globe", label:"Usuários", children:[]},
                ]},
            ],
        };
    }
}
</script>

<style>
.dev-nav-1 {border:solid 1px red;}
.dev-nav-1 * {color: #fff !important;}

.dev-nav-2 {border:solid 1px green;}
.dev-nav-2 * {color: red !important;}

.dev-nav-3 {border:solid 1px blue;}
.dev-nav-3 * {color: #fff !important;}

.dev-nav-4 {border:solid 1px orange;}
.dev-nav-4 * {color: red !important;}

</style>