// IndexComponent.vue

<template>
    <div>
        <h1>Clients</h1>
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <router-link :to="{ name: 'createClient' }" class="btn btn-primary">Create Client</router-link>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <button class="btn btn-dark" @click.prevent="download()">Export PDF</button>
            </div>
        </div><br />

        <table class="table table-hover" id="my-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Client Nom</th>
                <th>Client Prenom</th>
                <th>Client Adresse</th>
                <th>Client Genre</th>
                <th>Client Telephone</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="client in clients" :key="client.id">
                <td>{{ client.id }}</td>
                <td>{{ client.nom }}</td>
                <td>{{ client.prenom  }}</td>
                <td>{{ client.adresse  }}</td>
                <td>{{ client.genre  }}</td>
                <td>{{ client.telephone  }}</td>
                <td><router-link :to="{name: 'editClient', params: { id: client.id }}" class="btn btn-primary">Edit</router-link></td>
                <td><button class="btn btn-danger" @click.prevent="deleteClient(client.id)">Delete</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import jsPDF from "jspdf"
    import autoTable from 'jspdf-autotable'
    export default {
        data() {
            return {
                clients: []
            }
        },
        mounted() {
            console.log('Client Index Component')
        },
        created() {
            let uri = 'http://localhost:8000/api/client/all';
            this.axios.get(uri).then(response => {
                this.clients = response.data.data;
            });
        },
        methods: {
            deleteClient(id)
            {
                let uri = `http://localhost:8000/api/client/delete/${id}`;
                this.axios.delete(uri).then(response => {
                    this.clients.splice(this.clients.indexOf(id), 1);
                });
            },
            download()
            {
                var columns = [
                    {title: "ID", dataKey: "id"},
                    {title: "Client Nom", dataKey: "nom"},
                    {title: "Client Prenom", dataKey: "prenom"},
                    {title: "Client Adresse", dataKey: "adresse"},
                    {title: "Client Genre", dataKey: "genre"},
                    {title: "Client Telephone", dataKey: "telephone"},
                ];
                const doc = new jsPDF()
                doc.text('Clients List', 40, 20);
                autoTable(doc, { html: '#my-table',columns,
                margin: {top: 30},
            })
                doc.save('clients.pdf');
                }
            },
    }
</script>
