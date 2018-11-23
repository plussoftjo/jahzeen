<template>
	<div class="subServiceCard">
		<v-card class="elevation-10 mt-2">
			<v-card-media
			:src="ss.image"
			height="200px"
			contain></v-card-media>
			<v-divider></v-divider>
			<v-card-text>
				<div style="width: 100%;">
				<span class="font-weight-black">Title:</span> {{ss.title}}
				</div>
				<div style="width: 100%;">
				<span class="font-weight-black">Service:</span> {{ss.service_id}}
				</div>
				<div class="btnEdit">
					<v-btn icon class="green" dark @click="dialog = true">
	                <v-icon>create</v-icon>
	            </v-btn>
				<v-btn icon class="red" dark @click="destroy(ss.id)">
	                <v-icon>delete_sweep</v-icon>
	            </v-btn>
				</div>
			</v-card-text>
		</v-card>
		<v-dialog v-model="dialog" max-width="700px">
			<v-card>
				<v-card-title primary-title>
					<div class="title font-weight-black">
						Edit SubService
					</div>
				</v-card-title>
				<v-card-media
				:src="ss.image"
				contain
				height="200px">
					<v-btn @click="changeImage">Change Picture</v-btn>
					<div class="inputF">
						 <input type="file" v-on:change="onFileChange" class="form-control" ref="image">
					</div>
				</v-card-media>
				<v-card-text>
				<v-text-field
				v-model="ss.title"
				solo
				label="Title"></v-text-field>
				</v-card-text>
				<v-card-actions>
					<v-btn class="success" dark @click="update">
						Store
					</v-btn>
					<v-btn @click="dialog = false;">
						close
					</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
	export default {
		props:['ss'],
		methods:{
			destroy(id)
			{
				const vm = this;
				confirm('Do you Want Delete ?') && axios.get('api/admin/sub_service/destroy/' + id ).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err)
				});
				
			},
			changeImage() {
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
		              vm.ss.image = e.target.result;
		              vm.upload();
		          };
		          reader.readAsDataURL(file);
		      },
		      upload() {
		      	const vm = this;
		      	axios.post('/api/admin/sub_service/update/image/' + vm.ss.id,{image:vm.ss.image}).then(response => {

		      	}).catch(err => {
		      		console.log()
		      	});
		      },
		      update() {
		      	const vm = this;
		      	axios.post('/api/admin/sub_service/update/' + vm.ss.id,{title:vm.ss.title}).then(response => {
		      		vm.dialog = false;

		      	}).catch(err => {
		      		console.log(err)
		      	});
		      }
		},
		data() {
			return {
				dialog:false
			}
		}
	}
</script>
<style>
	.btnEdit{position: absolute; right: 0px; bottom: 5px;}
	  .inputF {
        position: absolute;
        left: -99999px;
    }
    .colorPlate{ display: inline-block; }
	.colorPlate input{ display: inline-block; }
</style>