<template>
    <form method="POST" @submit.prevent="submit">
        <h4>Full name</h4>
        <input type="text"  placeholder="Format: Name Surname Patronymic" v-model="user.full_name" required name="full_name" id="name" class="form-control">
        <div class="alert alert-danger" v-if="errors && errors['user.full_name']">{{errors['user.full_name'][0]}}</div>
        <h4>Phone number</h4>
        <input type="tel"  placeholder="Format: +78005553535, unique" v-model="user.phone_num" required name="phone_num" id="phone" class="form-control">
        <div class="alert alert-danger" v-if="errors && errors['user.phone_num']">{{errors['user.phone_num'][0]}}</div>
        <h4>Gender</h4>
        <select class="form-select" name="gender" id="gender" v-model="user.gender">
            <option selected  value="1" >Male</option>
            <option value="0">Female</option>
        </select>

        <h4>Address </h4>
        <input type="text" placeholder="Optional" required name="address" v-model="user.address" id="address" class="form-control">
        <div class="alert alert-danger" v-if="errors && errors.address">{{errors.address[index]}}</div>


        <h3> Your cars: </h3>
        <div v-for="(field,key,index) in fields" :key="index">
        <h3> Car number {{key + 1}} </h3>
        <h4>Brand </h4>
        <input type="text"  required name="brand" :id="'brand'+(index+1)" v-model="field.brand" class="form-control">
        <div class="alert alert-danger" v-if="errors && errors.brand">{{errors.brand[index]}}</div>
        <h4>Model</h4>
        <input type="text" required name="model" :id="'model'+(index+1)" v-model="field.model" class="form-control">
         <div class="alert alert-danger" v-if="errors && errors.model">{{errors.model[index]}}</div>
        <h4>Color</h4>
        <input type="text" required name="color"  :id="'color'+(index+1)" v-model="field.color" class="form-control">
         <div class="alert alert-danger" v-if="errors && errors.color">{{errors.color[index]}}</div>
        <h4>Licence plate number</h4>
        <input type="text"  placeholder="Unique" v-model="field.plate_num" required name="plate_num" :id="'plate_num'+(index+1)" class="form-control">
         <div class="alert alert-danger" v-if="errors && errors['cars.'+index+'.plate_num'] ">{{errors['cars.' +index+ '.plate_num'][index]}}</div>
        <h4>At parking?</h4>
        <select required class="form-select" name="on_parking" v-model="field.on_parking" :id="'on_parking'+(index+1)">
            <option value="1" selected >In</option>
            <option value="0">Out</option>
        </select>
        </div>

        <br><button type="submit" class="btn btn-warning">Send your form</button>
    </form>
    <div class="alert alert-success" v-if="success">{{success}}</div>
    <button class="btn btn-primary" v-on:click='addForm'> + </button>
</template>
<script>
export default {
    data()
    {
        return{

            fields:[{'brand':'', 'model':'', 'color':'','plate_num':'','on_parking':1}],
            cars:null,
            success: null,
            errors:{},
            forms:1,
            user:{'gender':1}
        }
    },

    mounted() {
        // axios.post('api/cars').then(response=>{
        //     this.cars = response.data.data});
    },

    methods:{

        addForm(){
          this.forms++;
          this.fields.push({'brand':'', 'model':'', 'color':'','plate_num':'','on_parking':''})
        },

        submit(){
           axios.post('/addClient', {
            user: this.user,
            cars:this.fields
           }).then(response=>{
            this.success = "Client added succesfully!";
            this.fields = [{'brand':'', 'model':'', 'color':'','plate_num':'','on_parking':''}];
            this.errors = {};
           }).catch(error=>{
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
