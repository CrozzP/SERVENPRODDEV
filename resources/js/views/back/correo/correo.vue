<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Correos
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Usuarios del sistema</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Usuario Crozz3</li>
  	</template>
</Breadcrumbs>

	<div class="card mb-3">
		<div class="card-header d-flex">
			<span>
				<i class="fas fa-chart-area"></i>
					Administrar Correos
			</span>
		<button class="btn btn-primary btn-sm ml-auto" @click="addModal=true" v-if="isWritePermitted" ><span class="fa fa-plus"></span> Nuevo</button>
		 
		</div>
	</div>
		<div class="row">
			<div class="col-md-12  ml-auto mr-auto">
				<div class="card border-primary">
					<div class="card-body">
						<div class="row">

							<table class="table table-hover">
								
								<thead>
									<tr>
										<td>ID</td>
										<td>Correo</td>
										<td v-if="isUpdatePermitted">Estado</td>
										<td>Titular</td>
										<td>Cargo</td>
										
										
										<td>Acciones</td>
									</tr>
								</thead>
								<tbody>
									 
									<tr v-for="(correo, i) in correos" :key="i" v-if="correos.length">
										<td>{{correo.id}}</td>
										
										<td>{{correo.correo}}</td>
										<td v-if="isUpdatePermitted">
											<b-form-checkbox switch v-model="correo.estado" value="1" unchecked-value="0" @change='getHabilitar(correo, i)' >Default</b-form-checkbox>
											
											
										</td>
										
										<td>{{correo.correoNombre}}</td>
										
										<td>{{correo.cargo}}</td>
										
										
										<td>
											<button class="btn btn-primary btn-sm" @click="showEditModal(correo, i)" v-if="isUpdatePermitted"><span class="fa fa-edit"></span></button>
											<button class="btn btn-success btn-sm" @click="sedesRegModal(correo, i)" v-if="isWritePermitted"><span class="fas fa-map-marked-alt"></span></button>
											<button class="btn btn-danger btn-sm" @click="showdeletingModal(correo, i)" :loading="correo.isDeleting" v-if="isDeletePermitted"><span class="fa fa-trash"></span>Eliminar</button>
											
										</td>
									</tr>
								</tbody>
							</table>

						</div>

					</div>
				</div>
			</div>
		</div>
	
<b-modal  hide-footer v-model="addModal" title="Registrar Correo" :mask-closable="false" :closable="false" size="lg">

	<form v-on:submit.prevent="addCorreo(regData)">
		

        <b-container class="bv-example-row">

                <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                  <b-col>
                    <b-form-group id="input-group-1" label="correo :" label-for="correo" >
                          <b-form-input id="correo" v-model="regData.correo" type="email" placeholder="Ingresar el correo" >
                          </b-form-input>
                    </b-form-group>
                    <b-form-group  id="input-group-1" label="correoNombre :" label-for="correoNombre" >
                            <b-form-input id="correoNombre" v-model="regData.correoNombre" type="text" placeholder="Ingresar el titular del correo" >
                            </b-form-input>
                         </b-form-group>
                                       
                  </b-col>
                  <b-col>
                    	<b-form-group  id="input-group-1" label="cargo :" label-for="cargo">
                            <b-form-input id="cargo" v-model="regData.cargo" type="text" placeholder="Ingresar el cargo que ocupa" >
                            </b-form-input>
                         </b-form-group>

                         <b-form-group id="input-group-1" label="Seleccionar la Empres:" label-for="empresa_id">
					        <b-form-select v-model="regData.empresa_id"  class="mb-3" name="empresa_id" >
						      
						        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
						      
						      <b-form-select-option :value="empresa.id" v-for="(empresa, i) in empresas" :key="i" v-if="empresas.length">{{empresa.nombreEmpresa}}</b-form-select-option>
						      
						    </b-form-select>
					      </b-form-group>
     
                  </b-col>
                </b-row>

        </b-container>

          <br>
          <div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="addModal=false">Cancelar</button>
				
				<button class="btn btn-primary" ><span class="fa fa-check"></span>Registrar</button>
			</div>
                      
    </form>

</b-modal>

