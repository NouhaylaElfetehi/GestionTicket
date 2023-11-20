<template>
    <div>
        <h1>Create Achat</h1>
        <form @submit.prevent="generateTicket">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Client :</label>
                        <select class="form-control" v-model="achat.client_id">
                            <option v-for="client in clients" v-bind:value="client.id" > {{ client.nom }} {{ client.prenom }}</option>
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

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">Generate Ticket :</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Prix :</label>
                                        <input class="form-control" v-model="ticket.prix" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="form-group">
                <button class="btn btn-primary">Generate Ticket</button>
            </div>
        </form>



    </div>
</template>

<script>
    export default {
        name: "CreateAchat",
        data(){
            return {
                achat:{},
                ticket:{},
                clients:[]
            }
        },
        mounted() {
            console.log('Achat Create Component')
        },
        created() {
            this.getClients()
        },
        methods: {
            generateTicket(){
                this.addAchat()
                for (let i = 0; i < this.achat.quantite; i++) {
                    this.addTicket();
                }
            },
            addTicket() {
                let uri = 'http://localhost:8000/api/ticket/create';
                this.axios.post(uri, this.ticket);
            },
            addAchat() {
                let uri = 'http://localhost:8000/api/achat/create';
                this.axios.post(uri, this.achat).then((response) => {
                    this.$router.push({name: 'achats'});
                });
            }
            ,
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
