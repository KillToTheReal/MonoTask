<template>
    <form method="POST" @submit.prevent="submit">

        <h4>Brand</h4>
        <input type="text" required name="brand" id="brand" v-model="fields.brand" class="form-control">
        
        <h4>Model</h4>
        <input type="text" required name="model" id="model" v-model="fields.model" class="form-control">
        
        <h4>Color</h4>
        <input type="text" required name="color" v-model="fields.color" id="color" class="form-control">
        
        <h4>Licence plate number</h4>
        <input type="text"  placeholder="Unique" v-model="fields.plate_num" required name="plate_num" id="plate_num" class="form-control">
        
        <h4>At parking?</h4>
        <select required class="form-select" name="on_parking" v-model="fields.on_parking" id="on_parking">
            <option value="1">In</option>
            <option value="0">Out</option>
        </select>

        <h4> Owner </h4>
        <select required class="form-select" name="client_id" id="client_id" v-model="fields.client_id">
            <option selected v-for="client in clients" :key="client" :value="client.client_id">{{client.full_name}} - ID:{{client.client_id}}</option>
        </select>
        
        <br><button type="submit" class="btn btn-warning">Send your form</button>
    </form>
</template>
<script>
export default {
    data()
    {
        return{
            fields:{}
        }
    },
    props:['clients'],

    methods:{
        submit(){
            axios
        }
    }
}
</script>
