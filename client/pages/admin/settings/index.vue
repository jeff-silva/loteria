<template>
    <div>
        <ui-field label="Nome da aplicação" layout="horizontal">
            <input type="text" class="form-control" v-model="settings['app.name']">
        </ui-field>
        
        <ui-field label="Tempo de autenticação (em minutos)" layout="horizontal">
            <input type="text" class="form-control" v-model="settings['jwt.ttl']">
            <small class="text-muted">Deixe em branco para autenticação infinita</small>
        </ui-field>

        <ui-field label="Tempo de cache (em segundos)" layout="horizontal">
            <div class="input-group">
                <input type="number" class="form-control" v-model="settings['cache.time']">
                <div class="input-group-text">ou</div>
                <select class="form-control" v-model="settings['cache.time']">
                    <option value="">Sem cache</option>
                    <option :value="60">1 minuto</option>
                    <option :value="(60*10)">10 minutos</option>
                    <option :value="(60*30)">30 minutos</option>
                    <option :value="(60*60)">1 hora</option>
                    <option :value="(60*60*6)">6 horas</option>
                    <option :value="(60*60*12)">12 horas</option>
                    <option :value="(60*60*24)">24 horas</option>
                    <option :value="(60*60*24*7)">1 semana</option>
                    <option :value="(60*60*24*15)">2 semanas</option>
                    <option :value="(60*60*24*30)">1 mês</option>
                    <option :value="(60*60*24*30*6)">6 meses</option>
                    <option :value="(60*60*24*365)">1 ano</option>
                </select>
            </div>
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

    head() {
        return {
            title: "Geral",
        };
    },
}
</script>