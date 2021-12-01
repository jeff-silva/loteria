<template>
    <div>
        <ui-search action="/api/users/search" :params="{status:''}">
            <!-- <template #fields="{params}">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <ui-field label="Busca">
                            <input type="text" class="form-control" v-model="params.q">
                        </ui-field>
                    </div>

                    <div class="col-12 col-md-6">
                        <ui-field label="Status">
                            <select class="form-control" v-model="params.status">
                                <option value="">Todos</option>
                                <option value="draft">Rascunho</option>
                                <option value="publish">Publicado</option>
                            </select>
                        </ui-field>
                    </div>
                </div>
            </template> -->

            <template #search-actions>
                <nuxt-link to="/admin/users/new" class="btn btn-success">
                    <i class="fas fa-plus"></i> Criar
                </nuxt-link>
            </template>

            <template #table-header="">
                <th width="50px"></th>
                <th data-orderby="name">Nome</th>
                <th data-orderby="updated_at" width="200px">Alterado em</th>
            </template>

            <template #table-row="{item}">
                <td><img :src="item.photo" alt="" v-if="item.photo" style="width:30px; height:30px; object-fit:cover; border-radius:50%;"></td>
                <td>{{ item.name }}</td>
                <td>{{ item.updated_at }}</td>
            </template>

            <template #table-actions="{item}">
                <nuxt-link :to="`/admin/users/${item.id}`" class="btn btn-primary">
                    <i class="fas fa-fw fa-edit"></i>
                </nuxt-link>

                <nuxt-link :to="`/admin/users/${item.id}`" class="btn btn-danger">
                    <i class="fas fa-fw fa-times"></i>
                </nuxt-link>
            </template>
        </ui-search>
    </div>
</template>

<script>
export default {
    middleware: 'auth',
    layout: 'admin',
}
</script>