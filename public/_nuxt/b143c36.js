(window.webpackJsonp=window.webpackJsonp||[]).push([[20],{748:function(t,e,n){"use strict";n.r(e);var o={middleware:"auth",layout:"admin",data:function(){return{loteriasTypes:[]}},methods:{loteriasTypesLoad:function(){var t=this;return this.$axios.get("/api/loteria-sorteios/types").then((function(e){t.loteriasTypes=e.data}))}},mounted:function(){this.loteriasTypesLoad()}},r=n(9),component=Object(r.a)(o,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("table",{staticClass:"table"},[n("tbody",t._l(t.loteriasTypes,(function(e){return n("tr",[n("td",[n("nuxt-link",{attrs:{to:"/admin/loterias/"+e.id}},[t._v(t._s(e.name))])],1)])})),0)])])}),[],!1,null,null,null);e.default=component.exports}}]);