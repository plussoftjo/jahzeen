<template>
	<div class="orderds">
		<div class="orders">
			<v-card>
				<v-card-title primary-title class="teal darken-2 white--text">
					Orders List
				</v-card-title>
					<div class="orderBox">
						<v-card v-for="order in orders" :key="order.id" class="mt-2">
							<v-card-title class="primary white--text">
								<div>
									<span class="font-weight-black">Order ID:</span> 100{{order.order_id}} 
								</div>
								<div>
									  &nbsp;
								</div>
								<div>
									<span class="font-weight-black">Client Name :</span> {{order.user.name}} 
								</div>
								<div> &nbsp; </div>
								<div>
									<span class="font-weight-black">Client Phone Number:</span> {{order.user.phone}} 
								</div>
								<div> &nbsp; </div>
								<div>
									<span class="font-weight-black">Date: </span> {{order.date}}
								</div>
								<div> &nbsp; </div>
								<div>
									<span class="font-weight-black">Time: </span> {{order.time}}
								</div>
								<div> &nbsp; </div>
								<div>
									<span class="font-weight-black">Driver: </span> {{order.driver}}
								</div>
							</v-card-title>
							<v-card-title>
								<subServiceCard :id="order.order_id"></subServiceCard>
							</v-card-title>
						</v-card>
					</div>
			</v-card>
		</div>
	</div>
</template>
<script>
	import subServiceCard from './subServiceCard'
	export default {
		components:{subServiceCard},
		data() {
			return  {
				orders:[]
			}
		},
		methods: {
			install() {
				const vm = this;
				axios.get('api/admin/approve/orders/index').then(response => {
					vm.orders = response.data;
				}).catch(err => {
					console.log(err);
				});
			}
		},
		created() {
			const vm = this;
			vm.install();
		}
	}
</script>
<style>
	
</style>