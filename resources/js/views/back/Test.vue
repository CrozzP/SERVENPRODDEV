<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Registros
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Registros a direvar</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Usuario</li>
  	</template>
</Breadcrumbs>

	<div class="card mb-3">
		<div class="card-header d-flex">
			<span>
				<i class="fas fa-chart-area"></i>
					Administrar Registros
			</span>
		<button class="btn btn-primary btn-sm ml-auto" @click="addModal=true" v-if="isWritePermitted" ><span class="fa fa-plus"></span> Nuevo</button>
		 
		</div>
	</div>
		<div class="row">
			<div class="col-md-12  ml-auto mr-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">

							<h1>Pdf</h1>
							<div>
								<b-card>
									 <form v-on:submit.prevent="filtroPdf">
						        

						
						        		
 
						        		

									  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
									    <b-col>
									    	
									     	

									     	<b-form-group  id="input-group-1" label="Apellido paterno :" label-for="apellPat" >
										        <b-form-input id="apellPat" v-model="filtro.apellPat" type="text" placeholder="Ingresar el Apellido Paterno"  >
										        </b-form-input>
										     </b-form-group>
									     			     	 
									    </b-col>
									    <b-col>
									    	
										     <b-form-group  id="input-group-1" label="Apellido Materno :" label-for="apellMat"  >
										        <b-form-input id="apellMat" v-model="filtro.apellMat" type="text" placeholder="Ingresar el Apellido Materno" >
										        </b-form-input>
										     </b-form-group>
										     <b-form-group  id="input-group-1" label="Nombres :" label-for="nombre"  >
										        <b-form-input id="nombre" v-model="filtro.nombre" type="text" placeholder="Ingresar los nombres" >
										        </b-form-input>
										     </b-form-group>
									    </b-col>
									  </b-row>

									  <br>
									
									<div class="text-center mt-3">


										<button type="button" class="btn btn-outline-danger" >Cancelar</button>
										
										<button class="btn btn-outline-success"  ><span class="fa fa-check"></span>Registrar</button>

                        
									</div>

									  


						        	

									
									
						        	</form>
								</b-card>
							</div>

						</div>

					</div>
				</div>
			</div>
		</div>
	

</base-layout>

</template>

<script>

import Breadcrumbs from '../../../components/layouts/back/includes/Breadcrumbs.vue';
import * as categoryService from '../../../services/category_service';

export default{
	components: {
		Breadcrumbs,
		
		
	},



	data(){
		return {
			data : {
				
			},

			//filtro: [],
			filtro:{
				apellPat: '',
			},
			
		}
	},


	methods : {

		

		async filtroPdf(){

			axios({
  method: 'post',
  url: 'app/pdftest',
  responseType: 'arraybuffer',
  data: this.filtro
}).then(function(response) {
  let blob = new Blob([response.data], { type: 'application/pdf'})
  let link = document.createElement('a')
  link.href = window.URL.createObjectURL(blob)
	//console.log(filename)
  //link.download = 'Report.pdf'
 // link.click()
   window.open(link.href)


})

/*
			const res = await this.callApi('post', 'app/pdftest', this.filtro)
			console.log('dentro de reportePDF',this.filtro)
			if (res.status==200) {
				

				//res.AppendHeader()

			//	this.users.unshift(res.data)
				//this.$swal('Hello Vue world!!!');
				//window.open(res);
				let blob = new Blob([res.data], { type: 'application/pdf' })
  let link = document.createElement('a')
  link.href = window.URL.createObjectURL(blob)
  link.download = 'Report.pdf'
  link.click()

				this.$swal('Usuario creado','Correctamente','success');
			

			} else {
				if (res.status==422) {
					for(let i in res.data.errors){
						this.$swal({
							toast: true,
						  position: 'top-end',
						  icon: 'error',
						  title: res.data.errors[i][0],
						  showConfirmButton: false,
						  timer: 5000
						});
					}
				} else {
					this.$swal('Ocurrio algun problema','Intentelo nuevamente','warning')
				}
			}

				*/

			
			//window.open(`/back/app/pdftest/${extraordinario.id}`);
			
			//redirect: '/back/app/generate-pdf'
			//window.location.href = '/back/app/generate-pdf'
			//window.location.href = `/back/app/generate-pdf/${this.editData.tipoExtraordinario_id}`
			
			///window.location.href = `/back/app/generate-pdf/${extraordinario.id}`
			//window.open(`/back/app/generate-pdf/${extraordinario.id}`, '_blank');
        	
          /*  axios.get(`/back/app/pdftest`,{
             params: {
               tipoExtraordinario_id: this.filtro

             }
          }).then(function(response){
                this.obsTipoExtraordinarios = response.data;
                //window.open('/back/app/generate-pdf');
            }.bind(this));*/

        },
		




	},


		

		


	




}




  </script>