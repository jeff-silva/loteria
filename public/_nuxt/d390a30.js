(window.webpackJsonp=window.webpackJsonp||[]).push([[30],{762:function(t,e,l){"use strict";l.r(e);l(30);var n={data:function(){return{pages:[]}},mounted:function(){var t=this;this.$helpers.routes("/dev/").then((function(e){t.pages.push({to:"/",label:"Home"}),e.forEach((function(e){return t.pages.push(e)}))}))}},o=l(9),component=Object(o.a)(n,(function(){var t=this,e=t.$createElement,l=t._self._c||e;return l("div",[l("div",{staticClass:"d-flex"},[l("div",{staticClass:"bg-dark text-white",staticStyle:{"min-width":"200px",height:"100vh",overflow:"auto"}},[l("ui-nav",{attrs:{items:t.pages,mode:"vertical","text-color":"#fff"}})],1),t._v(" "),l("div",{staticClass:"flex-grow-1",staticStyle:{height:"100vh",overflow:"auto"}},[t._l(t.pages,(function(p){return p.to==t.$route.path?l("div",{staticClass:"bg-light shadow-sm p-2 px-3 fw-bold text-uppercase"},[t._v(t._s(p.label))]):t._e()})),t._v(" "),l("div",{staticClass:"p-3"},[l("nuxt-child")],1)],2)])])}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiNav:l(433).default})}}]);