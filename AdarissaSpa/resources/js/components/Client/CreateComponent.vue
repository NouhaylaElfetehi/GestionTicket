// CreateComponent.vue
<template>
    <div>
        <h1>Create A Client</h1>
        <form @submit.prevent="addClient">
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
                        <label>Genre :</label>
                        <select class="form-control" v-model="client.genre">
                            <option v-for="genre in genres" v-bind:value="genre" > {{ genre }} </option>
                        </select>
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
            <br />
            <div class="form-group">
                <button class="btn btn-primary">Create Client</button>
            </div>
        </form>
    </div>
</template>

<script src ="./CreateClient.js"></script>
