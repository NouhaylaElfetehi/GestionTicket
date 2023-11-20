// EditComponent.vue

<template>
    <div>
        <h1>Edit Client</h1>
        <form @submit.prevent="updateClient">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name:</label>
                        <input type="text" class="form-control" v-model="client.nom">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name :</label>
                        <input class="form-control" v-model="client.prenom" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Adresse :</label>
                        <textarea class="form-control" v-model="client.adresse" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone :</label>
                        <input class="form-control" v-model="client.telephone" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Genre :</label>
                        <select class="form-control" v-model="client.genre">
                            <option v-for="genre in genres" v-bind:value="genre" > {{ genre }} </option>
                        </select>
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
                client: {},
                genres: ['Homme','Femme']
            }
        },
        mounted() {
            console.log('Client Edit Component')
        },
        created() {
            let uri = `http://localhost:8000/api/client/edit/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                this.client = response.data;
            });
        },
        methods: {
            updateClient() {
                let uri = `http://localhost:8000/api/client/update/${this.$route.params.id}`;
                this.axios.post(uri, this.client).then((response) => {
                    this.$router.push({name: 'clients'});
                });
            }
        }
    }
</script>
