<template>
	<div class="subServiceCard" style="width: 100%;">
		<v-layout row wrap>
			<v-flex xs3>
				<v-card>
					<v-card-title class="teal white--text">
						<div class="font-weight-black">
							Sub Service
						</div>
					</v-card-title>
				</v-card>
			</v-flex>
			<v-flex xs3 v-for="sub in subService" :key="sub.id">
				<v-card>
					<v-card-title>
						<div class="font-weight-black">
							{{sub.sub_service.title}}
						</div>
					</v-card-title>
				</v-card>
			</v-flex>
		</v-layout>
		<v-layout row wrap class="mt-3">
			<v-flex xs8>
				
			</v-flex>
			<v-flex xs4>
				<v-btn class="primary font-weight-black" block @click="$router.push({name:'approveOrder',params:{id:id}})">
					 Details
				</v-btn>
			</v-flex>
		</v-layout>
	</div>
</template>
<script>
	export default {
		props:['id'],
		methods:{
			install() {
				const vm = this;
				axios.get('api/admin/approve/order/subService/' + vm.id).then(response => {
					vm.subService = response.data;
				}).catch(err => {
					console.log(err)
				});
			}
		},
		data() {
			return {
				subService:[]
			}
		},
		created() {
			const vm = this;
			vm.install();
		}
	}
</script>