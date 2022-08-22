<template>

    <h3>Change car parking status</h3>
    <form method="POST" @submit.prevent="changeStatus(value=this.selectedCar)">
        <h4>Client</h4>
        <Multiselect v-model="selectedClient" :searchable="true" placeholder="Select client" :required="true" :options="clientOptions"></Multiselect>
        <h4>Client Car</h4>
        <Multiselect v-model="selectedCar" :searchable="true" placeholder="Select car" :required="true" :options="carOptions"></Multiselect>
        <br>
        <button type="submit" class="btn btn-warning">Change car status</button>
    </form>

</template>
<script>
import Multiselect from "@vueform/multiselect";
export default {
    components: { Multiselect },
    data() {
        return {

            clients: {},
            clientOptions: {},
            cars: {},
            carOptions: {},
            selectedClient: '',
            selectedCar: '',
            errors:{}
        }
    },
    mounted() {
        axios.get('/api/clients').then(
            response => {
                this.clients = response.data.data;
                const clients = this.clients;
                let options = {};
                Object.keys(clients).forEach(function(key, index) {
                    let id = clients[key]['client_id'];
                    let name = clients[key]['full_name'];
                    let value = id + " " + name;
                    options[id] = value;
                });
                this.clientOptions = options;
            });
    },
    watch: {
        selectedClient:function (value){
            axios.post('/allCars/fetch',{value:value}).then(response=>{
                console.log(response);
                let val = response.data;
                let cars = {};
                Object.keys(val).forEach(function(key, index) {
                    let id = val[key]['car_id'];
                    let color = val[key]['color'];
                    let plate = val[key]['plate_num'];
                    let brand = val[key]['brand'];
                    let onp = val[key]['on_parking'] ? "On parking" : "Not on parking";
                    let value = id + '. '+color +' ' + brand + " " + plate + " " + onp;
                    cars[id] = value;
                });
                this.selectedCar = '';
                this.carOptions = cars;
            }).catch(error=>{
                console.log(error.response.data.errors);
            })
        }
    },
    methods: {
       changeStatus(value){
            axios.post('/changeParking',{car_id:value}).then(response=>{
                this.selectedCar = '';
                window.location.reload();
            }).catch(error=>{
                console.log(error);
            });
       },
    }
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

