<template>
	<div class="order">
		<v-card>
			<v-card-title class="teal darken-4 white--text">
				Order Details
			</v-card-title>
			<div class="orderBox pa-2">
				<v-card class="mt-2">
					<v-card-title class="primary white--text">
						<div>
							<span class="font-weight-black">Order ID:</span> 100{{order.id}} 
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
					</v-card-title>
					<v-card-title style="width:100%;">
						<card style="width:100%;" v-for="ss in subService" :key="ss.id" :bag="ss" :order_id="order.id"></card>
					</v-card-title>
				</v-card>
			</div>
		</v-card>
		<v-card>
			<div class="mapChouse">
				<div id="map_canvas" style="width: 100%; height:400px;" >

		        </div>
			</div>
		</v-card>

		<v-card v-if="order.type == 0">
			<v-layout row wrap>
				<v-flex xs8>
					<v-select
					:items="drivers"
					label="Driver"
					solo
					v-model="driver"></v-select>
				</v-flex>
				<v-flex xs4>
					<v-btn class="success" block @click="approve">
						Approve
					</v-btn>
				</v-flex>
			</v-layout>
		</v-card>
	</div>
</template>
<script>
	import card from './card'
	export default {
		components:{card},
		data() {
			return {
				order:{},
				subService:{},
				lngLat:{lng:35.930359,lat:31.963158},
				driver:'',
				drivers:[]
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('api/admin/order/show/' + vm.$route.params.id).then(response => {
					vm.order = response.data.order;
					vm.subService = response.data.subService;
					var location = response.data.order.location.split(',');
					vm.lngLat.lng = location[0];
					vm.lngLat.lat = location[1];
					vm.installMap();
				}).catch(err =>{
					console.log(err)
				});
			},
			installMap() {
				const vm = this;
			setTimeout(function() {
	          vm.show = true;
	           mapboxgl.accessToken = 'pk.eyJ1IjoiYWhtYWRhbHRvbW15IiwiYSI6ImNqbmtlODc4azAwdHEzeXA2MjBjNml2dmoifQ.XOiKqWntxy0QOkL9eddzZw';
	          var map = new mapboxgl.Map({
	          container: 'map_canvas',
	          style: 'mapbox://styles/mapbox/satellite-streets-v10', // stylesheet location
	          center: [vm.lngLat.lng, vm.lngLat.lat], // starting position [lng, lat]
	          zoom: 14 // starting zoo
	           });

	          
	          var marker = new mapboxgl.Marker({draggable:false})
	          .setLngLat([vm.lngLat.lng, vm.lngLat.lat])
	          .addTo(map);
				
	         }, 1000);
			},
			approve() {
				const vm = this
				axios.post('api/admin/order/approve/' + vm.$route.params.id,{driver:vm.driver}).then(response => {

				}).catch(err => {
					console.log(err)
				});
			},
			getDriver() {
				const vm = this;
				axios.get('api/admin/driver/index').then(response => {
					response.data.forEach(trg => {
						vm.drivers.push(trg.name);
					});
				}).catch(err => {
					console.log(err)
				});
			}
		},
		created() {
			const vm = this;
			vm.install();
			vm.getDriver();
		},
		mounted() {
			const vm = this;
			// vm.installMap();
		}
	}
</script>