<template>
    <h3> Change car parking status</h3>
    <form method="POST" @submit.prevent="changeStatus(this.selectedCar)">
    <div class="form-group">
        <h4> Client </h4>
    <select required v-model="selectedClass" class="form-control">
        <option disabled value="-1">Select client</option>
        <option v-for="client in clients" :key="client.client_id" :value="client.client_id"> {{client.client_id}}. {{client.full_name}}</option>
    </select>
    </div>
    <div class="form-group">
        <h4> Client car</h4>
    <select required v-model="selectedCar" class="form-control">
        <option value="-1" disabled> Select car</option>
        <option v-for="car in cars" :key="car.car_id" :value="car.car_id">{{car.car_id}}: {{car.color}} {{car.brand}} {{car.model}} {{car.plate_num}} {{car.on_parking ? "On parking" : "Not on parking"}}</option>
    </select>
    </div>
        <br><button type="submit" class="btn btn-warning">Change car status</button>
    </form>
</template>
<script>
export default {
    data(){
        return{
            clients: {},
            cars:{},
            selectedClass: '-1',
            selectedCar:'-1'
        }
    },
    mounted() {
        axios.get('/api/clients').then(
            response =>{
                this.clients = response.data.data;
            }
        )
    },
    watch : {
        selectedClass : function (value){
            axios.post('/allCars/fetch',{value: value,}).then(response =>{
                console.log(response);
                this.cars = response.data;
            }).catch(error=> {


                this.errors = error.response.data.errors;
                console.log(this.errors);
            })}
    },
}
</script>
