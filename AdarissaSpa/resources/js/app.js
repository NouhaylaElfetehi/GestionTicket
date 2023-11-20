require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
//import VueSidebarMenu from 'vue-sidebar-menu';

Vue.use(VueRouter);
//Vue.use(VueSidebarMenu);

//Filters
Vue.filter('etatFilter',function(value){
    if (value == true){
        return 'Consommé'
    }else{
        return 'Non Consommé'
    }
});

import VueAxios from 'vue-axios';
import axios from 'axios';
import App from './App.vue';

Vue.use(VueAxios, axios);

import HomeComponent from './components/Client/HomeComponent.vue';
import CreateComponent from './components/Client/CreateComponent.vue';
import IndexComponent from './components/Client/IndexComponent.vue';
import EditComponent from './components/Client/EditComponent.vue';
import CreateTicket from "./components/Ticket/CreateTicket";
import EditTicket from "./components/Ticket/EditTicket";
import IndexTicket from "./components/Ticket/IndexTicket";
import IndexAchat from "./components/Achat/IndexAchat";
import CreateAchat from "./components/Achat/CreateAchat";
import EditAchat from "./components/Achat/EditAchat";
import SearchClient from "./components/Client/SearchClient";
import SearchAchat from "./components/Achat/SearchAchat";
import SearchTicket from "./components/Ticket/SearchTicket";
import CheckTicket from "./components/Ticket/CheckTicket";


const routes = [
    {
        name: 'home',
        path: '/home',
        component: HomeComponent
    },
    {
        name: 'createClient',
        path: '/client/create',
        component: CreateComponent
    },
    {
        name: 'clients',
        path: '/client/all',
        component: IndexComponent
    },
    {
        name: 'editClient',
        path: '/client/edit',
        component: EditComponent
    }
    ,
    {
        name: 'searchClient',
        path: '/client/search',
        component: SearchClient
    }
    ,
    {
        name: 'createTicket',
        path: '/ticket/create',
        component: CreateTicket
    },
    {
        name: 'tickets',
        path: '/ticket/all',
        component: IndexTicket
    },
    {
        name: 'editTicket',
        path: '/ticket/edit',
        component: EditTicket
    },
    {
        name: 'searchTicket',
        path: '/ticket/search',
        component: SearchTicket
    },
    {
        name: 'checkTickett',
        path: '/ticket/check',
        component: CheckTicket
    },
    {
        name: 'createAchat',
        path: '/achat/create',
        component: CreateAchat
    },
    {
        name: 'editAchat',
        path: '/achat/edit',
        component: EditAchat
    },
    {
        name: 'achats',
        path: '/achat/all',
        component: IndexAchat
    }
    ,
    {
        name: 'searchAchat',
        path: '/achat/search',
        component: SearchAchat
    }
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router },App)).$mount('#app');
