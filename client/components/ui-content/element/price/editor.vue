<template>
    <div>
        <ui-field label="Largura máxima do card">
            <input type="text" class="form-control" v-model="props.cardMaxWidth">
        </ui-field>

        <button type="button" class="btn btn-primary w-100" @click="pricesAdd()">
            Add.
        </button>

        <el-collapse value="1" accordion>
            <el-collapse-item :name="pindex" v-for="(p, pindex) in props.prices" :key="pindex">
                <template #title>
                    <div class="d-flex align-items-center" style="min-width:200px;">
                        <div class="flex-grow-1 font-weight-bold text-uppercase">
                            {{ p.title || `Item ${pindex}` }}
                        </div>
                        <div>
                            <a href="javascript:;" class="btn btn-sm text-danger" @click="pricesRemove(p)">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </template>

                <ui-field label="Cor background">
                    <div class="input-group">
                        <div class="input-group-text p-0">
                            <el-color-picker v-model="p.backgroundColor" size="mini"></el-color-picker>
                        </div>
                        <input type="text" class="form-control" v-model="p.backgroundColor">
                    </div>
                </ui-field>

                <ui-field label="Cor text">
                    <div class="input-group">
                        <div class="input-group-text p-0">
                            <el-color-picker v-model="p.textColor" size="mini"></el-color-picker>
                        </div>
                        <input type="text" class="form-control" v-model="p.textColor">
                    </div>
                </ui-field>

                <ui-field label="Ribbon">
                    <input type="text" class="form-control" v-model="p.ribbon">
                </ui-field>

                <ui-field label="Título">
                    <input type="text" class="form-control" v-model="p.title">
                </ui-field>

                <ui-field label="Preço">
                    <input type="text" class="form-control" v-model="p.price">
                </ui-field>

                <ui-field label="Subtítulo">
                    <input type="text" class="form-control" v-model="p.subtitle">
                </ui-field>

                <ui-field label="Link texto">
                    <input type="text" class="form-control" v-model="p.linkLabel">
                </ui-field>

                <ui-field label="Link url">
                    <input type="text" class="form-control" v-model="p.linkUrl">
                </ui-field>
                
                <ui-field label="Conteúdo">
                    <ui-code v-model="p.content"></ui-code>
                </ui-field>
            </el-collapse-item>
        </el-collapse>
    </div>
</template>

<script>
export default {
    props: {
        cardMaxWidth: {default:'100%'},
        prices: Array,
    },

    watch: {
        $props: {deep:true, handler(props) {
            if (this.$el.contains(window.document.activeElement)) return;
            if (this._preventReceiveProps) return;
            props = JSON.parse(JSON.stringify(props));
            for(let i in props) this.props[i] = props[i];
        }},

        props: {deep:true, handler(props) {
            this._preventReceiveProps = true;
            setTimeout(() => {
                for(let i in props) {
                    if (i=='value') {
                        console.log(i, props[i]);
                        this.$emit('value', props[i]);
                        this.$emit('input', props[i]);
                        this.$emit('change', props[i]);
                        continue;
                    }
                    this.$emit(`update:${i}`, props[i]);
                }
                this._preventReceiveProps = false;
            }, 100);
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        pricesAdd() {
            this.props.prices.push({
                textColor: '#ffffff',
                backgroundColor: ('#'+ (Math.random() * 0xfffff * 1000000).toString(16).slice(0, 6)),
                ribbon: '',
                title: `Opção ${this.props.prices.length+1}`,
                price: `R$ ${100*(this.props.prices.length+1)}`,
                subtitle: 'Subtítulo',
                linkUrl: '',
                linkLabel: 'Ver mais',
                content: `<div>\n\t<strong>Atributo</strong>\n\t<span>Valor</span>\n</div>`,
            });
        },

        pricesRemove(price) {
            this.$swal.fire('', 'Deseja deletar este item?', 'warning').then(resp => {
                if (! resp.isConfirmed) return;
                let index = this.props.prices.indexOf(price);
                this.props.prices.splice(index, 1);
            });
        },
    },
}
</script>