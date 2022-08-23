import addcarinclient from "./components/addcarinclient";

require('./bootstrap');
import {createApp} from 'vue'
import CarTable from './components/cartable.vue';
import UserTable from './components/usertable.vue';
import AddCarForm from './components/addcarform.vue';
import AddClientForm from './components/addclientform.vue';
import Updateuserform from "./components/updateuserform.vue";
import Addcarinclient from "./components/addcarinclient.vue";
import dependentselect from "./components/dependentselect.vue";
import infinitescroll from "./components/infinitescroll.vue";

const app = createApp({});
app.component('cartable-comp', CarTable);
app.component('usertable-comp',UserTable);
app.component('addcar-form', AddCarForm);
app.component('addclient-form',AddClientForm);
app.component('updateuser-form',Updateuserform);
app.component('addcarinclient-form',Addcarinclient);
app.component('dependentselect',dependentselect);
app.component('infinitescroll',infinitescroll);
app.mount('#app');
