require('./bootstrap');
import {createApp} from 'vue'
import CarTable from './components/cartable.vue';
import UserTable from './components/usertable.vue';
import AddCarForm from './components/addcarform.vue';
import AddClientForm from './components/addclientform.vue';
const app = createApp({});
app.component('cartable-comp', CarTable);
app.component('usertable-comp',UserTable);
app.component('addcar-form', AddCarForm);
app.component('addclient-form',AddClientForm);
app.mount('#app');