<template>
	<div class="index">
		<v-card>
			<v-card-title>
				Drivers
				<v-spacer></v-spacer>
				<v-btn class="success" @click="dialog = true;" small icon flat fab>+</v-btn>
			</v-card-title>
			  <v-data-table
			    :headers="headers"
			    :items="Users"
			    class="elevation-1"
			  >
			    <template slot="items" slot-scope="props">
			      <td class="text-xs-center">{{ props.item.id }}</td>
			      <td class="text-xs-center">{{ props.item.name }}</td>
			      <td class="text-xs-center">{{ props.item.phone }}</td>
			    </template>
			  </v-data-table>
		</v-card>

		<v-dialog v-model="dialog" max-width="700px">
			<v-card>
				<v-card-title class="primary white--text">
					Add New User
				</v-card-title>
				<v-card-title style="display: block;">
					<v-text-field
					v-model="user.name"
					label="name"
					solo></v-text-field>
					<v-text-field
					v-model="user.phone"
					label="Phone"
					solo></v-text-field>
					<v-text-field
					v-model="user.password"
					label="Password"
					solo></v-text-field>

					<v-layout row wrap>
						<v-flex xs6>
							<v-btn class="success" block @click="store">Save</v-btn>
						</v-flex>
						<v-flex xs6>
							<v-btn block @click="dialog = false;">close </v-btn>
						</v-flex>
					</v-layout>
				</v-card-title>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				user:{name:null,phone:null,password:null},
				dialog:false,
				headers: [
		          {
		            text: 'ID',
		            align: 'center',
		            sortable: false,
		            value: 'id'
		          },
		          {
		          	text:'Name',
		          	align:'center',
		          	value:'name'
		          },
		          {
		          	text:"Phone",
		          	align:'center',
		          	value:'phone'
		          }
		        ],
		        Users:[]
			}
		},
		methods:{
			store() {
				const vm = this;
				axios.post('api/admin/driver/store',vm.user).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err)
				});
			},
			install() {
				const vm = this;
				axios.get('api/admin/driver/index').then(response => {
					vm.Users = response.data;
				}).catch(err => {
					console.log(err)
				});
			}
		},
		created() {
			const vm = this;
			vm.install();
		}
	}
</script>