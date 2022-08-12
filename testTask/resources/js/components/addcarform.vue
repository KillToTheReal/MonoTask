<template>
    <form method="POST" @submit.prevent="submit">
        <h4>Brand</h4>
        <input type="text" required name="brand" id="brand" v-model="fields.brand" class="form-control">
        <div class="alert alert-danger" v-if="errors && errors.brand">{{errors.brand[0]}}</div>
        <h4>Model</h4>
        <input type="text" required name="model" id="model" v-model="fields.model" class="form-control">
         <div class="alert alert-danger" v-if="errors && errors.model">{{errors.model[0]}}</div>
        <h4>Color</h4>
        <input type="text" required name="color" v-model="fields.color" id="color" class="form-control">
         <div class="alert alert-danger" v-if="errors && errors.color">{{errors.color[0]}}</div>
        <h4>Licence plate number</h4>
        <input type="text"  placeholder="Unique" v-model="fields.plate_num" required name="plate_num" id="plate_num" class="form-control">
         <div class="alert alert-danger" v-if="errors && errors.plate_num">{{errors.plate_num[0]}}</div>
        <h4>At parking?</h4>
        <select required class="form-select" name="on_parking" v-model="fields.on_parking" id="on_parking">
            <option value="1">In</option>
            <option value="0">Out</option>
        </select>

        <h4> Owner </h4>
        <select required class="form-select" name="client_id" id="client_id" v-model="fields.client_id">
            <option selected v-for="client in clients" :key="client" :value="client.client_id" >{{client.full_name}} - ID:{{client.client_id}}</option>
        </select>
        
        <br><button type="submit" class="btn btn-warning">Send your form</button>
        <div class="alert alert-success" v-if="success">{{success}}</div>
    </form>
</template>
<script>
export default {
    data()
    {  
        return{
            
            fields:{},
            cars:null,
            success: null,
            errors:{},
        }
    },

    mounted() {
        axios.get('api/cars').then(response=>{
            this.cars = response.data.data});
    },

    props:['clients'],
    

    methods:{
        submit(){
           axios.post('api/cars', this.fields).then(response=>{
            this.success = "Car added succesfully!";
            this.fields = {};
            this.errors = {};
           }).catch(error=>{
            console.log(this.fields);
            if(error.response.status == 422){
                this.errors = error.response.data.errors;
            }
            console.log(this.errors);
           })
        }
    }
}
</script>
