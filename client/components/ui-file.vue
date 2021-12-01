<template>
    <div>
        <div class="d-flex g-0 border">
            <div class="bg-white border-end" style="min-width:200px; max-width:200px;">
                <div class="list-group list-group-flush" v-if="files">
                    <div class="list-group-item list-group-item-primary">Pastas</div>
                    <a href="javascript:;" class="list-group-item" v-for="f in files.folders" @click="filesParams.folder=f.folder; refresh();">
                        /{{ f.folder || '' }}
                    </a>
                </div>
            </div>
            <div class="flex-grow-1 bg-light" style="max-width:100%; overflow:auto;">
                <div class="bg-white p-2 d-flex align-items-center border-bottom">
                    <div>{{ filesParams.folder || '/' }}</div>

                    <div class="flex-grow-1"><div class="btn">&nbsp;</div></div>

                    <div class="ms-1" v-if="props.value.length">
                        <a href="javascript:;" class="btn btn-sm btn-light" @click="props.value=[]; emitValue();">
                            Limpar seleções
                        </a>
                    </div>

                    <div class="ms-1" v-if="props.value.length">
                        <a href="javascript:;" class="btn btn-sm btn-danger" @click="selectedsDelete()">
                            Deletar {{ props.value.length }}
                        </a>
                    </div>
                </div>
    
                <div class="p-2 text-center text-muted py-5" v-if="!files">
                    <i class="fas fa-spin fa-spinner"></i> Carregando...
                </div>
    
                <div class="p-2 text-center text-muted py-5" v-if="files && files.data.length==0">
                    Sem arquivos
                </div>
    
                <div v-if="files">
                    <div v-for="f in files.data" :key="f.id"
                        class="d-inline-flex bg-white shadow-sm m-2"
                        :class="fileClass(f)"
                        style="min-width:150px; max-width:150px; cursor:pointer;"
                    >
                        <div style="width:100%;">
                            <div style="height:150px;" @click.self="selectToggle(f)">
                                <img :src="f.url" :alt="f.name" :title="f.name" :key="f.id" v-if="$helpers.strContains(f.mime, 'image')" style="width:100%; height:100%; object-fit:cover;">
                                <div v-else>{{ f.name }}</div>
                            </div>
        
                            <a href="javascript:;" class="btn btn-sm btn-primary w-100 rounded-0" @click="edit=f">
                                Editar
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white border-top p-2">
                    <el-pagination
                        v-if="files"
                        background
                        :current-page.sync="filesParams.page"
                        :page-size.sync="filesParams.per_page"
                        :total="files.total"
                        layout="prev, pager, next"
                        @size-change="refresh()"
                        @current-change="refresh()"
                        @prev-click="refresh()"
                        @next-click="refresh()"
                    ></el-pagination>
                </div>
            </div>
        </div>

        <!-- Edit -->
        <ui-modal v-model="edit">
            <template #header>Editar</template>
            <template #body>
                <ui-field label="Descrição">
                    <input type="text" class="form-control" v-model="edit.name">
                </ui-field>

                <ui-field label="Pasta">
                    <el-select v-model="edit.folder" class="w-100" filterable allow-create>
                        <el-option value="">Raiz</el-option>
                        <el-option :value="f.folder" v-for="f in files.folders" :key="f.folder">/{{ f.folder || '' }}</el-option>
                    </el-select>
                </ui-field>
            </template>
            <template #footer>
                <button type="button" class="btn btn-danger" @click="selectedsDelete(edit.id)">
                    Deletar
                </button>
                <button type="button" class="btn btn-primary" @click="fileSave()">
                    Salvar
                </button>
            </template>
        </ui-modal>
    </div>
</template>

<script>
export default {
    props: {
        value: {default: () => ([])},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
            filesParams: {
                q: '',
                folder: '',
                page: 1,
                per_page: 20,
            },
            files: false,
            edit: false,
        };
    },

    methods: {
        emitValue() {
            this.$emit('value', this.props.value);
            this.$emit('input', this.props.value);
            this.$emit('change', this.props.value);
        },

        refresh() {
            if (this._refreshing) return;
            this._refreshing = true;

            let params = this.filesParams;
            this.$axios.get('/api/files/search', {params}).then(resp => {
                this.files = resp.data;
                this._refreshing = false;
            });
        },

        selectToggle(file) {
            let index = this.props.value.indexOf(file);
            if (index>=0) { this.props.value.splice(index, 1); }
            else { this.props.value.push(file); }
            this.emitValue();
        },

        selectedsDelete(id=null) {
            this.$confirm(`Deseja deletar ${this.props.value.length} arquivos?`).then(resp => {

                if (this.props.value.length>0) {
                    id = this.props.value.map(file => file.id);
                }

                this.$axios.post('/api/files/remove', {id}).then(resp => {
                    this.refresh();
                    this.props.value = [];
                    this.edit = false;
                });
            });
        },

        fileClass(file) {
            let classes = [];

            if (this.props.value.indexOf(file) >=0) {
                classes.push('border border-primary');
            }
            else {
                classes.push('border border-white');
            }

            return classes;
        },

        fileSave() {
            this.$axios.post('/api/files/save', this.edit).then(resp => {
                this.edit = false;
                this.refresh();
                this.$swal.fire('', 'Arquivo salvo', 'success');
            });
        },
    },

    mounted() {
        this.refresh();
    },
}
</script>