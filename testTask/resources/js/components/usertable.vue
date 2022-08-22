<template>

<h1> Main table </h1>

<table class="table table-dark">
    <tbody>
    <tr>
        <th v-on:click="sortTable('client_id')">User ID</th>
        <th v-on:click="sortTable('full_name')">User name</th>
        <th v-on:click="sortTable('phone_num')">User phone number</th>
        <th v-on:click="sortTable('brand')"> Car brand</th>
        <th v-on:click="sortTable('plate_num')">Car plate number</th>
        <th v-on:click="sortTable('on_parking')">Is car on parking</th>
        <th v-on:click="sortTable('car_id')">Car ID</th>
    </tr>
    <tr v-for="user in data" :key="user">
        <td v-for="prop in user" :key="prop">
            {{prop}}
        </td>
        <td>
            <a :href="'/updateClient/'+user.client_id" class="btn btn-warning"><i class="fa fa-user-circle-o"></i> Update</a>
        </td>
        <td>
            <a :href="'/deleteCar/'+user.car_id" class="btn btn-danger"><i class="fa fa-ban"></i> Delete</a>
        </td>
    </tr>
    </tbody>
</table>

</template>

<script>
export default{
    data(){
        return{

            sortCol:'',
            asc:false,
            data: this.mydata,
        }
    },
    props:['mydata'],

    methods:{
        sortTable(col){
            if (this.sortCol === col) {
                this.asc = !this.asc;
            } else {
                this.asc = true;
                this.sortCol = col;
            }

            var asc = this.asc;
            this.data.sort(function(a, b) {
                if (a[col] > b[col]) {
                    return asc ? 1 : -1
                } else if (a[col] < b[col]) {
                    return asc ? -1 : 1
                }
                return 0;
            })
            console.log(this.asc);
            console.log(this.sortCol);
            console.log(this.data);
        }

    },
}
</script>
