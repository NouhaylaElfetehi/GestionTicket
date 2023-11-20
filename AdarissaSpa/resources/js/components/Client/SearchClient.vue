<template>
    <div>
        <h1>Search Client</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Client name :</label>
                    <input type="text" class="form-control" placeholder="Search Client Nom" v-model="search">
                    <label>Client prenom :</label>
                    <input type="text" class="form-control" placeholder="Search Client Prenom" v-model="search2">
                </div>
            </div>
        </div><br />

        <table class="table table-hover">
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
            <tr v-for="client in filtredClients" :key="client.id">
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
    export default {
        name: "SearchClient",
        data() {
            return {
                clients: [],
                search2 : '',
                search : ''
            }
        },
        created() {
            let uri = 'http://localhost:8000/api/client/all';
            this.axios.get(uri).then(response => {
                this.clients = response.data.data;
            });
        },
        computed: {
            filtredClients : function () {
                return this.clients.filter((client) =>{
                    return client.nom.startsWith(this.search) && client.prenom.startsWith(this.search2)
                    });
            }
        }
        ,
        methods : {
            deleteClient(id)
            {
                let uri = `http://localhost:8000/api/client/delete/${id}`;
                this.axios.delete(uri).then(response => {
                    this.clients.splice(this.clients.indexOf(id), 1);
                });
            },
        }
    }
</script>

<style scoped>

</style>
