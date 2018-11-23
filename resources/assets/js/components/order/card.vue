<template>
	<v-card class="mt-3 elevation-5" style="width:100%;">
				<v-layout row wrap>
					<v-flex xs4>
						<v-img :src="bag.sub_service.image" height="130px" width="130px"  contain ></v-img>
					</v-flex>
					<v-flex xs8>
						<div class="title pa-2">
							{{bag.sub_service.title}}
						</div>
						<div class="services">
							<div class="word pl-2" @click="showService = !showService">
								<span style="font-size:16px;">services </span> <v-icon style="font-size: 16px !important;">expand_more</v-icon>
							</div>
							<v-slide-y-transition>
								<div class="list" v-if="showService">
									<ul>
										<li v-for="s in services">{{s.price.size}}JD</li>
									</ul>
								</div>
							</v-slide-y-transition>
						</div>
						<div class="fullPrice">
							{{prices}}JD
						</div>
					</v-flex>
				</v-layout>
				
			</v-card>
</template>
<script>
	export default {
		props:['bag','order_id'],
		data() {
			return {
				showService:false,
				services:[],
				prices:0
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('api/admin/order/price/' + vm.bag.sub_service.id + '/' + vm.order_id).then(response => {
					vm.services = response.data
					vm.services.forEach(trg => {
						var price =trg.price.size.split('-');
						var i = price[1] * 1;
						vm.prices = vm.prices + i;
					});
				}).catch(err => {
					console.log(err)
				});
			},
			
		},
		created(){
			const vm = this;
			vm.install();
		},
		
	}
</script>
<style>
	.fullPrice{position: absolute; right: 3px; bottom:0px; font-size: 18px; font-weight: 800;}
	.list ul{padding: 0px; list-style: none; margin: 0px; position: absolute; padding-left: 10px; background-color: white;}
	.list ul >li { padding: 0px; margin: 0px; font-weight: 700; font-size: 14px; line-height: 1.2;}

</style>