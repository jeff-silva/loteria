import Vue from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue';
import Layout from '../layouts/default';

import axios from "axios";
Vue.prototype.$axios = axios;

import swal from 'sweetalert2';
Vue.prototype.$swal = swal;

// Vue.prototype.$confirm = function(params) {
//     return new Promise((resolve, reject) => {
//       if (typeof params=='string') {
//         params = {title: params};
//       }
  
//       params = Object.assign({
//         showCancelButton: true,
//         confirmButtonText: 'Confirmar',
//         cancelButtonText: 'Cancelar',
//       }, params);
  
//       Swal.fire(params).then(result => {
//         if (! result.isConfirmed) return;
//         resolve(result);
//       });
//     });
//   };

import moment from 'moment';
Vue.filter('dateFormat', (value, formatString='d/m/Y H:i:s') => {
    formatString = formatString.replace(/d/, 'DD');
    formatString = formatString.replace(/m/, 'MM');
    formatString = formatString.replace(/y/, 'YYYY');
    formatString = formatString.replace(/H/, 'hh');
    formatString = formatString.replace(/i/, 'mm');
    formatString = formatString.replace(/s/, 'ss');
    return moment(value).format(formatString);
});

createInertiaApp({
    resolve: name => {
        const page = require(`../pages/${name}`).default;
        page.layout = page.layout || Layout;
        return page;
    },

    setup({ el, App, props }) {
        new Vue({
            render: h => h(App, props),
        }).$mount(el);
    },
});