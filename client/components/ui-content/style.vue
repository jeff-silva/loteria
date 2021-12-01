<template>
    <div>
        <ui-field label="Margin">
            <div class="row g-1">
                <div class="col">top<input type="text" class="form-control" v-model="props.value['margin-top']"></div>
                <div class="col">right<input type="text" class="form-control" v-model="props.value['margin-right']"></div>
                <div class="col">bottom<input type="text" class="form-control" v-model="props.value['margin-bottom']"></div>
                <div class="col">left<input type="text" class="form-control" v-model="props.value['margin-left']"></div>
            </div>
        </ui-field>

        <ui-field label="Padding">
            <div class="row g-1">
                <div class="col">top<input type="text" class="form-control" v-model="props.value['padding-top']"></div>
                <div class="col">right<input type="text" class="form-control" v-model="props.value['padding-right']"></div>
                <div class="col">bottom<input type="text" class="form-control" v-model="props.value['padding-bottom']"></div>
                <div class="col">left<input type="text" class="form-control" v-model="props.value['padding-left']"></div>
            </div>
        </ui-field>
    </div>
</template>

<script>
export default {
    props: {
        value: Object,
    },

    watch: {
        $props: {deep:true, handler(props) {
            if (this._preventReceiveProps) return;
            props = JSON.parse(JSON.stringify(props));
            for(let i in props) this.props[i] = props[i];
        }},

        '$data.props': {deep:true, handler(props) {
            this._preventReceiveProps = true;
            for(let i in props) {
                if (i=='value') {
                    this.$emit('value', props[i]);
                    this.$emit('input', props[i]);
                    this.$emit('change', props[i]);
                    continue;
                }
                this.$emit(`update:${i}`, props[i]);
            }
            setTimeout(() => {
                this._preventReceiveProps = false;
            }, 100);
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },
}
</script>