	<template>
		<h1> Cars on parking </h1>
    <table class="table table-dark">
	<tbody>
        <tr>
            <th v-on:click="sortTable('car_id')">Car ID</th>
            <th v-on:click="sortTable('brand')">Car Brand</th>
            <th v-on:click="sortTable('model')">Car Model</th>
            <th v-on:click="sortTable('plate_num')">License Plate Number</th>
            <th v-on:click="sortTable('full_name')">Owner Name</th>
            <th>Delete car</th>
        </tr>

        <tr v-for="car in data" :key="car">
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
