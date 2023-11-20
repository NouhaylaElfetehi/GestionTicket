<template>
    <div>
        <h1>Edit a Ticket</h1>
        <form @submit.prevent="updateTicket">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Prix :</label>
                        <input class="form-control" v-model="ticket.prix" >
                    </div>
                </div>
            </div>
            <br />
            <div class="form-group">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ticket: {},
                achat: {}
            }
        },
        mounted() {
            console.log('Ticket Edit Component')
        },
        created() {
            let uri = `http://localhost:8000/api/ticket/edit/${this.$route.params.n_serie}`;
            this.axios.get(uri).then((response) => {
                this.ticket = response.data;
            });
        },
        methods: {
            updateTicket() {
                let uri = `http://localhost:8000/api/ticket/update/${this.$route.params.n_serie}`;
                this.axios.post(uri, this.ticket).then((response) => {
                    this.$router.push({name: 'tickets'});
                });
            }
        }
    }
</script>

<style scoped>

</style>
