<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Aulas
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Aulas del sistema</a></li>
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
					Administrar Aulas
			</span>
		<button class="btn btn-primary btn-sm ml-auto" @click="addModal=true" v-if="isWritePermitted" ><span class="fa fa-plus"></span> Nuevo</button>
		 
		</div>
	</div>
		<div class="row">
			<div class="col-md-12  ml-auto mr-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">

							<table class="table table-hover">
								
								<thead>
									<tr>
										<td>ID</td>
										<td>nombre</td>
										<td>Sede</td>
										<td>Area</td>
										<td>Turno</td>
										<td>cantidad</td>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(aula, i) in aulas" :key="i" v-if="aulas.length">
										<td>{{aula.id}}</td>
										
										<td>{{aula.nameAula}}</td>
										<td>{{aula.sedes.nameSede}}</td>
										<td>{{aula.areas.nameArea}}</td>
										
										
										<td>{{aula.turnos.nameTurno}}</td>
										<td>
											<button class="btn btn-primary btn-sm" @click="showEditModal(aula, i)" v-if="isUpdatePermitted"><span class="fa fa-edit"></span></button>
											<button class="btn btn-danger btn-sm" @click="showdeletingModal(aula, i)" :loading="aula.isDeleting" v-if="isDeletePermitted"><span class="fa fa-trash"></span>Delete</button>
											
										</td>
									</tr>
								</tbody>
							</table>

						</div>

					</div>
				</div>
			</div>
		</div>
	
	<b-modal  hide-footer size="lg" v-model="addModal" title="Add aula" :mask-closable="false" :closable="false">
	
      <div class="d-block ">
        <form v-on:submit.prevent="addAula">

        	<b-container class="bv-example-row">
			  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			    <b-col>
			    	<b-form-group id="input-group-1" label="Nombre del aula :" label-for="nameAula" >
			        	<b-form-input id="nameAula" v-model="data.nameAula" type="text" placeholder="Ingresar nombre del aula" >
			        	</b-form-input>
			     	</b-form-group>

			     	
			     			     	 
			    </b-col>
			    <b-col>
			    	
				     <b-form-group  id="input-group-1" label="Cantidad de estudiantes :" label-for="capacidad" >
				        <b-form-input id="capacidad" v-model="data.capacidad" type="text" min="0" max="50" placeholder="Ingresar cantidad de estudiantes" >
				        </b-form-input>
				        <b-form-input id="range-2" v-model="data.capacidad" type="range" min="0" max="50" step="1"></b-form-input>
				        
				     </b-form-group>
			    </b-col>
			  </b-row>

			  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			    <b-col>
			    	<b-form-group  id="input-group-1" label="Estado del aula :" label-for="capacidad" >
				        <b-form-checkbox v-model="data.activo" name="activo" switch>
				      El aula esta <b>(Checked: {{ data.activo }})</b>
				    </b-form-checkbox>
				     </b-form-group>
			     	 
			    </b-col>
			    
			  </b-row>

			</b-container>

        	<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			    <b-col>

			    	<b-form-group id="input-group-1" label="Seleccionar el Sede:" label-for="sede_id">
				        <b-form-select v-model="data.sede_id"  class="mb-3" name="sede" @change='getLocal()' >
					      
					        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
					      
					      <b-form-select-option :value="sede.id" v-for="(sede, i) in sedes" :key="i" v-if="sedes.length">{{sede.nameSede}}</b-form-select-option>
					      
					    </b-form-select>
				      </b-form-group>



				</b-col>
				
				<b-col>

					<b-form-group id="input-group-1" label="Seleccionar Local:" label-for="local_id">
				        <b-form-select v-model="data.local_id"  class="mb-3" name="local">
					      
					        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
					      
					      <b-form-select-option :value="local.id" v-for="(local, i) in locales" :key="i" v-if="locales.length">{{local.nameLocal}}</b-form-select-option>
					      
					    </b-form-select>
				      </b-form-group>

				</b-col>
			  </b-row>


			  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			    <b-col>

			    	<b-form-group id="input-group-1" label="Seleccionar el Area:" label-for="area_id">
				        <b-form-select v-model="data.area_id"  class="mb-3" name="area" >
					      
					        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
					      
					      <b-form-select-option :value="area.id" v-for="(area, i) in areas" :key="i" v-if="areas.length">{{area.nameArea}}</b-form-select-option>
					      
					    </b-form-select>
				      </b-form-group>



				</b-col>
				
				<b-col>

					<b-form-group id="input-group-1" label="Seleccionar Turno:" label-for="turno_id">
				        <b-form-select v-model="data.turno_id"  class="mb-3" name="turno">
					      
					        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
					      
					      <b-form-select-option :value="turno.id" v-for="(turno, i) in turnos" :key="i" v-if="turnos.length">{{turno.nameTurno}}</b-form-select-option>
					      
					    </b-form-select>
				      </b-form-group>

				</b-col>
			  </b-row>

			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="addModal=false">Cancelar</button>
				
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Adding..' : 'Add aula'}}</button>
			</div>
        	</form>
        
      </div>
	</b-modal>

	<b-modal  hide-footer size="lg" v-model="editModal" title="Add aula" :mask-closable="false" :closable="false">
	
      <div class="d-block ">
        <form v-on:submit.prevent="editAula(editData)">

        	<b-container class="bv-example-row">
			  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			    <b-col>
			    	<b-form-group id="input-group-1" label="Nombre del aula :" label-for="nameAula" >
			        	<b-form-input id="nameAula" v-model="editData.nameAula" type="text" placeholder="Ingresar nombre del aula" >
			        	</b-form-input>
			     	</b-form-group>

			     	
			     			     	 
			    </b-col>
			    <b-col>
			    	
				     <b-form-group  id="input-group-1" label="Cantidad de estudiantes :" label-for="capacidad" >
				        <b-form-input id="capacidad" v-model="editData.capacidad" type="text" min="0" max="50" placeholder="Ingresar cantidad de estudiantes" >
				        </b-form-input>
				        <b-form-input id="range-2" v-model="editData.capacidad" type="range" min="0" max="50" value="editData.capacidad" step="1"></b-form-input>

				    </b-form-group>

				    

			    </b-col>
			  </b-row>

			  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			    <b-col>
			    	<b-form-group  id="input-group-1" label="Estado del aula :" label-for="capacidad" >
				        <b-form-checkbox v-model="editData.activo" name="activo" value="1" switch>
				      El aula esta <b>(Checked: {{ editData.activo }})</b>
				    </b-form-checkbox>
				     </b-form-group>
			     	 
			    </b-col>
			    
			  </b-row>

			</b-container>

        	<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			    <b-col>

			    	<b-form-group id="input-group-1" label="Seleccionar el Sede:" label-for="sede_id">
				        <b-form-select v-model="editData.sede_id"  class="mb-3" name="sede" @change='getLocal()' >
					      
					        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
					      
					      <b-form-select-option :value="sede.id" v-for="(sede, i) in sedes" :key="i" v-if="sedes.length">{{sede.nameSede}}</b-form-select-option>
					      
					    </b-form-select>
				      </b-form-group>



				</b-col>
				
				<b-col>

					<b-form-group id="input-group-1" label="Seleccionar Local:" label-for="local_id">
				        <b-form-select v-model="editData.local_id"  class="mb-3" name="local">
					      
					        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
					      
					      <b-form-select-option :value="local.id" v-for="(local, i) in locales" :key="i" v-if="locales.length">{{local.nameLocal}}</b-form-select-option>
					      
					    </b-form-select>
				      </b-form-group>

				</b-col>
			  </b-row>


			  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			    <b-col>

			    	<b-form-group id="input-group-1" label="Seleccionar el Area:" label-for="area_id">
				        <b-form-select v-model="editData.area_id"  class="mb-3" name="area" >
					      
					        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
					      
					      <b-form-select-option :value="area.id" v-for="(area, i) in areas" :key="i" v-if="areas.length">{{area.nameArea}}</b-form-select-option>
					      
					    </b-form-select>
				      </b-form-group>



				</b-col>
				
				<b-col>

					<b-form-group id="input-group-1" label="Seleccionar Turno:" label-for="turno_id">
				        <b-form-select v-model="editData.turno_id"  class="mb-3" name="turno">
					      
					        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
					      
					      <b-form-select-option :value="turno.id" v-for="(turno, i) in turnos" :key="i" v-if="turnos.length">{{turno.nameTurno}}</b-form-select-option>
					      
					    </b-form-select>
				      </b-form-group>

				</b-col>
			  </b-row>

			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="editModal=false">Cancelar</button>
				
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Adding..' : 'Add aula'}}</button>
			</div>
        	</form>
        
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

				nameAula: '',
				activo: false,
				capacidad: '',
				sede_id:'',
				area_id:'',
				local_id:'',
				turno_id:'',
				nameSede:'',
				

				
			},

			local: {
				id: 0,
				nameLocal: '',

			},
			area: {
				id: 0,
				nameArea: '',

			},
			editData : {

				nameAula: '',
				activo: '',
				capacidad: '',
				sede_id:'',
				area_id:'',
				local_id:'',
				turno_id:'',
				
			},

			aulas: [],
			locales: [],
			areas: [],
			pareas: [],
			sedes: [],
			turnos: [],
			addModal: false,
			editModal: false,
			isAdding : false,

			index : -1,
			
			isDeleing: false,
			deleteItem: {},
			deletingIndex: -1,
			
		}
	},


	methods : {

		async addAula(){
			if (this.data.nameAula.trim()=='') return this.$swal('Nombre del Aula','Necesario','warning')
			if (this.data.capacidad.trim()=='') return this.$swal('Capacidad de estudiantes','Necesarios','warning')
			if (this.data.sede_id=='') return this.$swal('La sede es ','Necesario','warning')
			if (this.data.local_id=='') return this.$swal('El local es','Necesario','warning')
			if (this.data.area_id=='') return this.$swal('El area es','Necesario','warning')
			if (this.data.turno_id=='') return this.$swal('El turno es ','Necesario','warning')

			
			const res = await this.callApi('post', 'app/aula', this.data)
			

			/*const notaNueva = this.nota;
		      this.nota = {nombre: '', descripcion: ''};    
		      axios.post('app/aula', notaNueva)
		        .then((res) =>{
		          const notaServidor = res.data;
		          this.notas.push(notaServidor);
		        })*/

			
			//console.log(this.data)
			if (res.status==201) {

				//this.aulas.unshift(res.data)
				//this.aulas.push(res.data);

				this.$swal('Aula creada','Correctamente','success')
				//mientras salga algo mejor
				window.location='/back/aula'
				//window.location.href = '/back/aula';
				//this.$router.push('/back/aula') 

				
				//this.areas.unshift(res.data)
				
				
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

		async editAula(editData){
			
			if (this.editData.nameAula.trim()=='') return this.$swal('Nombre del Aula','Necesario','warning')
			
			if (this.editData.capacidad=='') return this.$swal('Capacidad de estudiantes','Necesarios','warning')
			if (this.editData.sede_id=='') return this.$swal('La sede es ','Necesario','warning')
			if (this.editData.local_id=='') return this.$swal('El local es','Necesario','warning')
			if (this.editData.area_id=='') return this.$swal('El area es','Necesario','warning')
			if (this.editData.turno_id=='') return this.$swal('El turno es ','Necesario','warning')

			//const res = await this.callApi('post', 'app/edit_tags', this.editData)
		
			const res = await this.callApi('put', `app/aula/${editData.id}`, this.editData)
			//const res = await this.callApi('post', 'back/app/user', this.editData)
				
			if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
				//mientras
				//this.aulas[this.index] = this.editData
				this.$swal('Excelent !','Actualizo sus datoscorrectamente','success')
				window.location='/back/aula'
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

		
		showEditModal(aula, index){
			let obj ={
				id : aula.id,
				nameAula : aula.nameAula,
				activo : aula.activo,
				capacidad : aula.capacidad,
				sede_id : aula.sede_id,
				area_id : aula.area_id,
				local_id : aula.local_id,
				turno_id : aula.turno_id,

			}
			this.editData = obj
			this.editModal = true
			this.index = index
		},

		async deleteAula(deleteItem, index){
			this.isDeleing = true
			//const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
			
			const res = await this.callApi('delete', `app/aula/${deleteItem.id}`, this.deleteItem)
			if(res.status==200){
				this.aulas.splice(index, 1)
				

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

		showdeletingModal(aula, i){
			
			
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
		          	this.deleteAula(aula, i)
		            this.$swal('Eliminado', 'Usted elimino el registro corecctamente', 'success')
		          } else {
		            this.$swal('Cancelado', 'Usted cancelo la accion', 'info')
		          }
		        })
		},




		getLocal: function() {
        	
            axios.get('app/getLocal',{
             params: {
               sede_id: this.data.sede_id
             }
          }).then(function(response){
                this.locales = response.data;
            }.bind(this));

        },


	},


		

		

		async created(){
			try	{
				const [res, resSed, resAre, resTur] = await Promise.all([
					this.callApi('get', 'app/aula'),
					this.callApi('get', 'app/getSede'),
					this.callApi('get', 'app/getArea'),
					this.callApi('get', 'app/getTurno')
				])
			
				this.aulas = res.data.aula
				this.pareas = res.data.area
				this.sedes = resSed.data
				this.areas = resAre.data
				this.turnos = resTur.data

				console.log('esto esd:',this.pareas)
				//console.log('esto es:',this.personas)
				//console.log('esto es:',this.departamentos)

			} catch {
				this.$swal('Any fool can use a computer','de','error')
			}

			

			
			
		},


	




}




  </script>