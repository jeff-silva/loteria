<template>
  <div style="display:flex; align-items:center; justify-content:center; height:100vh;">
    <div style="width:300px;">
      <ui-auth-login v-if="form=='login'" redirect="/admin"></ui-auth-login>
      <ui-auth-register v-if="form=='register'"></ui-auth-register>
      <ui-auth-password v-if="form=='password'"></ui-auth-password>
      <br>
      <div><a href="javascript:;" @click="form='login'">Login</a></div>
      <div><a href="javascript:;" @click="form='register'">Cadastre-se</a></div>
      <div><a href="javascript:;" @click="form='password'">Esqueci minha senha</a></div>
      <nuxt-link to="/dev">Desenvolvimento</nuxt-link>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: 'login',
    };
  },
}
</script>