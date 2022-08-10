	<template>
		<h1> Cars on parking </h1>
    <table class="table table-dark">
	<tbody>
        <tr>
            <th>Car ID</th>
            <th>Car Brand</th>
            <th>Car Model</th>
            <th>License Plate Number</th>
            <th>Owner Name</th>
            <th>Delete car</th>
        </tr>
   
        <tr v-for="car in mydata" :key="car">
			<td v-for="prop in car" :key="prop"> 
				{{prop}} 
			</td>  

			<td>
				<a :href="'/deleteCar/'+car.car_id" class="btn btn-danger"><i class="fa fa-ban"></i> Delete</a> 
			</td>
        </tr>
	</tbody>
    </table>
	</template>



<script>
export default {
	props:['mydata']
}
</script>
