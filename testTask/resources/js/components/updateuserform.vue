<template>
    <h1>Update client</h1>
    <form method="POST" @submit.prevent="submitUser" class="bg-6 md-6 sm-6">
        <h4>Full name </h4>
            <input type = "hidden" v-model="user.client_id" name="client_id" id = "client_id">
            <input  type="text" v-model="user.full_name" placeholder="3 characters min" required name = "full_name" id ="name" class="form-control">
            <div class="alert alert-danger" v-if="errors && errors['user.full_name']">{{errors['user.full_name'][0]}}</div>
        <h4>Phone number</h4>
        <input type = "tel" v-model="user.phone_num" placeholder="Format: +78005553535, unique" required name = "phone_num" id ="phone" class="form-control">
        <div class="alert alert-danger" v-if="errors && errors['user.phone_num']">{{errors['user.phone_num'][0]}}</div>
        <h4>Gender </h4>
        <select class="form-select" v-model="user.gender" required name="gender" id="gender">
            <option value="1">Male</option>
            <option value="0">Female</option>
        </select>
        <h4>Address </h4>
        <input type="text" v-model="user.address" placeholder="Optional" required name = "address" id ="address" class="form-control">
        <div class="alert alert-danger" v-if="errors && errors['user.address']">{{errors['user.address'][0]}}</div>
                        <br><button  type="submit" class="btn btn-warning">Update client data</button>
    </form>
    <div class="alert alert-success" v-if="success">{{success}}</div>
    <h3>Your cars</h3>
<div v-for="(user) in mydata" :key="user">
    <div v-for="(prop) in user" :key="prop">
        <form method="post" action="/updateCar" >
            <input type="hidden" :value="prop['car_id']" name="car_id" id="car_id">
            <h4>Brand</h4>
            <input type = "text" :value="prop['brand']" required name = "brand" id ="brand" class="form-control">
            <h4>Model</h4>
            <input type = "text" :value="prop['model']" required name = "model" id ="model" class="form-control">
            <h4>Color</h4>
            <input type = "text" :value="prop['color']" required name = "color" id ="color" class="form-control">
            <h4>Licence plate number</h4>
            <input type = "text" :value="prop['plate_num']" placeholder="Unique" required name = "plate_num" id ="plate_num" class="form-control">
            <h4>At parking?</h4>
            <select class="form-select" required name="on_parking" id="on_parking">
                <option selected value="1">In</option>
                <option value="0"> Out</option>
            </select>
            <br><button  type="submit" class="btn btn-warning">Update car data</button>
            <hr>
        </form>

    </div>
</div>
</template>

<script>
export default {

    data(){
        return{
            user:{
                client_id:this.mydata[0][0]['client_id'],
                full_name:this.mydata[0][0]['full_name'],
                phone_num:this.mydata[0][0]['phone_num'],
                gender:this.mydata[0][0]['gender'],
                address:this.mydata[0][0]['address'],
            },
            errors:{},
            success:'',
        }
    },
    props:['mydata'],
    methods:{
        submitUser(){
            axios.post('/updateClient', {
                user: this.user,
            }).then(response=>{
                this.errors = {};
                this.success = "User updated successfully";
            }).catch(error=>{
                this.success= "";
                console.log(this.fields);
                console.log(this.errors);
                if(error.response.status == 422){
                    this.errors = error.response.data.errors;
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
