<template>

<h1> Main table </h1>

<table class="table table-dark"> 
    <tbody>
    
    <tr>
        <th>User ID</th>
        <th>User name</th>
        <th>User phone number</th>
        <th>Car brand</th>
        <th>Car plate number</th>
        <th>Is car on parking</th>
        <th>Car ID</th>
    </tr>
    <tr v-for="user in mydata" :key="user">
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
    props:['mydata']
}
</script>