(window.webpackJsonp=window.webpackJsonp||[]).push([[10],{747:function(t,r,e){"use strict";e.r(r);var o={data:function(){return{loading:!1,post:{},validator:this.$validator({name:{presence:!0},email:{presence:!0,email:{message:"inválido"}},password:{presence:!0},password_confirmation:{presence:!0,equality:"password"}})}},methods:{submit:function(){var t=this;this.validator.validate(this.post),this.validator.invalid()||(this.loading=!0,this.$axios.post("/api/register",this.post).then((function(r){t.loading=!1})).catch((function(r){t.loading=!1,t.validator.setError(r.response.data.fields)})))}}},n=e(9),component=Object(n.a)(o,(function(){var t=this,r=t.$createElement,e=t._self._c||r;return e("div",[e("form",{on:{submit:function(r){return r.preventDefault(),t.submit()}}},[t._t("after",null,{error:t.validator.error}),t._v(" "),t._t("fields",(function(){return[e("ui-field",{attrs:{error:t.validator.error.name}},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.post.name,expression:"post.name"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Name"},domProps:{value:t.post.name},on:{change:function(r){return t.validator.validate(t.post,"name")},input:function(r){r.target.composing||t.$set(t.post,"name",r.target.value)}}})]),t._v(" "),e("ui-field",{attrs:{error:t.validator.error.email}},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.post.email,expression:"post.email"}],staticClass:"form-control",attrs:{type:"text",placeholder:"E-mail"},domProps:{value:t.post.email},on:{change:function(r){return t.validator.validate(t.post,"email")},input:function(r){r.target.composing||t.$set(t.post,"email",r.target.value)}}})]),t._v(" "),e("ui-field",{attrs:{error:t.validator.error.password}},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.post.password,expression:"post.password"}],staticClass:"form-control",attrs:{type:"password",placeholder:"Senha"},domProps:{value:t.post.password},on:{change:function(r){return t.validator.validate(t.post,"password")},input:function(r){r.target.composing||t.$set(t.post,"password",r.target.value)}}})]),t._v(" "),e("ui-field",{attrs:{error:t.validator.error.password_confirmation}},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.post.password_confirmation,expression:"post.password_confirmation"}],staticClass:"form-control",attrs:{type:"password",placeholder:"Repita senha"},domProps:{value:t.post.password_confirmation},on:{change:function(r){return t.validator.validate(t.post,"password_confirmation")},input:function(r){r.target.composing||t.$set(t.post,"password_confirmation",r.target.value)}}})])]}),{error:t.validator.error}),t._v(" "),t._t("action",(function(){return[e("button",{staticClass:"btn btn-primary w-100",attrs:{type:"submit",disabled:t.validator.invalid()}},[t.loading?e("i",{staticClass:"fas fa-spin fa-spinner me-1"}):t._e(),t._v("\n                Cadastrar\n            ")])]}),{error:t.validator.error}),t._v(" "),t._t("after",null,{error:t.validator.error})],2)])}),[],!1,null,null,null);r.default=component.exports;installComponents(component,{UiField:e(208).default})}}]);