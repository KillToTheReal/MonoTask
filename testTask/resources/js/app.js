require('./bootstrap');
import {createApp} from 'vue'
import CarTable from './components/cartable.vue';
import UserTable from './components/usertable.vue';
const app = createApp({});
app.component('cartable-comp', CarTable);
app.component('usertable-comp',UserTable);
app.mount('#app');