<template>
	<div class="pricess">
		<v-card>
			<v-card-title primary-title>
				<div class="title">
					Details & Price Table
				</div>
				<v-spacer></v-spacer>
				<v-btn float class="success" dark icon @click="dialog= true;">+</v-btn>
			</v-card-title>
			<v-card-text>
				<tables></tables>
			</v-card-text>
		</v-card>
		<v-dialog v-model="dialog" max-width="700px">
			<v-card>
				<v-card-title>
					New Table
				</v-card-title>
				<v-card-text>
					<v-select
					:items="subServices"
					label="Sub Service Select"
					solo
					v-model="table.subService"></v-select>
					<v-text-field
					label="Size"
					solo
					v-model="table.size"></v-text-field>
					<v-text-field
					v-model="table.price"
					solo 
					label="Price"></v-text-field>

				</v-card-text>
				<v-card-actions>
					<v-btn class="success" @click="store">
						Store
					</v-btn>
					<v-btn @click="dialog = false;">
						Close 
					</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
	import tables from './part/tables'
	export default {
		components:{tables},
		data() {
			return {
				dialog:false,
				table:{subService:'',price:'',size:''},
				subServices:[],
				sizes:['Large','Medium','Small']
			}
		},
		methods:{
			installSubService() {
				const vm = this;
				axios.get('api/admin/sub_service/index').then(response => {
					response.data.forEach(trg => {
						vm.subServices.push(trg.title);
					});
				}).catch(err => {
					console.log(err)
				});
			},
			store() {
				const vm = this;
				axios.post('api/admin/price/store', vm.table).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err)
				});
			}
		},
		created(){
			const vm = this;
			vm.installSubService();
		}
	}
</script>
<style>
	
</style>