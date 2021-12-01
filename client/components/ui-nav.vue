<template>
    <div class="ui-nav">
        <el-menu :default-active="propsValue" :mode="mode"
            @select="emitValue($event)" background-color="transparent"
            :text-color="textColor" :active-text-color="textColor"
            :unique-opened="true"
        >
            <template v-for="(m, i) in items">
                <el-menu-item :index="''+i" v-if="(m.children||[]).length==0">
                    <nuxt-link :to="m.to||''">
                        <i :class="`${m.icon||''} fa-fw me-2`" v-if="icons"></i>
                        {{ m.label || 'label' }}
                    </nuxt-link>
                </el-menu-item>
    
                <el-submenu :index="''+i" popper-class="ui-nav-submenu" v-else>
                    <template slot="title">
                        <i :class="`${m.icon||''} fa-fw me-2`" v-if="icons"></i>
                        {{ m.label || 'label' }}
                    </template>
    
                    <template v-for="(mm, ii) in m.children">
                        <el-menu-item :index="`${i}-${ii}`" v-if="(mm.children||[]).length==0">
                            <nuxt-link :to="mm.to||''">
                                <i :class="`${mm.icon||''} fa-fw me-2`" v-if="icons"></i>
                                {{ mm.label || 'label' }}
                            </nuxt-link>
                        </el-menu-item>
    
                        <el-submenu :index="`${i}-${ii}`" popper-class="ui-nav-submenu" v-else>
                            <template slot="title">
                                <i :class="`${mm.icon||''} fa-fw me-2`" v-if="icons"></i>
                                {{ mm.label || 'label' }}
                            </template>
    
                            <template v-for="(mmm, iii) in mm.children">
                                <el-menu-item :index="`${i}-${ii}-${iii}`">
                                    <nuxt-link :to="mmm.to||''">
                                        <i :class="`${mmm.icon||''} fa-fw me-2`" v-if="icons"></i>
                                        {{ mmm.label || 'label' }}
                                    </nuxt-link>
                                </el-menu-item>
                            </template>
                        </el-submenu>
                    </template>
                </el-submenu>
            </template>
        </el-menu>
    </div>    
</template>

<script>
export default {
    props: {
        value: {default:''},
        items: Array,
        mode: {default:'horizontal'},
        textColor: {default:'#444'},
        icons: {default:true},
    },

    watch: {
        value(value) {
            this.propsValue = value;
        },
    },

    data() {
        return {
            propsValue: this.value,
        };
    },

    methods: {
        emitValue(ev) {
            this.propsValue = ev;
            this.$emit('value', this.propsValue);
            this.$emit('input', this.propsValue);
            this.$emit('change', this.propsValue);
        },
    },
}
</script>

<style>
.ui-nav .el-menu {border: none !important;}
.ui-nav .el-menu-item:hover, .ui-nav .el-submenu__title:hover {background: none !important;}
.ui-nav a, .ui-nav i {color: inherit !important; text-decoration: none !important;}
.ui-nav-submenu {background: #fff !important;}
.ui-nav-submenu .el-menu-item, .ui-nav-submenu .el-submenu__title {background: none !important; color: #666 !important;}
.ui-nav-submenu a, .ui-nav-submenu i {color: inherit !important; text-decoration: none !important;}
.ui-nav a {display: block !important;}
</style>