<template>
	
		<!-- model For Add new Service  -->

		<v-dialog v-model="storeDialog" max-width="500px">
			<v-card>
				<v-card-title>
					<v-layout row wrap>
						<v-flex xs12>
							<v-text-field v-model="service.title" label="Service Title"></v-text-field>
						</v-flex>
						<v-flex xs12>
							<!-- IMAGE FIELD -->
							<div class="imageSection">
								<v-text-field
								prepend-icon="attach_file"
								single-line
								:label="label"
								v-model="filename"
								:required="required"
								@click.native="onFocus"
								:disabled="disabled" 
								ref="fileTextField"
								></v-text-field>
								<input 
								type="file" 
								:accept="accept" 
								:multiple="false" 
								:disabled="disabled"
								ref="fileInput"
								@change="onFileChange"
								> 
							</div>
							<!-- END OF IMAGE FIELD  -->
						</v-flex>
					</v-layout>
				</v-card-title>
				<v-card-title>
					<v-btn class="green lighten-2" dark @click="store">Store</v-btn>
					<v-btn class="red lighten-2" dark @click="storeDialog = false">Cancel</v-btn>
				</v-card-title>
			</v-card>
		</v-dialog>

</template>
<script>
	export default {
		props: {
            value: {
                type: [Array, String]
            },
            accept: {
                type: String,
                default: "*"
            },
            label: {
                type: String,
                default: "Please choose..."
            },
            required: {
                type: Boolean,
                default: false
            },
            disabled: {
                type: Boolean,
                default: false
            },
            multiple: {
                type: Boolean, // not yet possible because of data
                default: false
            },
            storeDialog: {
            	type: Boolean,
            	default:false
            },

        },
		data() {
			return {
				service:{title:'',image:''},
				filename:'',
				image:''
			}
		},
		methods:{
			store() {
				const vm = this;
				axios.post('api/admin/service/store',{service:vm.service,image:vm.image}).then(response => {
					location.reload();
				});
			},
			onFileChange($event){
                const files = $event.target.files || $event.dataTransfer.files;
                if (!files.length)
               	return;
                this.createImage(files[0]);


                const form = this.getFormData(files);
                if (files) {
                    if (files.length > 0) {
                        this.filename = [...files].map(file => file.name).join(', ');
                    } else {
                        this.filename = null;
                    }
                } else {
                    this.filename = $event.target.value.split('\\').pop();
                }
                this.$emit('input', this.filename);
                this.$emit('formData', form);

            },
            getFormData(files){
                const data = new FormData();
                [...files].forEach(file => {
                    data.append('data', file, file.name); // currently only one file at a time
                });
                return data;
            },
            onFocus(){
                if (!this.disabled) {
                    
                    this.$refs.fileInput.click();
                }
            },
            createImage(file) {
				let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
		},
		watch: {
			value(v) {
				this.filename = v;
			}
		},
		mounted() {
            this.filename = this.value;
        },
	}
</script>
<style scoped>
    input[type=file] {
        position: absolute;
        left: -99999px;
    }
    .colorPlate{ display: inline-block; }
	.colorPlate input{ display: inline-block; }
</style>
