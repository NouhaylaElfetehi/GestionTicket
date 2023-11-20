export default {
    data(){
        return {
            client:{},
            genres : ['Homme','Femme']
        }
    },
    mounted() {
        console.log('Client Create Component')
    },
    methods: {
        addClient() {
            let uri = 'http://localhost:8000/api/client/create';
            this.axios.post(uri, this.client).then((response) => {
                this.$router.push({name: 'clients'});
            });
        }
    }
}
