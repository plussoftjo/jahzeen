<template>
	<div class="subService">
		<v-card>
			<v-card-title primary-title>
				<div class="title">
					Sub Service 
				</div>
				<v-spacer></v-spacer>
				<v-btn float class="success" dark icon @click="dialog= true;">+</v-btn>
			</v-card-title>
			<v-card-text>
				<subServiceCard v-for="(ss,index) in subs" :key="index" :ss="ss"></subServiceCard>
			</v-card-text>
		</v-card>
		<v-dialog v-model="dialog" max-width="720px">
			<v-card>
				<v-card-title primary-title>
					<div class="title">
						Submit new SubService
					</div>
				</v-card-title>
				<v-card-text>
					<v-select
					v-model="sub.service"
					:items="services"
					solo
					label="Services"></v-select>
					<v-text-field
					v-model="sub.title"
					solo
					label="Title"></v-text-field>
					<v-text-field
					prepend-icon="attach_file"
					single-line
					label="Pickup image"
					@click.native="onFocus"
					></v-text-field>
					<div class="inputF">
						<input type="file" v-on:change="onFileChange" class="form-control" ref="image">
					</div>
				</v-card-text>
				<v-card-actions>
					<v-btn class="success" @click="store">
						Submit
					</v-btn>
					<v-btn @click="dialog= false">
						close
					</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
	import subServiceCard from './parts/subServiceCard';
	export default {
		components:{subServiceCard},
		data() {
			return {
				services:[],
				sub:{service:'',title:'',image:''},
				dialog:false,
				subs:[]
			}
		},
		methods:{
			installServices() {
				const vm = this;
				axios.get('/api/admin/service/index').then(response => {
					response.data.forEach(trg => {
						vm.services.push(trg.title);
					});
				}).catch(err => {
					console.log(err)
				});
			},
			onFocus() {
				const vm = this;
				vm.$refs.image.click();
			},
			onFileChange(e) {
		        let files = e.target.files || e.dataTransfer.files;
		         if (!files.length)
		            return;
		        this.createImage(files[0]);
		      },
		      createImage(file) {
		         let reader = new FileReader();
		          let vm = this;
		          reader.onload = (e) => {
		              vm.sub.image = e.target.result;
		          };
		          reader.readAsDataURL(file);
		      },
		      store() {
		      	const vm = this;
		      	axios.post('/api/admin/sub_service/store',vm.sub).then(response => {
		      		location.reload();
		      	}).catch(err => {
		      		console.log(err)
		      	});
		      },
		      install(){
		      	const vm = this;
		      	axios.get('/api/admin/sub_service/index').then(response => {
		      		vm.subs = response.data
		      	}).catch(err => {
		      		console.log(err)
		      	});
		      }
		},
		created() {
			const vm = this;
			vm.installServices();
			vm.install();
		}
	}
</script>
<style scoped>
    .inputF {
        position: absolute;
        left: -99999px;
    }
    .colorPlate{ display: inline-block; }
	.colorPlate input{ display: inline-block; }
</style>
