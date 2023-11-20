<template>
    <div>
        <h1>Generate a Ticket</h1>
        <form @submit.prevent="generateTicket">
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
                        <label>Prix :</label>
                        <input class="form-control" v-model="ticket.prix" >
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
            <br />
            <div class="form-group">
                <button class="btn btn-primary">Generate Ticket</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "CreateTicket.vue",
        data(){
            return {
                ticket:{},
                achat:{}
            }
        },
        mounted() {
            console.log('Ticket Create Component')
        },
        methods: {
            generateTicket(){
                this.addTicket()
                this.addAchat()
            },
            addTicket() {
                let uri = 'http://localhost:8000/api/ticket/create';
                this.axios.post(uri, this.ticket);
            },
            addAchat() {
                let uri = 'http://localhost:8000/api/achat/create';
                this.axios.post(uri, this.achat).then((response) => {
                    this.$router.push({name: 'tickets'});
                });
            }
            ,
            getClient() {
                let uri = `http://localhost:8000/api/ticket/edit/${this.$route.params.id}`;
                this.axios.get(uri).then((response) => {
                    this.client = response.data;
                });
            },
        }
    }

</script>

<style scoped>

</style>
