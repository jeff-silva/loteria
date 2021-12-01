<template>
    <div>
        <div class="d-flex bg-light shadow-sm p-2 mb-4" v-if="$auth.user">
            <div class="flex-grow-1">Bem vindo {{ $auth.user.name }}</div>
            <div><a href="javascript:;" class="text-white" @click="$auth.logout()">Sair</a></div>
        </div>

        <ui-playground class="mb-4" value="<ui-auth-login></ui-auth-login>"></ui-playground>
        <ui-playground class="mb-4" value="<ui-auth-register></ui-auth-register>"></ui-playground>
        <ui-playground class="mb-4" value="<ui-auth-password></ui-auth-password>"></ui-playground>
    </div>
</template>

<script>
export default {
    head() {
        return {
            title: "Autenticação",
        };
    },
}
</script>