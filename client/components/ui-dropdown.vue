<template>
    <div style="position:relative;">
        <slot></slot>

        <transition enter-active-class="animate__animated animate__fadeIn" leave-active-class="animate__animated animate__fadeOut">
            <div v-if="props.value" style="animation-duration:200ms; z-index:9;" :class="{'ui-dropdown-content':true, 'ui-dropdown-content-right':props.right, 'ui-dropdown-content-top':props.top}">
                <slot name="dropdown"></slot>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    props: {
        value: {default:false},
        top: {default:false},
        right: {default:false},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        toggle() {
            this.props.value = !this.props.value;
        },
    },

    mounted() {
        document.addEventListener('click', ev => {
            this.props.value = this.$el.contains(ev.target);
        });
    },
}
</script>

<style>
.ui-dropdown-content {position:absolute; width:100%;}

.ui-dropdown-content.ui-dropdown-content-right {right:0;}
.ui-dropdown-content.ui-dropdown-content-right > * {position:absolute; right:0;}

.ui-dropdown-content.ui-dropdown-content-top {bottom:100%;}
.ui-dropdown-content.ui-dropdown-content-top > * {position:absolute; bottom:100%;}
</style>