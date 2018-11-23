<template>
	<div id="service">
		<v-card>
			<v-card-title>
				<span class="headline font-weight-medium font-italic">Service List</span>
				<v-spacer></v-spacer>
				<v-btn float dark color="green lighten-1 headline" icon @click="storeDialog=!storeDialog">+</v-btn>
			</v-card-title>

			<v-card-title>
				<div style="width:100%;">
					<serviceCard v-for="(i,index) in services" :key="index" :services="i" class="mt-3"></serviceCard>
				</div>
			</v-card-title>
		</v-card>

		<store :storeDialog="storeDialog"></store>

	</div>
</template>
<script>
	import serviceCard from './section/serviceCard';
	import store from './section/store';
	export default {
		components:{'serviceCard':serviceCard,'store':store},
		data() {
			return {
				src:'/img/service.jpg',
				storeDialog:false,
				services:[]
				
			}
		},
		methods:{
			install() {
				const vm = this;

				axios.get('api/admin/service/index').then(response => {
					vm.services = response.data;
				});
			}
		},
		created() {
			const vm = this;

			//install 
			vm.install();
		}
	}
</script>