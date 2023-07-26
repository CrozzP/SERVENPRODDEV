<template>
	
	<div>
		

		

	   
		<b-modal v-model="getDeleteModalObj.showDeleteModal" hide-footer width="360" title="Delete confirmation">
	      <div class="d-block text-center">
	        <h3>Esta seguro de eliminar?</h3>
	      </div>
	      
	      <b-button class="mt-2" variant="outline-danger" block long :loading="isDeleing" :disabled="isDeleing" @click="deleteTag">Seguro</b-button>
	      
	      
	    </b-modal>

	</div>

</template>
<script>
import {mapGetters} from 'vuex'
const Swal = require('sweetalert2');
export default {
	data(){
		return {
			isDeleing :false,

		}
	},

	methods : {
		async deleteTag(){
			//this.$store.commit('setDeleteModal')

			this.isDeleing = true
			const res = await this.callApi('post', this.getDeleteModalObj.deleteUrl,this.getDeleteModalObj.data)
				if (res.status==200) {
					//this.tags.splice(this.deletingIndex, 1)
					Swal.fire({
					  position: 'top-end',
					  icon: 'success',
					  title: 'Your work has been saved',
					  showConfirmButton: false,
					  timer: 1500
					});
					$.notify({
						// options
						icon: 'flaticon-alarm-1',
						message: 'Hello World',
					},{
						// settings
						type: 'danger',
					});
					this.$store.commit('setDeleteModal',true)		
				} else{
					this.flashMessage.error({
						message: 'Ocurrio algun error',
						time: 5000
					});
					this.$store.commit('setDeleteModal',false)		
				}
				//this.isDeleing = false
				//this.showDeleteModal = false
		},
	},


	computed : {
		...mapGetters(['getDeleteModalObj'])
	}


}	

</script>