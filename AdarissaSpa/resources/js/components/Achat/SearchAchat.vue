<template>
    <div>
        <h1>Search Achat</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Client Nom :</label>
                    <input type="text" class="form-control" placeholder="Search Client Nom" v-model="nom">
                    <label>Client Prénom :</label>
                    <input type="text" class="form-control" placeholder="Search Client Preon" v-model="prenom">
                    <label>Date Achat :</label>
                    <input type="text" class="form-control" placeholder="Search Date achat" v-model="date">
                </div>
            </div>
        </div>
            <td><button class="btn btn-info" @click.prevent="searchAchat()">Search</button></td>
            <br />

        <table class="table table-hover">
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
            <tr v v-for="achat in filtredAchats" :key="achat.id">
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
    export default {
        name: "SearchAchat",
        data() {
            return {
                achats: [],
                date : '',
                nom : '',
                prenom : ''
            }
        },
        methods : {
            searchAchat()
            {
                let uri = 'http://localhost:8000/api/achat/all';
                this.axios.get(uri).then(response => {
                    this.achats = response.data.data;
                });
            },
            deleteAchat(id)
            {
                let uri = `http://localhost:8000/api/achat/delete/${id}`;
                this.axios.delete(uri).then(response => {
                    this.achats.splice(this.achats.indexOf(id), 1);
                });
            }
            ,
        },
        created() {

        },
        computed: {
            filtredAchats : function () {
                return this.achats.filter((achat) =>{
                    return (achat.date_achat > this.date) && (achat.client.nom).match(this.nom) && (achat.client.prenom).match(this.prenom)
                });
            }
        }
    }
</script>

<style scoped>

</style>
