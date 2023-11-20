<template>
    <div>
        <h1>Search Ticket</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Etat :</label>
                    <select class="form-control" v-model="state">
                        <option v-for="etat in etats" v-bind:value="etat"> {{ etat | etatFilter }}</option>
                    </select>
                </div>
            </div>
        </div>
        <br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Numero Serie</th>
                <th>Ticket Prix</th>
                <th>Ticket Etat</th>
                <th>Date Consommation</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="ticket in filtredTickets" :key="ticket.n_serie">
                <td>{{ ticket.n_serie }}</td>
                <td>{{ ticket.prix }}</td>
                <td>{{ ticket.etat | etatFilter }}</td>
                <td>{{ ticket.date_consommation  }}</td>
                <td><router-link :to="{name: 'editTicket', params: { n_serie: ticket.n_serie }}" class="btn btn-primary">Edit</router-link></td>
                <td><button class="btn btn-danger" @click.prevent="deleteTicket(ticket.n_serie)">Delete</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "SearchTicket",
        data() {
            return {
                tickets: [],
                etats : [true , false],
                state : ''
            }
        },
        methods : {
            searchAchat()
            {

            },
            deleteTicket(n_serie)
            {
                let uri = `http://localhost:8000/api/ticket/delete/${n_serie}`;
                this.axios.delete(uri).then(response => {
                    this.tickets.splice(this.tickets.indexOf(n_serie), 1);
                });
                this.ticketsAll();
            },
        },
        created() {
            let uri = 'http://localhost:8000/api/ticket/all';
            this.axios.get(uri).then(response => {
                this.tickets = response.data.data;
            });
        },
        computed: {
            filtredTickets : function () {
                return this.tickets.filter((ticket) =>{
                    return ticket.etat == this.state;
                });
            }
        }
    }
</script>

<style scoped>

</style>
