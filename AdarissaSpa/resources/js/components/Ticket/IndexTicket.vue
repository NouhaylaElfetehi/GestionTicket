<template>
    <div>
        <h1>Tickets</h1>
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <router-link :to="{ name: 'createAchat' }" class="btn btn-primary">Create Achat</router-link>
            </div>
        </div><br />
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <button class="btn btn-dark" @click.prevent="download()">Export PDF</button>
            </div>
        </div><br />

        <table class="table table-hover" id="my-table">
            <thead>
            <tr>
                <th>Numero Serie</th>
                <th>Achat Id</th>
                <th>Ticket Prix</th>
                <th>Ticket Etat</th>
                <th>Date Consommation</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="ticket in tickets" :key="ticket.n_serie">
                <td>{{ ticket.n_serie }}</td>
                <td>{{ ticket.achat.id }}</td>
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
    import jsPDF from "jspdf";
    import autoTable from "jspdf-autotable";

    export default {
        name: "IndexTicket",
        data() {
            return {
                tickets: []
            }
        },
        mounted() {
            console.log('Ticket Index Component')
        },
        created() {
            let uri = 'http://localhost:8000/api/ticket/all';
            this.axios.get(uri).then(response => {
                this.tickets = response.data.data;
            });
        },
        methods: {
            deleteTicket(n_serie)
            {
                let uri = `http://localhost:8000/api/ticket/delete/${n_serie}`;
                this.axios.delete(uri).then(response => {
                    this.tickets.splice(this.tickets.indexOf(n_serie), 1);
                });
                this.ticketsAll();
            },
            ticketsAll(){
                let uri = 'http://localhost:8000/api/ticket/all';
                this.axios.get(uri).then(response => {
                    this.tickets = response.data.data;
                });
            },
            download()
            {
                var columns = [
                    {title: "Numero Serie", dataKey: "n_serie "},
                    {title: "Ticket Prix", dataKey: "prix"},
                    {title: "Ticket Etat", dataKey: "etat"},
                    {title: "Date Consommation", dataKey: "date_consommation"},
                ];
                const doc = new jsPDF()
                doc.text('Tickets List', 40, 20);
                autoTable(doc, { html: '#my-table',columns,
                    margin: {top: 30},
                })
                doc.save('tickets.pdf');
            }
        },
    }
</script>

<style scoped>

</style>
