<template>
	
<div class="card col-md-6">
		<h5 class="card-header text-center">Login Dashboard</h5>
		<div class="card-body">
		
			 
        <form v-on:submit.prevent="login">

			
			 

			<b-form-group
		        id="input-group-1"
		        label="Email address:"
		        label-for="email"

		        description="We'll never share your email with anyone else."
		      >
		        <b-form-input
		          id="email"
		          
		          type="email"
		          v-model="data.email"
		          placeholder="Enter email"
		        ></b-form-input>
		     </b-form-group>

		     <b-form-group id="input-group-1" label="Password:" label-for="password">
		        <b-form-input

		          id="password"
		          type="password"
		          v-model="data.password"
		          
		          placeholder="******"
		        ></b-form-input>
		     </b-form-group>


			

			
			
			<div class="card-footer text-center">
			<div class="text-ringth">
					<button type="button" class="btn btn-default" v-on:click="addModal=false">Cancelar</button>
					<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Adding..' : 'Add admin'}}</button>
				</div>
			</div>

			
        	
        	</form>
        
			

		</div>

	</div>

</template>

<script>
	
export default {
	data(){
		return {
			data : {
				email : '',
				password : '',
			},
			isLogging : false,
		}
	},

	methods : {
		async login(){
			if (this.data.email.trim()=='') return this.flashMessage.error({
						message: 'Email is required',
						time: 5000
					});
			if (this.data.password.trim()=='') return this.flashMessage.error({
						message: 'Password is required',
						time: 5000
					});
			if (this.data.password.length < 6) return this.flashMessage.error({
						message: 'Incorrect login data',
						time: 5000
					});
			this.isLogging = true
			const res = await this.callApi('post', 'app/admin_login', this.data)
			if (res.status==200) {
				window.location='/'
				//console.log('nos deja esto :',state)
				this.flashMessage.success({
						message: res.data.msg,
						time: 5000
					})
			} else {
				if (res.status==401) {
					this.flashMessage.error({
						message: res.data.msg,
						time: 5000
					})
				} else if (res.status==422) {
					for(let i in res.data.errors){
						Swal.fire({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: res.data.errors[i][0],
					  showConfirmButton: false,
					  timer: 5000
					});

						//position: fixed

						//this.e(res.data.errors[i][0])
					}
					
				} {
					this.flashMessage.error({
						message: 'ocurrio algun error',
						time: 5000
					})

				}
			}
			this.isLogging = false
		}
	}
}


</script>