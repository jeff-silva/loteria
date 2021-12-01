// require('dotenv').config();

import Vue from 'vue';

import Swal from 'sweetalert2';
Vue.prototype.$swal = Swal;
Vue.prototype.$confirm = function(html) {
    return new Promise((resolve, reject) => {
        Swal.fire({
            title: '',
            html: html,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
        })
        .then((result) => {
            if (result.isConfirmed) {
                resolve(result);
            }
        })
        .catch(err => {
            reject(err);
        });
    });
};

import Element from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en';
Vue.use(Element, { locale });

// https://axios.nuxtjs.org/
export default function (nuxt) {
    nuxt.$axios.onRequest((config) => {
        config.proxy = true;
        return config;
    });
};


// https://validatejs.org/
import validate from 'validate.js';

Vue.prototype.$validator = function(rules) {
    return new (class {
        run = 0;
        error = {};
        errorReal = {};
        rules = {};
    
        constructor(rules) {
            validate.validators.presence.message = 'Campo obrigatório';
            validate.validators.email.message = 'E-mail inválido';
            validate.validators.equality.message = 'Não bate com a confirmação';
    
            this.rules = rules;
        }
        
        clear() {
            this.run = 0;
            this.error = {};
            this.errorReal = {};
        }
    
        validate(data, onlyField=null) {
            this.run++;

            for(let i in data) { if (! data[i]) delete data[i]; }
            let error = validate(data, this.rules) || {};

            this.error = Object.assign({}, error);
            this.errorReal = Object.assign({}, error);
    
            if (onlyField) {
                for(let i in this.error) {
                    if (i == onlyField) continue;
                    delete this.error[i];
                }
            }
        }
    
        valid() {
            if (this.run==0) return false;
            return Object.keys(this.errorReal).length==0;
        }
    
        invalid() {
            if (this.run==0) return true;
            return Object.keys(this.errorReal).length>0;
        }
    
        setError(errors) {
            this.clear();
            this.error = errors;
            this.errorReal = errors;
        }
    })(rules);
};


Vue.prototype.$log = function() {
    Array.prototype.slice.call(arguments).forEach(item => {
        console.log(item);
    });
};
