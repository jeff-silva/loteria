import Vue from 'vue';
import moment from 'moment';


export default function({app}) {
    let $helpers = {};
    
    $helpers.routes = function(startsWith='/') {
        return new Promise((resolve, reject) => {
            let _promise = function(route, parent=false) {
                let path = ['/', (parent? parent.path: null), route.path].join('/').replace(/\/+/g, '/');
                if (!path.startsWith(startsWith)) return null;
    
                return new Promise((resolve, reject) => {
                    route.component().then(comp => {
                        let label = (typeof comp.head=='function')? (comp.head().title || path): path;
                        resolve({to:path, label});
                    });
                });
            };
    
            let promises = [];
    
            for(let i in app.router.options.routes) {
                let route1 = app.router.options.routes[i];
                promises.push(_promise(route1));
    
                for(let ii in route1.children) {
                    let route2 = route1.children[ii];
                    promises.push(_promise(route2, route1));
    
                    for(let iii in route2.children) {
                        let route3 = route2.children[iii];
                        promises.push(_promise(route3, route2));
    
                        for(let iiii in route3.children) {
                            let route4 = route3.children[iiii];
                            promises.push(_promise(route4, route3));
                        }
                    }
                }
            }
    
            Promise.all(promises.filter(value => value)).then(values => {
                resolve(values);
            });
        });
    };
    
    $helpers.strContains = function(value, contains) {
        return (value || '').includes(contains);
    };

    $helpers.dateFormat = function(value, format='DD/MM/YYYY - HH:mm') {
        let m = moment(value);
        if (! m.isValid()) return '';
        return m.format(format);
    };

    $helpers.numberFormat = function(value, format) {
        return 'numberFormat';
    };
    
    $helpers.timeout = function(params = {}) {
        params = {
            name: '',
            timeout: 0,
            interval: 0,
            callback() {},
            ...params
        };
    
        if (!params.name) throw 'Informe parâmetro "name"';
    
        if (window[`nuxt-timeout-${params.name}`]) {
            clearTimeout(window[`nuxt-timeout-${params.name}`]);
        }
    
        window[`nuxt-timeout-${params.name}`] = setTimeout(() => {
            params.callback();
        }, params.timeout);
    
        if (params.interval) {
            if (window[`nuxt-interval-${params.name}`]) {
                clearInterval(window[`nuxt-interval-${params.name}`]);
            }
    
            window[`nuxt-interval-${params.name}`] = setInterval(() => {
                params.callback();
            }, params.interval);
        }
    };

    Vue.prototype.$helpers = $helpers;

    for(let name in $helpers) {
        Vue.filter(name, $helpers[name]);
    }
};