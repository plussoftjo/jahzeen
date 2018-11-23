<template>
	<div class="tables">
		  <v-data-table
		    :headers="headers"
		    :items="tables"
		    class="elevation-1"
		  >
		    <template slot="items" slot-scope="props">
		      <td class="text-xs-center">{{ props.item.id }}</td>
		      <td class="text-xs-center">{{ props.item.sub_service.title }}</td>
		      <td class="text-xs-center">{{ props.item.size }}JD</td>
		      <td class="text-xs-center">
		      	<v-btn icon dark @click="edited(props.item)">
	                <v-icon class="green--text">create</v-icon>
	            </v-btn>
				<v-btn icon dark @click="destroy(props.item.id)">
	                <v-icon class="red--text">delete_sweep</v-icon>
	            </v-btn>
		      </td>
		    </template>
		  </v-data-table>
		  <v-dialog v-model="dialog" max-width="700px">
		  	<v-card v-if="table">
		  		<v-card-title primary-title>
		  			Edit\Price
		  		</v-card-title>
		  		<v-card-text>
					<v-text-field
					label="subService"
					solo
          disabled
					v-model="table.sub_service.title"></v-text-field>
					<v-select
					:items="sizes"
					label="Size"
					solo
					v-model="table.size"></v-select>
					<v-text-field
					v-model="table.price"
					solo 
					label="Price"></v-text-field>

				</v-card-text>
				<v-card-actions>
					<v-btn class="success" @click="update">
						Update
					</v-btn>
					<v-btn @click="dialog = false;">
						Close 
					</v-btn>
				</v-card-actions>
		  	</v-card>
		  </v-dialog>
	</div>
</template>
<script>
  export default {
    data () {
      return {
      	dialog:false,
        headers: [
          {
            text: '#',
            align: 'center',
            sortable: false,
            value: 'id'
          },
          {
          	text:'subService',
          	align:'center',
          	sortable:false,
          	value:'subService'
          },
          {
          	text:'size',
          	align:'center',
          	sortable:false,
          	value:'size'
          },
          {
          	text:'Edit/Delete',
          	align:'center',
          	sortable:false,
          	value:'edit'
          }
        ],
        tables: [
          
        ],
        table:null,
        sizes:['Large','Medium','Small']
      }
    },
    methods:{
    	install() {
    		const vm = this;
    		axios.get('api/admin/price/index').then(response => {
    			vm.tables = response.data;
    		}).catch(err => {
    			console.log(err)
    		});


    	},
    	edited(item) {
    		const vm = this;
    		vm.table = item;
    		vm.dialog = true;
    	},
    	update() {
    		const vm = this;
    		axios.post('api/admin/price/update/' + vm.table.id, vm.table).then(response => {
    			location.reload();
    		}).catch(err => {
    			console.log(err)
    		});
    	},
      destroy(id)
      {
        const vm = this;
        confirm('Do you Want Delete ?') && axios.get('api/admin/price/destroy/' + id ).then(response => {
          location.reload();
        }).catch(err => {
          console.log(err)
        });
        
      },
    },
    created() {
    	const vm = this;
    	vm.install();
    }
  }
</script>