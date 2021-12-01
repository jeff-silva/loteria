<template>
    <transition :enter-active-class="`animate__animated animate__fadeIn${sidename}`" :leave-active-class="`animate__animated animate__fadeOut${sidename}`">
        <div v-if="(isMobile && props.showMobile) || (!isMobile && props.showDesktop)" style="animation-duration:200ms;">
            <slot></slot>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        showDesktop: {default:true},
        showMobile: {default:false},
        side: {default:'left'},
        storeid: [Boolean, String],
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = JSON.parse(JSON.stringify(value));
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
            isMobile: false,
        };
    },

    computed: {
        sidename() {
            return this.side.charAt(0).toUpperCase() + this.side.slice(1);
        },
    },

    methods: {
        toggleDesktop() {
            this.props.showDesktop = !this.props.showDesktop;
            this.setStore('showDesktop');
        },

        toggleMobile() {
            this.props.showMobile = !this.props.showMobile;
            this.setStore('showMobile');
        },

        setStore(name) {
            if (!this.storeid || !name) return;
            let value = this.props[name]? '1': '';
            localStorage.setItem(`ui-sidebar-${this.storeid}-${name}`, value);
        },

        resizeHandle() {
            this.isMobile = window.innerWidth <= 768;
        },
    },

    beforeDestroy() {
        window.removeEventListener('resize', this.resizeHandle);
    },

    mounted() {
        this.resizeHandle();
        window.addEventListener('resize', this.resizeHandle);

        if (this.storeid) {
            this.props.showDesktop = !!localStorage.getItem(`ui-sidebar-${this.storeid}-showDesktop`);
            this.props.showMobile = !!localStorage.getItem(`ui-sidebar-${this.storeid}-showMobile`);
        }
    },
}
</script>