<b-modal  hide-footer v-model="editModal" title="Editar Correo" :mask-closable="false" :closable="false" size="lg">

	<form v-on:submit.prevent="editCorreo(editData)">
		

        <b-container class="bv-example-row">

                <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                  <b-col>
                    <b-form-group id="input-group-1" label="correo :" label-for="correo" >
                          <b-form-input id="correo" v-model="editData.correo" type="email" placeholder="Ingresar el correo" >
                          </b-form-input>
                    </b-form-group>
                    <b-form-group  id="input-group-1" label="correoNombre :" label-for="correoNombre" >
                            <b-form-input id="correoNombre" v-model="editData.correoNombre" type="text" placeholder="Ingresar el titular del correo" >
                            </b-form-input>
                         </b-form-group>
                                       
                  </b-col>
                  <b-col>
                    	<b-form-group  id="input-group-1" label="cargo :" label-for="cargo">
                            <b-form-input id="cargo" v-model="editData.cargo" type="text" placeholder="Ingresar el cargo que ocupa" >
                            </b-form-input>
                         </b-form-group>

                         <b-form-group id="input-group-1" label="Seleccionar la Empres:" label-for="empresa_id">
					        <b-form-select v-model="editData.empresa_id"  class="mb-3" name="empresa_id" >
						      
						        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
						      
						      <b-form-select-option :value="empresa.id" v-for="(empresa, i) in empresas" :key="i" v-if="empresas.length">{{empresa.nombreEmpresa}}</b-form-select-option>
						      
						    </b-form-select>
					      </b-form-group>
     
                  </b-col>
                </b-row>

        </b-container>

          <br>
          <div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="editModal=false">Cancelar</button>
				
				<button class="btn btn-primary"  ><span class="fa fa-check"></span>Actualizar</button>
			</div>
                      
    </form>

</b-modal>

<b-modal  hide-footer v-model="sedesModal" title="Asignar Sedes" :mask-closable="false" :closable="false" size="lg">
		<b-form-group>
      
        <b>Sedes:</b><br>
        
      </div>

        <b-form-checkbox-group
          id="sedes"
          v-model="seleccionado"
          :options="sedes"
          :aria-describedby="ariaDescribedby"
          name="sedes"
          class="ml-4"
          aria-label="Individual flavours"

          
          stacked

        ></b-form-checkbox-group>

        

      </b-form-group>

      <div>
      
        seleccionado: <strong>{{ seleccionado }}</strong><br>
      </div>

      <div class="text-ringth">
			<button type="button" class="btn btn-default" v-on:click="sedesModal=false">Cancelar</button>
			
			<button class="btn btn-primary" v-on:click="correoSedes()" ><span class="fa fa-check"></span>Actualizar</button>
		</div>

