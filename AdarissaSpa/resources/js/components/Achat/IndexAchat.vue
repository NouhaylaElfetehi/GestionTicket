<template>
    <div>
        <h1>Achats</h1>
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
                <th>ID</th>
                <th>Client Full Name</th>
                <th>Type</th>
                <th>Quantite</th>
                <th>Date Achat</th>
                <th>Date Expiration</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v v-for="achat in achats" :key="achat.id">
                <td>{{ achat.id }}</td>
                <td>{{ achat.client.nom }} {{ achat.client.prenom }}</td>
                <td>{{ achat.type }}</td>
                <td>{{ achat.quantite }}</td>
                <td>{{ achat.date_achat  }}</td>
                <td>{{ achat.date_expiration  }}</td>
                <td><router-link :to="{name: 'editAchat', params: { id: achat.id }}" class="btn btn-primary">Edit</router-link></td>
                <td><button class="btn btn-danger" @click.prevent="deleteAchat(achat.id)">Delete</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import jsPDF from "jspdf";
    import autoTable from "jspdf-autotable";

    export default {
            name: "IndexAchat",
            data() {
                return {
                    achats: [],
                    client: {}
                }
            },
            mounted() {
                console.log('Achat Index Component')
            },
            created() {
                let uri = 'http://localhost:8000/api/achat/all';
                this.axios.get(uri).then(response => {
                    this.achats = response.data.data;
                });
            },
            methods: {
                deleteAchat(id)
                {
                    let uri = `http://localhost:8000/api/achat/delete/${id}`;
                    this.axios.delete(uri).then(response => {
                        this.achats.splice(this.achats.indexOf(id), 1);
                    });
                }
                ,
                getClient(id) {
                    let uri = `http://localhost:8000/api/client/edit/${id}`;
                    this.axios.get(uri).then((response) => {
                        this.client = response.data;
                    });
                },
                download()
                {
                    var columns = [
                        {title: "ID", dataKey: "id"},
                        {title: "Client Full Name", dataKey: ["client.nom","client.prenom"]},
                        //{title: "Client Prenom", dataKey: "prenom"},
                        {title: "Quantite", dataKey: "quantite"},
                        {title: "Achat Type", dataKey: "type"},
                        {title: "Date Achat", dataKey: "date_achat"},
                        {title: "Date Expiration", dataKey: "date_expiration"},
                    ];
                    const doc = new jsPDF()
                    doc.text('Achats List', 40, 20);
                    autoTable(doc, { html: '#my-table',columns,
                        margin: {top: 30},
                    })
                    doc.save('achats.pdf');
                }
            },
            filters: {
                clientFilter: function(valeur) {
                    this.getClient(valeur)
                    return client.nom;
            }
        }
    }
</script>

<style scoped>

</style>
