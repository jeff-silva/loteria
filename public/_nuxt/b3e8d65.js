(window.webpackJsonp=window.webpackJsonp||[]).push([[34],{768:function(t,n,e){"use strict";e.r(n);var o={head:function(){return{title:"Endpoints"}},data:function(){return{endpoints:[]}},methods:{getEndpoints:function(){var t=this;this.$axios.get("/api/endpoints").then((function(n){t.endpoints=n.data}))}},mounted:function(){this.getEndpoints()}},r=e(9),component=Object(r.a)(o,(function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("div",[e("table",{staticClass:"table table-bordered table-sm"},[t._m(0),t._v(" "),e("tbody",t._l(t.endpoints,(function(n){return e("tr",[e("td",[t._v(t._s(n.methods.join(", ")))]),t._v(" "),e("td",[t._v(t._s(n.uri))]),t._v(" "),e("td",[t._v(t._s(0==n.parameters.length?"Nenhum":n.parameters.join(", ")))])])})),0)])])}),[function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("thead",[e("tr",[e("th",[t._v("Métodos")]),t._v(" "),e("th",[t._v("URI")]),t._v(" "),e("th",[t._v("Parâmetros")])])])}],!1,null,null,null);n.default=component.exports}}]);