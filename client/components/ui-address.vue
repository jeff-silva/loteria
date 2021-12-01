<template>
    <div>
        <div class="row g-3">
            <div class="col-12 col-md-8">
                <input type="text" class="form-control" placeholder="Rua" v-model="address.route" @change="searchAddressBy('route')">
            </div>

            <div class="col-6 col-md-4">
                <input type="text" class="form-control" placeholder="Nº" v-model="address.number" @change="addressSave()">
            </div>

            <div class="col-6 col-md-6">
                <input type="text" class="form-control" placeholder="Complemento" v-model="address.complement" @change="addressSave()">
            </div>

            <div class="col-12 col-md-6">
                <input type="text" class="form-control" placeholder="Bairro" v-model="address.district" @change="addressSave()">
            </div>

            <div class="col-12 col-md-6">
                <input type="text" class="form-control" placeholder="CEP" v-model="address.zipcode">
            </div>

            <div class="col-12 col-md-6">
                <input type="text" class="form-control" placeholder="Cidade" v-model="address.city" @change="addressSave()">
            </div>

            <div class="col-6 col-md-6">
                <input type="text" class="form-control" placeholder="Estado" v-model="address.state" readonly>
            </div>

            <div class="col-6 col-md-6">
                <input type="text" class="form-control" placeholder="Estado" v-model="address.country" readonly>
            </div>
        </div>

        <div class="list-group shadow-sm" v-if="results.length>0">
            <a href="javascript:;" class="list-group-item" v-for="r in results" @click="objectToAddress(r); results=[];">
                {{ [r.address.road, r.address.suburb, r.address.city, r.address.state].filter(value => !!value).join(', ') }}
            </a>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: [Number, String],
    },

    watch: {
        value(value) {
            this.propsValue = value;
            this.addressLoad();
        },
    },

    data() {
        return {
            propsValue: this.value,
            address: {
                name: "",
                route: "",
                number: "",
                complement: "",
                zipcode: "",
                district: "",
                city: "",
                state: "",
                st: "",
                country: "",
                co: "",
                lat: "",
                lng: "",
            },
            results: [],
        };
    },

    methods: {
        emitValue() {
            this.$emit('input', this.propsValue);
            this.$emit('value', this.propsValue);
            this.$emit('change', this.propsValue);
        },

        addressLoad() {
            let id = +this.propsValue;
            if (! id) return;
            this.$axios.get(`/api/addresses/find/${id}`).then(resp => {
                this.address = resp.data;
            });
        },

        addressSave() {
            this.$axios.post('/api/addresses/save', this.address).then(resp => {
                this.address = resp.data;
                this.propsValue = resp.data.id;
                this.emitValue();
            });
        },

        objectToAddress(addr) {
            this.address.route = addr.address.road;
            this.address.number = '';
            this.address.complement = '';
            this.address.zipcode = addr.address.postcode || '';
            this.address.district = addr.address.suburb || '';
            this.address.city = addr.address.city || '';
            this.address.state = addr.address.state || '';
            this.address.st = '';
            this.address.country = addr.address.country || '';
            this.address.co = addr.address.country_code || '';
            this.address.lat = addr.lat;
            this.address.lng = addr.lon;
            this.addressSave();
        },

        searchAddressBy(field='route') {
            let fieldValue = this.address[field] || '';
            this.$axios.get(`https://nominatim.openstreetmap.org/search.php?format=json&addressdetails=1&extratags=1&namedetails=1&limit=10&q=${fieldValue}`).then(resp => {
                this.results = resp.data;
            });
        },
    },

    mounted() {
        this.addressLoad();
    },
}
</script>