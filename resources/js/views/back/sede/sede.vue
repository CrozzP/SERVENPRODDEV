<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> sedes
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Sedes del sistema</a></li>
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
					Administrar Sedes
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
										<td>Sede</td>
										<td v-if="isUpdatePermitted">Estado</td>
										
										
										
										
										<td>Acciones</td>
									</tr>
								</thead>
								<tbody>
									 
									<tr v-for="(sede, i) in sedes" :key="i" v-if="sedes.length">
										<td>{{sede.id}}</td>
										
										<td>{{sede.nombre}}</td>
										<td v-if="isUpdatePermitted">
											<b-form-checkbox switch v-model="sede.estado" value="1" unchecked-value="0" @change='getHabilitar(sede, i)' >Default</b-form-checkbox>
											
											
										</td>
										
										
										
										
										
										
										<td>
											<button class="btn btn-primary btn-sm" @click="showEditModal(sede, i)" v-if="isUpdatePermitted"><span class="fa fa-edit"></span></button>
											<button class="btn btn-danger btn-sm" @click="showdeletingModal(sede, i)" :loading="sede.isDeleting" v-if="isDeletePermitted"><span class="fa fa-trash"></span>Delete</button>
											<button class="btn btn-success btn-sm" @click="asignarEmpresa(sede, i)" v-if="isWritePermitted"><span class="fa fa-trash"></span>Asignar sedes</button>
											
										</td>
									</tr>
								</tbody>
							</table>

						</div>

					</div>
				</div>
			</div>
		</div>
	
<b-modal  hide-footer v-model="addModal" title="Registrar Sede" :mask-closable="false" :closable="false" size="lg">

	<form v-on:submit.prevent="addSede(regData)">
		

        <b-container class="bv-example-row">

                <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                  <b-col>
                    
                    <b-form-group  id="input-group-1" label="nombre :" label-for="nombre" >
                            <b-form-input id="nombre" v-model="regData.nombre" type="text" placeholder="Ingresar la sede" >
                            </b-form-input>
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

<b-modal  hide-footer v-model="editModal" title="Editar sede" :mask-closable="false" :closable="false" size="lg">

	<form v-on:submit.prevent="editsede(editData)">
		

        <b-container class="bv-example-row">

                <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                  <b-col>
                    
                    <b-form-group  id="input-group-1" label="nombre :" label-for="nombre" >
                            <b-form-input id="nombre" v-model="editData.nombre" type="text" placeholder="Ingresar la sede" >
                            </b-form-input>
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

<b-modal  hide-footer v-model="empresasModal" title="Asignar Empresa" :mask-closable="false" :closable="false" size="lg">
	<b-form-group>
      
        <b>Empresa:</b><br>
        
      </div>

       <b-form-checkbox-group
      	id="empresas"
        v-model="seleccionado"
        :options="empresas"
        :aria-describedby="ariaDescribedby"
        name="flavour-2a"
        switches
        stacked
      ></b-form-checkbox-group>

        

      </b-form-group>

      <div>
      
        seleccionado: <strong>{{ seleccionado }}</strong><br>
      </div>

      <div class="text-ringth">
			<button type="button" class="btn btn-default" v-on:click="empresasModal=false">Cancelar</button>
			
			<button class="btn btn-primary" v-on:click="sedeEmpresas()" ><span class="fa fa-check"></span>Actualizar</button>
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
				sede : '',
				sedeNombre : '',
				
				
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
			empresasModal:false,
			
			sedes:[],
			
			empresas:{},
			
			
			regData:{

			},
			

			editData:{
				id : '',
				cargo : '',
				sede : '',
				sedeNombre : '',
				
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
		
		
		async addSede(){
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
			
			const res = await this.callApi('post', 'app/sede', this.regData)
			//const res = await this.callApi('post', 'app/persona', [this.data, this.distrito])
			
			
			if (res.status==201) {
				this.sedes.unshift(res.data)

				
				this.$swal('Sede creado','Correctamente','success')
				
				
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

		async editsede(editData){
			
			

			//const res = await this.callApi('post', 'app/edit_tags', this.editData)
		
			const res = await this.callApi('put', `app/sede/${editData.id}`, this.editData)

			//const res = await this.callApi('post', 'back/app/user', this.editData)
				
			if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
				this.sedes[this.index] = this.editData

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


		
		showEditModal(sede, index){
			let obj ={
				
				id : sede.id,
				nombre : sede.nombre,
				estado : sede.estado,
				
				
				
				
				


			}
			this.editData = obj
			this.editModal = true
			this.index = index
		},

		async deletesede(deleteItem, index){
			this.isDeleing = true
			//const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
			
			const res = await this.callApi('delete', `app/sede/${deleteItem.id}`, this.deleteItem)
			if(res.status==200){
				this.sedes.splice(index, 1)
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

		showdeletingModal(sede, i){
		
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
		          	this.deletesede(sede, i)
		            this.$swal('Eliminado', 'Usted elimino el sede corecctamente', 'success')
		          } else {
		            this.$swal('Cancelado', 'Usted cancelo la accion', 'info')
		          }
		        })
		},

		buscarEmpresas: function(datoSedes) {
        	console.log('dentro de buscarSedes')
            axios.get('/back/app/sedeEmpresa',{
            //axios.get(`/app/sedessede`,{
             params: {
               idsede: this.datoSedes.id

             }
          }).then(function(res){
                this.flavours2 = res.data.datosempresa;
                this.seleccionado = res.data.Seleccion;
                
                console.log('consultas',this.seleccionado)
            }.bind(this));

        },

		sedeEmpresas: function(datoSedes) {

        	//const res = await this.callApi('put', `app/user/${editData.id}`, this.editData)
            axios.post(`app/sedeEmpresas/${this.datoSedes.id}`,{
	            // params: {
	               pruebaxd: this.seleccionado

	             //}
	          }).then(function(response){

		

					if (response.status==200) {
	                	this.obsTipoExtraordinarios = response.data;
						
						this.$swal('Sedes actualizados','Correctamente','success')
						this.empresasModal = false
					} else {
						 
							this.$swal('Ocurrio algun problema','Intentelo nuevamente','warning')
						
					}


	            }.bind(this));

        },

		
		//async sedesRegModal(sede, i){
		asignarEmpresa(sede, i){


			let obj ={
				id : sede.id,
				cargo : sede.cargo,
				sede : sede.sede,
				sedeNombre : sede.sedeNombre,
				estado : sede.estado,
				
				empresa_id : sede.empresa_id,
				
			}
			this.datoSedes = obj
			this.buscarEmpresas(sede, i)
			this.empresasModal = true
			this.index = index
			//const res = await this.callApi('post', 'app/sedeSedes', [this.selected, {formData}])
		},

		getHabilitar: function(sede, index) {

        	//console.log('los datos son',sede.estado)
            axios.get('app/sedeHabilitar',{
             params: {
               id: sede.id,
               estado: sede.estado
             }
          }).then(function(res){
                //this.distritos = response.data;
                if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
				this.sedes[this.index] = sede

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
				const [res, resc] = await Promise.all([
					this.callApi('get', 'app/sede'),

					this.callApi('get', 'app/getSedeEmpresa')
				])
			
				this.sedes = res.data
				this.empresas = resc.data
				

				//console.log('esto esd:',this.departamentos)
				//console.log('esto es:',this.personas)
				//console.log('esto es:',this.departamentos)

			} catch {
				this.$swal('Any fool can use a computer','de','error')
			}

			

			
			
		},

}


  </script>