<template>
    <h3> Add new car</h3>
    <form method="POST" @submit.prevent="newCar">
        <h4>Brand</h4>
        <input type="text" required name="brand" id="brand" v-model="newCarfields.brand" class="form-control">
        <div class="alert alert-danger" v-if="errors && errors.brand">{{errors.brand[0]}}</div>
        <h4>Model</h4>
        <input type="text" required name="model" id="model" v-model="newCarfields.model" class="form-control">
        <div class="alert alert-danger" v-if="errors && errors.model">{{errors.model[0]}}</div>
        <h4>Color</h4>
        <input type="text" required name="color" v-model="newCarfields.color" id="color" class="form-control">
        <div class="alert alert-danger" v-if="errors && errors.color">{{errors.color[0]}}</div>
        <h4>Licence plate number</h4>
        <input type="text"  placeholder="Unique" v-model="newCarfields.plate_num" required name="plate_num" id="plate_num" class="form-control">
        <div class="alert alert-danger" v-if="errors && errors.plate_num">{{errors.plate_num[0]}}</div>
        <h4>At parking?</h4>
        <select required class="form-select" name="on_parking" v-model="newCarfields.on_parking" id="on_parking">
            <option value="1">In</option>
            <option value="0">Out</option>
        </select>
        <input type="hidden" required class="form-control" name="client_id" id="client_id" v-model="newCarfields.client_id">
        <br><button type="submit" class="btn btn-warning">Send your form</button>
        <div class="alert alert-success" v-if="success && success=='Car added successfully!'">{{success}}</div>
    </form>
</template>
<script>
export default{
    data(){
        return{
            errors:{},
            success:'',
            newCarfields:{client_id:this.mydata[0][0]['client_id']},
        }
    },
    props:['mydata'],
    methods:{
        newCar(){
            axios.post('/api/cars', this.newCarfields).then(response=>{
                this.success = "Car added successfully!";
                this.newCarfields = {client_id:this.mydata[0][0]['client_id']};
                this.errors = {};
                window.location.reload();
            }).catch(error=>{
                console.log(this.newCarfields);
                console.log(this.errors);
                if(error.response.status == 422){
                    this.errors = error.response.data.errors;
                }
            })
        },
    }
}

</script>
