<template>
    <div>
        <el-collapse accordion>
            <el-collapse-item title="Backend">
                <p>Todo o backend do sistema é criado em Laravel.</p>
                <p>Para entender melhor como funciona a configuração Laravel, acesse sua <a href="https://laravel.com" target="_blank">documentação</a>.</p>
            </el-collapse-item>

            <el-collapse-item title="Frontend">
                <p>Todo o frontend do sistema é criado em Nuxt, e seus respectivos arquivos estão na pasta <code>/client</code>.</p>
                <p>Para entender melhor como funciona a configuração Nuxt, acesse sua <a href="https://nuxtjs.org" target="_blank">documentação</a>.</p>
            </el-collapse-item>

            <el-collapse-item title="Componentes UI">
                <p>A aplicação é feita com suporte dos componentes do Element.</p>
                <p>Para entender melhor como funciona o Element, acesse sua <a href="https://element.eleme.io" target="_blank">documentação</a>.</p>
            </el-collapse-item>

            <el-collapse-item title="Build e deploy">
                <p>Para preparar a aplicação para a produção, basta primeiramente executar o comando <code>npm run generate</code>.</p>
                <p>Todos os arquivos gerados irão para a pasta <code>/public</code> do Laravel, e então a aplicação estará pronta.</p>
            </el-collapse-item>
        </el-collapse>
    </div>
</template>

<script>
export default {
    head() {
        return {
            title: "Início",
        };
    },
}
</script>