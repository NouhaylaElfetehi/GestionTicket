<template>
    <div>
        <h1>Edit Achat</h1>
        <form @submit.prevent="updateAchat">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Client :</label>
                        <select class="form-control" v-model="achat.client_id">
                            <option v-for="client in clients" v-bind:value="client.id"> {{ client.nom }} {{ client.prenom }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Type :</label>
                        <input type="text" class="form-control" v-model="achat.type">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Quantité :</label>
                        <input type="text" class="form-control" v-model="achat.quantite">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date Achat :</label>
                        <input class="form-control" v-model="achat.date_achat" >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date Expiration :</label>
                        <input class="form-control" v-model="achat.date_expiration">
                    </div>
                </div>
            </div>

            <br/>
            <div class="form-group">
                <button class="btn btn-primary">Update Achat</button>
            </div>
        </form>


    </div>
</template>

<script>
    export default {
        name: "EditAchat",
        data() {
            return {
                ticket: [],
                achat: {},
                clients: []
            }
        },
        mounted() {
            console.log('Achat Edit Component')
        },
        created() {
            let uri = `http://localhost:8000/api/achat/edit/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                this.achat = response.data;
            });
            this.getClients()
        },
        methods: {
            updateAchat() {
                let uri = `http://localhost:8000/api/achat/update/${this.$route.params.id}`;
                this.axios.post(uri, this.achat).then((response) => {
                    this.$router.push({name: 'achats'});
                });
            },
            getClients() {
                let uri = 'http://localhost:8000/api/client/all';
                this.axios.get(uri).then(response => {
                    this.clients = response.data.data;
                });
            },
        }
    }
</script>

<style scoped>

</style>
