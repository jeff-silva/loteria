<template>
    <div>
        <ui-field label="Foto padrão" layout="horizontal">
            <ui-upload v-model="settings['user.photo_default']"></ui-upload>
        </ui-field>
    </div>
</template>

<script>
export default {
    middleware: 'auth',
    layout: 'admin',

    props: {
        settings: Object,
        settingsGetAll: Function,
        settingsSaveAll: Function,
    },

    data() {
        return {
            propsSettings: JSON.parse(JSON.stringify(this.settings)),
        };
    },
}
</script>