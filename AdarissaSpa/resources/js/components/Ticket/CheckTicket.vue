<template>
    <div>
        <h1>Ckeck Ticket</h1>
        <form @submit.prevent="checkTicket">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>N-serie :</label>
                        <input type="text" class="form-control" v-model="ticket.n_serie">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Check</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "CheckTicket",
        data(){
            return {
                ticket:{},
            }
        },
        mounted() {
            console.log('Ticket Check Component')
        },
        methods: {
            checkTicket() {
                let uri = `http://localhost:8000/api/ticket/check/${this.ticket.n_serie}`;
                this.axios.post(uri, this.ticket).then((response) => {
                    this.$router.push({name: 'tickets'});
                });
            }
        }
    }
</script>

<style scoped>

</style>
