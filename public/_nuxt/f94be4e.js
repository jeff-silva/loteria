(window.webpackJsonp=window.webpackJsonp||[]).push([[21,10],{712:function(t,e,n){"use strict";n.r(e);var l={props:{value:Object,method:{default:"get"},action:{default:""},validator:Object,successMessage:{default:""}},data:function(){return{loading:!1,validate:this.$validator(this.validator)}},methods:{submit:function(){var t=this;this.loading=!0,("post"==this.method?this.$axios.post(this.action,this.value):this.$axios.get(this.action,{params:this.value})).then((function(e){t.loading=!1,t.$emit("success",e.data),t.successMessage&&t.$swal.fire("",t.successMessage,"success")})).catch((function(e){t.loading=!1,t.validate.setError(e.response.data.fields)}))}}},o=n(9),component=Object(o.a)(l,(function(){var t=this,e=t.$createElement;return(t._self._c||e)("form",{attrs:{method:t.method,action:t.action},on:{submit:function(e){return e.preventDefault(),t.submit.apply(null,arguments)}}},[t._t("default",null,{method:t.method,action:t.action,loading:t.loading,submit:t.submit,validator:t.validate})],2)}),[],!1,null,null,null);e.default=component.exports},749:function(t,e,n){"use strict";n.r(e);var l={middleware:"auth",layout:"admin",data:function(){return{settings:{},pages:[]}},methods:{settingsGetAll:function(){var t=this;this.$axios.get("/api/settings/get-all").then((function(e){t.settings=e.data}))},settingsSaveAll:function(){var t=this;this.$axios.post("/api/settings/save-all").then((function(e){t.settings=e.data,t.$store.dispatch("app/init")}))}},mounted:function(){var t=this;this.settingsGetAll(),this.$helpers.routes("/admin/settings/").then((function(e){t.pages=e}))}},o=n(9),component=Object(o.a)(l,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("div",{staticClass:"d-flex"},[n("div",{staticClass:"bg-dark",staticStyle:{"min-width":"150px!important","max-width":"150px!important"}},[n("ui-nav",{attrs:{items:t.pages,mode:"vertical","text-color":"#fff"}})],1),t._v(" "),n("div",{staticClass:"flex-grow-1"},[n("ui-form",{attrs:{method:"post",action:"/api/settings/save-all","success-message":"Configurações alteradas"},scopedSlots:t._u([{key:"default",fn:function(e){var l=e.loading;return[n("div",{staticClass:"card-header"},t._l(t.pages,(function(p){return p.to==t.$route.path?n("div",[t._v(t._s(p.label))]):t._e()})),0),t._v(" "),n("div",{staticClass:"card"},[n("div",{staticClass:"card-body"},[n("nuxt-child",{attrs:{settings:t.settings,"settings-get-all":t.settingsGetAll,"settings-save-all":t.settingsSaveAll}})],1),t._v(" "),n("div",{staticClass:"card-footer text-end"},[n("button",{directives:[{name:"loading",rawName:"v-loading",value:l,expression:"loading"}],staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("\n                            Salvar\n                        ")])])])]}}]),model:{value:t.settings,callback:function(e){t.settings=e},expression:"settings"}})],1)])])}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiNav:n(432).default,UiForm:n(712).default})}}]);