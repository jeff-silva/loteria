<template>
    <div class="ui-search">
        <form @submit.prevent="searchItems()" @change="searchItems()">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <ui-field label="Buscar por" style="max-width:400px;">
                                <input type="search" class="form-control" v-model="search.params.q" placeholder="Termo">
                            </ui-field>
                        </div>

                        <slot name="search-fields" :loading="search.loading" :params="search.params"></slot>
                    </div>
                </div>
    
                <div class="card-footer d-flex align-items-center">
                    <div class="ms-2">
                        <ui-dropdown>
                            <button type="button" class="btn btn-outline-light">
                                <i class="fas fa-download"></i> Exportar
                            </button>

                            <template #dropdown>
                                <ul class="dropdown-menu show mt-2" aria-labelledby="btnGroupDrop1">
                                    <li v-for="f in ($store.state.env.exportExtensions || [])">
                                        <a :href="url('/export', {format:f.extension})" target="_blank" class="dropdown-item">
                                            {{ f.name }}
                                        </a>
                                    </li>
                                </ul>
                            </template>
                        </ui-dropdown>
                    </div>
                
                    <div class="flex-grow-1"></div>

                    <slot name="search-actions"></slot>

                    <div class="ms-2">
                        <button type="submit" class="btn btn-primary">
                            Buscar
                            <i class="fas fa-spin fa-spinner ms-2" v-if="search.loading"></i>
                            <i class="fas fa-search ms-2" v-else></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <table class="table table-borderless table-striped mb-3">
            <thead>
                <tr>
                    <!-- <th width="50px"></th> -->
                    <slot name="table-header">
                        <th>Item</th>
                    </slot>
                    <th width="50px"></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td :colspan="headersTotal" class="p-0" style="height:3px;">
                        <div class="progress" style="height:3px;" v-if="search.loading">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%;"></div>
                        </div>
                    </td>
                </tr>

                <tr v-if="search.results.data && search.results.data.length==0">
                    <td :colspan="headersTotal">
                        <slot name="table-empty">
                            <small class="d-block text-muted text-center">Nenhum dado</small>
                        </slot>
                    </td>
                </tr>

                <tr v-for="item in (search.results.data || [])">
                    <!-- <td><input type="checkbox"></td> -->
                    <slot name="table-row" :item="item">
                        <td>{{ item }}</td>
                    </slot>
                    <td width="10px">
                        <div class="ui-search-actions" style="position:relative;">
                            <div class="d-flex" style="position:absolute; top:0px; right:0;">
                                <div class="d-flex ui-search-actions-hidden">
                                    <slot name="table-actions" :item="item"></slot>
                                </div>
    
                                <a href="javascript:;" class="btn">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="card">
            <div class="card-footer">
                <el-pagination
                    background
                    layout="prev, pager, next, sizes"
                    :current-page.sync="search.params.page"
                    :page-size.sync="search.params.per_page"
                    :pager-count="11"
                    :total="search.results.total"
                    :page-sizes="[10, 25, 50, 100]"
                    @size-change="searchItems()"
                    @current-change="searchItems()"
                    @prev-click="searchItems()"
                    @next-click="searchItems()"
                ></el-pagination>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        apiBase: {default:''},
        params: Object,
    },

    computed: {
        _apiSearch() {
            return `${this.apiBase}/search`;
        },
    },

    data() {
        return {
            headersTotal: 0,
            search: {
                loading: false,
                params: Object.assign({
                    q: '',
                    page: 1,
                    per_page: 10,
                    orderby: 'id',
                    order: 'desc',
                }, this.$props.params),
                results: {},
            },
        };
    },

    methods: {
        url(path, query={}) {
            query = {...this.search.params, ...query};
            query = Object.keys(query).map(key => key + '=' + query[key]).join('&');
            return this.apiBase+ path.replace(/^\//g, '') +'?'+ query;
        },

        searchItems() {
            this.search.loading = true;
            this.$axios.get(this._apiSearch, {params:this.search.params}).then(resp => {
                this.search.loading = false;

                resp.data.per_page = parseInt(resp.data.per_page);
                resp.data.to = parseInt(resp.data.to);
                resp.data.total = parseInt(resp.data.total);
                
                this.search.results = resp.data;
            });
        },

        orderbyHandleCliek() {
            this.$el.querySelectorAll('th[data-orderby]').forEach(elem => {
                elem.addEventListener('click', ev => {
                    let field = ev.target.dataset.orderby;

                    if (field==this.search.params.orderby) {
                        this.search.params.order = this.search.params.order=='asc'? 'desc': 'asc';
                    }
                    else {
                        this.search.params.orderby = field;
                    }

                    this.searchItems();
                    this.orderbyArrows();
                });
            });
        },

        orderbyArrows() {
            let className = `ui-search-orderby-${this.search.params.order}`;
            this.$el.querySelectorAll('th[data-orderby]').forEach(elem => {
                let elemClass = elem.dataset.orderby==this.search.params.orderby? className: '';
                elem.setAttribute('class', elemClass);
            });
        },
    },

    mounted() {
        this.searchItems();
        this.orderbyHandleCliek();
        this.orderbyArrows();
        this.headersTotal = this.$el.querySelectorAll('thead > tr > *').length;
    },
}
</script>

<style>
.ui-search th[data-orderby] {cursor:pointer !important;}
.ui-search-orderby-asc:after {margin-left:5px; font-family: "Font Awesome 5 Free"; content:"\f0dd";}
.ui-search-orderby-desc:after {margin-left:5px; font-family: "Font Awesome 5 Free"; content:"\f0de";}
.ui-search-actions .btn {width:40px !important; height:40px !important; padding:9px !important; border-radius:50% !important; margin-left:5px;}
.ui-search-actions-hidden {display:none!important;}
.ui-search-actions:hover .ui-search-actions-hidden {display:flex!important;}
</style>