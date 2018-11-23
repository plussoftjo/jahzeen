<template>
	<v-app id="main">
			 <v-navigation-drawer
		     v-model='drawer' app stateless floating
		      	 class="teal lighten-5"
		    >
		      <v-toolbar flat class="teal">
		        <v-list class="pa-0">
		          <v-list-tile avatar>
		            <v-list-tile-avatar>
		              <img src="https://randomuser.me/api/portraits/men/85.jpg">
		            </v-list-tile-avatar>

		            <v-list-tile-content>
		              <v-list-tile-title style="color: white;">Mohammed</v-list-tile-title>
		            </v-list-tile-content>
		          </v-list-tile>
		        </v-list>
		      </v-toolbar>

		      <v-list class="pt-0" dense>
		        <v-divider></v-divider>

		        <v-list-tile
		          v-for="item in items"
		          :key="item.title"
		          @click="$router.push({name:item.at})"
		        >
		          <v-list-tile-action>
		            <v-icon>{{ item.icon }}</v-icon>
		          </v-list-tile-action>

		          <v-list-tile-content>
		            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
		          </v-list-tile-content>
		        </v-list-tile>
		      </v-list>
		    </v-navigation-drawer>

		    
 			<v-content>
 				<v-toolbar app>
				    <v-toolbar-side-icon @click="drawer =!drawer"></v-toolbar-side-icon>
				    <v-toolbar-title>{{$router.currentRoute.name}}</v-toolbar-title>
				    <v-spacer></v-spacer>
				    <v-toolbar-items class="hidden-sm-and-down">
				          <v-btn icon>
						      <v-icon>search</v-icon>
						    </v-btn>

						    <v-btn icon>
						      <v-icon>apps</v-icon>
						    </v-btn>

						    <v-btn icon>
						      <v-icon>refresh</v-icon>
						    </v-btn>

						    <v-btn icon>
						      <v-icon>more_vert</v-icon>
						    </v-btn>
				    </v-toolbar-items>
				</v-toolbar>
 				
 					<v-container>
						<router-view></router-view>
 					</v-container>
			</v-content>
	</v-app>
</template>
<script>
	export default {
		data() {
			return {
				drawer: true,
		        items: [
		          { title: 'Main', icon: 'dashboard',at:'main' },
		          { title: 'Service', icon: 'question_answer',at:"service" },
		          { title: 'subService', icon: 'question_answer',at:"subService" },
		          { title: 'Prices', icon: 'question_answer',at:"price" },
		          { title: 'Orders', icon: 'question_answer',at:"orders" },
		          { title: 'Approve Orders', icon: 'question_answer',at:"approveOrders" },
		          { title: 'Drivers', icon: 'question_answer',at:"driver" },
		          { title: 'complateOrders', icon: 'question_answer',at:"complateOrders" },

		        ],
		        right: null,
		        
			}
		}
	}
</script>
<style>
	
</style>