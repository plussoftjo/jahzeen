  <template>
  	<div>
	  	<v-card>
			 <v-card-media
	            :src="services.image"
	            height="200px"
	         ></v-card-media>
			<v-card-title class="blue lighten-2 white--text">
				<div class="headline font-italic">{{services.title}}</div>
				<v-spacer></v-spacer>
				<v-btn icon class="green" dark @click="dialog = true">
	                <v-icon>create</v-icon>
	            </v-btn>
				<v-btn icon class="red" dark @click="destroy(services.id)">
	                <v-icon>delete_sweep</v-icon>
	            </v-btn>
			</v-card-title>
		</v-card>	
		<v-dialog v-model="dialog" >
			<v-card>
				<v-card-title primary-title>
					<div class="title">Edit Item</div>
				</v-card-title>
				<v-divider></v-divider>
				<v-card-media
				:src="services.image"
				height="200px">
					<div class="imageSection">
						<v-btn @click="changeImage">Change Image</v-btn>
					</div>
					<div class="inputF">
						 <input type="file" v-on:change="onFileChange" class="form-control" ref="image">
					</div>
				</v-card-media>
				<v-card-text>
					<v-text-field
					v-model="services.title"
					label="service"
					solo></v-text-field>
				</v-card-text>
				<v-card-actions>
					<v-layout row wrap>
						<v-flex xs6>
							<v-btn class="success" block @click="update">Save</v-btn>
						</v-flex>
						<v-flex xs6>
							<v-btn @click="dialog = false" block>
								Close
							</v-btn>
						</v-flex>
					</v-layout>
				</v-card-actions>
			</v-card>
		</v-dialog>
  	</div>
</template>
<script>
	export default {
		props:['services'],
		methods:{
			destroy(id) {
				const vm = this;
				confirm('Do you Want Delete ?') && axios.get('api/admin/service/destroy/'+id).then(response => {
					location.reload();
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
		              vm.services.image = e.target.result;
		              vm.upload();
		          };
		          reader.readAsDataURL(file);
		      },
		      upload() {
		      	const vm = this;
		      	axios.post('/api/admin/service/update/image/' + vm.services.id,{image:vm.services.image}).then(response => {

		      	}).catch(err => {
		      		console.log()
		      	});
		      },
		      update() {
		      	const vm = this;
		      	axios.post('/api/admin/service/update/' + vm.services.id,{title:vm.services.title}).then(response => {
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
<style scoped>
    .inputF {
        position: absolute;
        left: -99999px;
    }
    .colorPlate{ display: inline-block; }
	.colorPlate input{ display: inline-block; }
</style>
