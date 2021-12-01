export default {
    strict: false,

    state: {
        settings: {},
        notifications: [],
        formats: [],
    },

    actions: {
        init({state}) {
            window.$nuxt.$axios.get('/api/sync').then(resp => {
                for(let attr in resp.data) {
                    state[ attr ] = resp.data[attr];;
                }
            });
        },
    },
}