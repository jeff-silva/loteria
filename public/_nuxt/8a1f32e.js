(window.webpackJsonp=window.webpackJsonp||[]).push([[3],{711:function(t,e,r){"use strict";r.d(e,"a",(function(){return c}));var n=r(155);var o=r(211),l=r(114);function c(t){return function(t){if(Array.isArray(t))return Object(n.a)(t)}(t)||Object(o.a)(t)||Object(l.a)(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}},750:function(t,e,r){"use strict";r.r(e);var n=r(711),o=(r(46),r(15),r(727),r(30),r(729),r(730),r(731),r(732),r(733),r(734),r(735),r(736),r(737),r(738),r(739),r(740),r(741),r(742),r(743),r(744),r(25),{props:{value:Array,loteria:Object,sorteios:Array},watch:{$props:{deep:!0,handler:function(t){this.props=JSON.parse(JSON.stringify(t))}}},methods:{emitValue:function(){this.$emit("value",this.props.value),this.$emit("input",this.props.value),this.$emit("change",this.props.value)},analysisLoad:function(){var t=this,e={typeid:this.props.loteria.id,numbers:this.props.value};this.$axios.get("/api/loteria-sorteios/analysis",{params:e}).then((function(e){t.analysis=e.data}))},arrayIntersection:function(a,b){return Object(n.a)(new Set(a)).filter((function(t){return new Set(b).has(t)}))}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props)),analysis:!1}},computed:{_sorteiosComSelecionados:function(){var t=this;return 0==this.props.value.length?[]:this.props.sorteios.filter((function(e){return t.arrayIntersection(e.numbersData,t.props.value).length==t.props.value.length}))}},mounted:function(){this.analysisLoad()}}),l=r(9),component=Object(l.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"loteria-analysis"},[r("div",{staticClass:"list-group"},[0==t.props.value.length?r("div",{staticClass:"list-group-item"},[t._v("\n            Selecione números para a análise\n        ")]):t._e(),t._v(" "),t.props.value.length&&t._sorteiosComSelecionados.length?r("div",{staticClass:"list-group-item"},[r("div",{staticClass:"mb-1"},[t._v(t._s(t._sorteiosComSelecionados.length)+" Jogos com os "+t._s(t.props.value.length)+" números selecionados:")]),t._v(" "),r("div",{staticStyle:{"max-height":"150px",overflow:"auto"}},t._l(t._sorteiosComSelecionados,(function(s){return r("pre",{staticClass:"m-0"},[t._v("• N°"+t._s(s.number)+"   "+t._s(t._f("dateFormat")(s.date))+" "),r("br"),t._v("  "+t._s(s.numbersData.join(", ")))])})),0)]):t._e()])])}),[],!1,null,null,null);e.default=component.exports}}]);