</b-modal>

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
				id : '',
				cargo : '',
				correo : '',
				correoNombre : '',
				
				
				estado : '',
				
			},

			// flavours: ['Orange', 'Grape', 'Apple', 'Lime', 'Very Berry'],
			

        sedesEstatico: [
          { text: 'JULIACA', value: '1' },
          { text: 'PUNO', value: '2' },
          { text: 'AZANGARO', value: '3' },
          { text: 'AYAVIRI', value: '4' },
          { text: 'SANDIA', value: '5' },
        ],

        

        selected: [1,2],
        seleccionado: [],
        flavours2: [],
        

			addModal:false,
			editModal:false,
			sedesModal:false,
			
			correos:[],
			empresas:[],
			sedes:[],
			sedes:{

			},

			regData:{

			},
			

			editData:{
				id : '',
				cargo : '',
				correo : '',
				correoNombre : '',
				
				empresa_id : '',
				estado : '',
				
				
				
			},
			index : -1,
			deleteItem: {},
			deletingIndex: -1,
			websiteSettings: [],

			
		}
	},


	methods : {
		
		
		async addCorreo(){
		/*
			if (this.data.dni.trim()=='') return this.$swal('DNI','Necesario','warning')
			if (this.data.nombre.trim()=='') return this.$swal('Nombres','Necesarios','warning')
			if (this.data.apellPat.trim()=='') return this.$swal('Apellido Paterno','Necesario','warning')
			if (this.data.apellMat.trim()=='') return this.$swal('Apellido Materno','Necesario','warning')
			if (this.data.sexo.trim()=='') return this.$swal('Seleccione sexo','Necesario','warning')
			if (this.data.fechaNacimiento.trim()=='') return this.$swal('Fecha de Nacimiento','Necesario','warning')
			if (this.data.direccion.trim()=='') return this.$swal('Direccion','Necesario','warning')
			if (this.data.telefono.trim()=='') return this.$swal('Telefono','Necesario','warning')
			if (this.data.email.trim()=='') return this.$swal('Email','Necesario','warning')
*/
			
			const res = await this.callApi('post', 'app/correo', this.regData)
			//const res = await this.callApi('post', 'app/persona', [this.data, this.distrito])
			
			
			if (res.status==201) {
				this.correos.unshift(res.data)

				
				this.$swal('Persona creado','Correctamente','success')
				
				
				this.addModal = false
				

			} else {
				if (res.status===422) {
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
		},

		async editCorreo(editData){
			
			

			//const res = await this.callApi('post', 'app/edit_tags', this.editData)
		
			const res = await this.callApi('put', `app/correo/${editData.id}`, this.editData)

			//const res = await this.callApi('post', 'back/app/user', this.editData)
				
			if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
				this.correos[this.index] = this.editData

				this.$swal('Excelent !','Actualizo sus datoscorrectamente','success')
				this.editModal = false
				
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
					this.$swal('Any fool can use a computer','de','error')
				}
			}
		},


		
		showEditModal(correo, index){
			let obj ={
				id : correo.id,
				cargo : correo.cargo,
				correo : correo.correo,
				correoNombre : correo.correoNombre,
				estado : correo.estado,
				
				empresa_id : correo.empresa_id,
				
				
				


			}
			this.editData = obj
			this.editModal = true
			this.index = index
		},

		async deleteCorreo(deleteItem, index){
			this.isDeleing = true
			//const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
			
			const res = await this.callApi('delete', `app/correo/${deleteItem.id}`, this.deleteItem)
			if(res.status==200){
				this.correos.splice(index, 1)
				/*this.$swal({
					  position: 'top-end',
					  icon: 'success',
					  title: 'Your work has been saved',
					  showConfirmButton: false,
					  timer: 1500
					});*/

			}else {
				this.$swal({
					  position: 'top-end',
					  icon: 'error',
					  title: 'Your work has been saved',
					  showConfirmButton: false,
					  timer: 1500
					});
			}
			this.isDeleing = false
			//this.showDeleteModal = false
		},

		showdeletingModal(correo, i){
		
			this.$swal({
		          title: '¿ Estas seguro ?',
		          text: 'No puedes revertir despues de esta accion',
		          icon: 'warning',
		          
		          showCancelButton: true,
		          confirmButtonColor: '#3085d6',
			  	  cancelButtonColor: '#d33',
		          confirmButtonText: 'Si, Eliminar!',
		          cancelButtonText: 'No, Mantener!',
		          showCloseButton: true,
		          showLoaderOnConfirm: true
		        }).then((result) => {
		          if(result.value) {
		          	this.deleteCorreo(correo, i)
		            this.$swal('Eliminado', 'Usted elimino el correo corecctamente', 'success')
		          } else {
		            this.$swal('Cancelado', 'Usted cancelo la accion', 'info')
		          }
		        })
		},

		buscarSedes: function(datoSedes) {
        	console.log('dentro de buscarSedes')
            axios.get('/back/app/sedesCorreo',{
            //axios.get(`/app/sedesCorreo`,{
             params: {
               idcorreo: this.datoSedes.id

             }
          }).then(function(res){
                this.flavours2 = res.data.datosCorreo;
                this.seleccionado = res.data.Seleccion;
                
                console.log('consultas',this.seleccionado)
            }.bind(this));

        },

		correoSedes: function(datoSedes) {

        	//const res = await this.callApi('put', `app/user/${editData.id}`, this.editData)
            axios.post(`app/correoSedes/${this.datoSedes.id}`,{
	            // params: {
	               pruebaxd: this.seleccionado

	             //}
	          }).then(function(response){

						


					if (response.status==200) {
	                	this.obsTipoExtraordinarios = response.data;
						
						this.$swal('Sedes actualizados','Correctamente','success')
						this.sedesModal = false
					} else {
						 
							this.$swal('Ocurrio algun problema','Intentelo nuevamente','warning')
						
					}


	            }.bind(this));

        },

		

		//async sedesRegModal(correo, i){
		sedesRegModal(correo, i){


			let obj ={
				id : correo.id,
				cargo : correo.cargo,
				correo : correo.correo,
				correoNombre : correo.correoNombre,
				estado : correo.estado,
				
				empresa_id : correo.empresa_id,
				
			}
			this.datoSedes = obj
			this.buscarSedes(correo, i)
			this.sedesModal = true
			this.index = index
			//const res = await this.callApi('post', 'app/correoSedes', [this.selected, {formData}])

			



		},

		getHabilitar: function(correo, index) {

        	//console.log('los datos son',correo.estado)
            axios.get('app/correoHabilitar',{
             params: {
               id: correo.id,
               estado: correo.estado
             }
          }).then(function(res){
                //this.distritos = response.data;
                if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
				this.correos[this.index] = correo

				this.$swal('Excelent !','Actualizo el estado correctamente','success')
				//this.editModal = false
				
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
					this.$swal('Ocurrio algun error','de','error')
				}
			}
            }.bind(this));

        },

		






	},



		async created(){
			try	{
				const [res, resc, ress] = await Promise.all([
					this.callApi('get', 'app/correo'),
					this.callApi('get', 'app/empresa'),
					//this.callApi('get', 'app/getSedeEmpresa')
					this.callApi('get', 'app/getEmpresaSede')
				])
			
				this.correos = res.data
				this.empresas = resc.data
				this.sedes = ress.data

				//console.log('esto esd:',this.departamentos)
				//console.log('esto es:',this.personas)
				//console.log('esto es:',this.departamentos)

			} catch {
				this.$swal('Any fool can use a computer','de','error')
			}

			

			
			
		},

}


  </script>