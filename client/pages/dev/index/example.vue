<template>
    <div>
        <div v-if="user">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">Form</div>
                        <div class="card-body">
                            <div class="alert alert-danger">Form error</div>
                    
                            <ui-field label="Nome" layout="horizontal">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <input type="text" class="form-control" v-model="user.name.first" @input="generateBio()">
                                    </div>
                                    <div class="flex-grow-1 ps-1">
                                        <input type="text" class="form-control" v-model="user.name.last" @input="generateBio()">
                                    </div>
                                </div>
                            </ui-field>
    
                            <ui-field label="E-mail" layout="horizontal">
                                <input type="text" class="form-control" v-model="user.email" @input="generateBio()">
                            </ui-field>
                            
                            <ui-field label="Idade" layout="horizontal">
                                <el-slider v-model="user.dob.age" :min="0" :max="130" @input="generateBio()"></el-slider>
                            </ui-field>
                    
                            <ui-field label="Bio">
                                <textarea class="form-control" rows="8" v-model="user.bio"></textarea>
                            </ui-field>
                        </div>
                        <div class="card-footer text-end">
                            <button type="button" class="btn btn-outline-danger">Deletar</button>
                            <button type="button" class="btn btn">Cancelar</button>
                            <button type="button" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
    
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">Quem sou eu</div>
                        <div class="card-body">
                            <div class="alert alert-success">Success</div>
                            <div style="white-space:break-spaces;">{{ user.bio }}</div>
                            <img :src="user.picture.large" alt="" class="rounded mx-auto mt-4 d-block">
                        </div>
                        <div class="card-header">
                            <button type="button" class="btn btn-primary w-100" @click="getRandomUser()">Recarregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    head() {
        return {
            title: "Exemplo",
        };
    },

    data() {
        return {
            user: false,
        };
    },

    methods: {
        getRandomUser() {
            this.$axios.get('https://randomuser.me/api/').then(resp => {
                this.user = resp.data.results[0];
                this.generateBio();
            });
        },

        generateBio() {
            this.user.bio = [
                `Meu nome é ${this.user.name.first} ${this.user.name.last} e eu tenho ${this.user.dob.age} anos.`,
                `Eu nasci em uma cidade chamada ${this.user.location.city}, no estado de ${this.user.location.state} em ${this.user.location.country}.`,
                `Caso precise falar comigo, pode me encontrar pelo meu celular ${this.user.cell} ou pelo telefone ${this.user.phone}. Também respondo pelo e-mail ${this.user.email}.`,
            ].join("\n\n");
        },
    },

    mounted() {
        this.getRandomUser();
    },
}
</script>