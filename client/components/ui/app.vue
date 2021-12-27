<template>
    <div class="ui-app">
        <div class="d-flex">

            <!-- Sidebar -->
            <div class="ui-app-sidebar bg-dark text-white d-none d-md-flex" :style="`height:100vh; overflow:auto; min-width:${props.sidebarWidth}; max-width:${props.sidebarWidth};`">
                <slot name="sidebar"></slot>
            </div>
    
            <!-- Content -->
            <div class="flex-grow-1" style="height:100vh; overflow:auto;">
                <div class="ui-app-header shadow-sm">
                    <div class="d-flex align-items-center p-2">
                        <div class="pe-2 d-md-none">
                            <a href="javascript:;" @click="props.sidebar=true">
                                <i class="fa fa-fw fa-bars"></i>
                            </a>
                        </div>
                        <slot name="header"></slot>
                    </div>
                </div>    
    
                <div class="ui-app-content p-3">
                    <slot></slot>
                </div>
            </div>
        </div>

        <!-- Drawer -->
        <el-drawer :visible.sync="props.sidebar" v-bind="{direction:'ltr', showClose:false, withHeader:false, size:sidebarWidth}">
            <div class="ui-app-sidebar bg-dark text-white" style="height:100vh;">
                <slot name="sidebar"></slot>
            </div>
        </el-drawer>
    </div>
</template>

<script>
export default {
    props: {
        sidebarWidth: {default:'200px'},
        sidebar: {default:false},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },
};
</script>
