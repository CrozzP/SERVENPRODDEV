<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Usuarios
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Usuarios del sistema</a></li>
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
								Administrar Usuarios
						</span>
					

					<div class="form-inline my-2 my-lg-0 ml-auto" >


						 <div>
    
    						<b-dropdown id="dropdown-buttons" variant="primary"  text="Seleccionar Sedes" class="m-2" >
    
					        <b-form-checkbox-group
					          id="searchData.sede"
					          v-model="searchData.sede"
					          :options="sedeFiltros"
					          name="searchData.sede"

					          
										switches
					          stacked
					        ></b-form-checkbox-group>
  							</b-dropdown>

  						</div>

                        <b-form-select v-model="searchData.tipoSearch" :options="options" ></b-form-select>
								<b-form-input id="search"  v-model="searchData.search" type="text" placeholder="Search" aria-label="Search" v-on:keyup.enter="getResults">
                        </b-form-input>


			            <button class="btn btn-outline-primary my-2 my-sm-0" @click="getResults"><span class="fas fa-search"></span> Buscars</button>

						
					</div >
                  <b-button variant="primary" @click="addModal=true" v-if="isWritePermitted"><span class="fas fa-plus"></span> Nuevo</b-button>
						
					 
					</div>
				</div>


		<div class="row"  v-if="mostrar">
			<div class="col-md-12  ml-auto mr-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">
							
								
								
							<table class="table table-hover">
								
								<thead>
									<tr>
										<td>ID</td>
										<td>USUARIO</td>
										<td>NOMBRES</td>
										<td>EMAIL</td>
										<td>ACCIONES</td>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(user, i) in users.data" :key="i" v-if="users.data.length">
										<td>{{user.id}}</td>
										<td>
										<!--td @click="prueba(user, i)"-->
										 
										 <a v-bind:href="'/back/app/user/'+user.id">
										                
										 
												<span class="sub-item">{{user.name}}</span>
											</a>
										 

											
										</td>
										<td>{{user.fullName}}</td>
										<td>{{user.email}}</td>
										
									
										<td>
											

											
											<b-dropdown id="dropdown-dropleft" dropleft text="Acciones" variant="outline-primary" class="m-2">
                                 <button class="btn btn-primary btn-sm" @click="showEditModal(user, i)" v-if="isWritePermitted" ><span class="fa fa-edit"></span></button>
											<button class="btn btn-primary btn-sm" @click="getShowUser(user, i)" v-if="isWritePermitted" ><span class="fa fa-eye"></span></button>
											<button class="btn btn-success btn-sm" @click="showEditPassModal(user, i)" v-if="isWritePermitted" ><span class="fas fa-feather-alt"></span></button>
											<button class="btn btn-danger btn-sm" @click="showdeletingModal(user, i)" :loading="user.isDeleting" v-if="isDeletePermitted"><span class="fa fa-trash"></span>Delete</button>

  							</b-dropdown>

											
										</td>
									</tr>
								</tbody>
							</table>
							
							
						</div>
						<div class="card mb-3">

								
							<advanced-laravel-vue-paginate :data="users" @paginateTo="getResultsGeneral"></advanced-laravel-vue-paginate>


							

		
							</div>

					</div>
				</div>
			</div>
		</div>

		<div class="row"  v-if="mostrarBusqueda">
			<div class="col-md-12  ml-auto mr-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">
							
								
								
							<table class="table table-hover">
								
								<thead>
									<tr>
										<td>ID</td>
										<td>USUARIO</td>
										<td>NOMBRES</td>
										<td>EMAIL</td>
										<td>ACCIONES</td>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(user, i) in buscarUsers.data" :key="i" v-if="buscarUsers.data.length">
										<td>{{user.id}}</td>
										<td>
										<!--td @click="prueba(user, i)"-->
										 
										 <a v-bind:href="'/back/app/user/'+user.id">
										                
										 
												<span class="sub-item">{{user.name}}</span>
											</a>
										 

											
										</td>
										<td>{{user.fullName}}</td>
										<td>{{user.email}}</td>
										
									
										<td>

                                 <b-dropdown id="dropdown-dropleft" dropleft text="Acciones" variant="outline-primary" class="m-2">
                                 <button class="btn btn-primary btn-sm" @click="showEditModal(user, i)" v-if="isWritePermitted" ><span class="fa fa-edit"></span></button>
                                 <button class="btn btn-primary btn-sm" @click="getShowUser(user, i)" v-if="isWritePermitted" ><span class="fa fa-eye"></span></button>
                                 <button class="btn btn-success btn-sm" @click="showEditPassModal(user, i)" v-if="isWritePermitted" ><span class="fas fa-feather-alt"></span></button>
                                 <button class="btn btn-danger btn-sm" @click="showdeletingModal(user, i)" :loading="user.isDeleting" v-if="isDeletePermitted"><span class="fa fa-trash"></span>Delete</button>

  							</b-dropdown>

											
										</td>
									</tr>
								</tbody>
							</table>
							
							
						</div>
						<div class="card mb-3">

								
							<advanced-laravel-vue-paginate :data="buscarUsers" @paginateTo="getResults"></advanced-laravel-vue-paginate>


							

		
							</div>

					</div>
				</div>
			</div>
		</div>
	

	<b-modal  hide-footer v-model="addModal" title="Registrar Usuario" :mask-closable="false" :closable="false" size="lg">
   
        <form v-on:submit.prevent="addUser">
            <b-row>
               <b-col sm="12" lg="6">
                  <b-form-group
                     label="Apellidos y Nombres:"
                     label-for="apellNom"
                     class="mb-0"
                   >
                     <b-form-input
                       id="apellNom"
                       v-model="data.fullName"
                       placeholder="Ingresar datos"
                     ></b-form-input>
                   </b-form-group>

                  <b-form-group
                     label="Ingresar Usuario:"
                     label-for="usuario"
                     class="mb-0"
                   >
                     <b-form-input
                       id="usuario"
                       v-model="data.name"
                       placeholder="Ingresar datos"
                     ></b-form-input>
                   </b-form-group>

                  <b-form-group
                     label="Email:"
                     label-for="email"
                     class="mb-0"
                   >
                     <b-form-input
                       id="email"
                       v-model="data.email"
                       placeholder="Ingresar datos"
                       type="email"
                     ></b-form-input>
                   </b-form-group>
                   
                  <b-form-group
                     label="Contraseña:"
                     label-for="contraseña"
                     class="mb-0"
                   >
                     <b-form-input
                       id="contraseña"
                        v-model="data.password"
                       placeholder="Ingresar datos"
                       type="password" 
                     ></b-form-input>
                   </b-form-group>

         			
			<!--
			<div class="form-group">
			    <label for="password-confirm">ingresar password</label>
			    <input type="password" v-model="data.password-confirm" class="form-control" id="password_confirmation" name="password_confirmation" >
			</div>
			-->
               </b-col>
               <b-col sm="12" lg="6">
                  <b-form-group id="input-group-1" label="Seleccionar Tipo de Usuario: (presionar Ctrl)" label-for="role_id">
      		        <b-form-select v-model="data.role"  class="mb-3" name="role" multiple :select-size="6">
      			      
      			      <b-form-select-option :value="role.id" v-for="(role, i) in roles" :key="i" v-if="roles.length">{{role.roleName}}</b-form-select-option>
      			      
      			    </b-form-select>
      		      </b-form-group>

      		      <b-form-group id="input-group-1" label="Seleccionar Empresa:" label-for="empresa_id">
      		        <b-form-select v-model="data.empresa_id" class="mb-3" name="empresa_id"  @change='getSede()'>
      			     
      			      <b-form-select-option :value="empresa.id" v-for="(empresa, i) in empresas" :key="i" v-if="empresas.length">{{empresa.nombreEmpresa}}</b-form-select-option>
      			      
      			    </b-form-select>
      		      </b-form-group>

      		    <b-form-group id="input-group-1" label="Seleccionar sede:" label-for="sede_id">
      		        <b-form-select v-model="data.sede_id" class="mb-3" name="sede" multiple  >
      			      
      			        <b-form-select-option :value="sede.id" v-for="(sede, i) in sedes" :key="i" v-if="sedes.length">{{sede.nombre}}</b-form-select-option>
      			    </b-form-select>
      		    </b-form-group>
                  
               </b-col>
            </b-row>


			<div class="text-center">
				<button type="button" class="btn btn-default" v-on:click="addModal=false">Cancelar</button>
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>Registrar</button>
			</div>
        	</form>
        
	</b-modal>

	<b-modal  hide-footer v-model="editModal" title="Editar usuario" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="editUsuario(editData)">
        	<div class="form-group">
			    <label for="name">Enter Name</label>
			    <input type="text" v-model="editData.name" class="form-control" id="name" >
			</div>

			<div class="form-group">
			    <label for="fullName">ingresar descripcion</label>
			    <input type="text" v-model="editData.fullName" class="form-control" id="fullName" >
			</div>

			<div class="form-group">
			    <label for="email">ingresar descripcion</label>
			    <input type="email" v-model="editData.email" class="form-control" id="email" >
			</div>

         <div class="form-group">   
            <h7>Roles Seleccionados:    
               <b-badge pill variant="primary" v-for="(user, i) in editData.roles" :key="i" v-if="editData.roles.length">{{user.roleName}}</b-badge>    
            </h7>
         </div>

         <b-form-group id="input-group-1" label="Seleccionar Tipo de Usuario: (presionar Ctrl)" label-for="role_id">
           <b-form-select v-model="editData.roleR"  class="mb-3" name="role" multiple :select-size="6">
            <b-form-select-option :value="role.id" v-for="(role, i) in roles" :key="i" v-if="roles.length" :disabled="( (role.id == editData.roleR) ? true:false )" >{{role.roleName}}</b-form-select-option>

            
          </b-form-select>
         </b-form-group>

         <div class="form-group">   
            <h7>Empresa Seleccionado:    
               <b-badge pill variant="primary" v-for="(empresa, i) in editData.empresas" :key="i" v-if="editData.empresas.length">{{empresa.nombreEmpresa}}</b-badge>    
            </h7>
         </div>

			<b-form-group id="input-group-1" label="Seleccionar Empresa:" label-for="empresa_id">
		        <b-form-select v-model="editData.empresaR"  class="mb-3" name="empresa_id"  @change='getSedeEdit()' >
			      
			        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
			     
			     
			      <b-form-select-option :value="empresa.id" v-for="(empresa, i) in empresas" :key="i" v-if="empresas.length">{{empresa.nombreEmpresa}}</b-form-select-option>
			      
			    </b-form-select>
		      </b-form-group>

         <div class="form-group">   
            <h7>Sedes Seleccionados:    
               <b-badge pill variant="primary" v-for="(sede, i) in editData.sedes" :key="i" v-if="editData.sedes.length">{{sede.nombre}}</b-badge>    
            </h7>
         </div>

		    <b-form-group id="input-group-1" label="Seleccionar Sedes:" label-for="sede_id">
		        <b-form-select v-model="editData.sede_i" class="mb-3" name="sede"  multiple>
			      
			        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
			      
			        <b-form-select-option :value="sede.id" v-for="(sede, i) in sedes" :key="i" v-if="sedes.length">{{sede.nombre}}</b-form-select-option>
			    </b-form-select>


		    </b-form-group>

			
			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="editModal=false">Cancelar</button>
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Editing..' : 'Edit tag'}}</button>
				
			</div>
        	</form>
        
      </div>
	</b-modal>

<b-modal  hide-footer v-model="editPassModal" title="Add user" :mask-closable="false" :closable="false">
	<form v-on:submit.prevent="editPassUsuario(editPassData)">
		<div class="form-group">
		    <label for="old_password">ingresar Contraseña actual</label>
		    <input type="password" v-model="dataPassEdit.old_password" class="form-control" id="old_password" >
		</div>
		<div class="form-group">
		    <label for="password">ingresar password</label>
		    <input type="password" v-model="dataPassEdit.password" class="form-control" id="password" >
		</div>
		<div class="form-group">
			    <label for="password-confirm">ingresar password</label>
			    
			    <input type="password" id="password_confirmation" class="form-control" placeholder="" v-model="dataPassEdit.password_confirmation" required>
			</div>
		<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="editPassModal=false">Cancelar</button>
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Editing..' : 'Edit Password'}}</button>
				
			</div>
	</form>
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
				name: '',
				fullName: '',
				email: '',
				
				password: '',
				role:[],
				

			},
			searchData: {
            tipoSearch: null,},
			editarActivo: true,
			
			addModal : false,
			editModal : false,
			editPassModal : false,
			isAdding : false,
			users : [],
			buscarUsers: {},
			roles : [],
			empresas : [],
			sedes : [],
			sedeFiltros : [],
			usuario:{},

			dataPassEdit:{

			},
			visible: false,
			mostrar: true,
			mostrarBusqueda: false,
			
			
			roles : {
				id: '',
				roleName: '',
				
			},
			xd: [],

			editData : {
				name: '',
				fullName: '',
				email: '',
				id: '',

				
				
			},
			index : -1,
			showDeleteModal: false,
			isDeleing: false,
			deleteItem: {},
			deletingIndex: -1,
			websiteSettings: [],

			options: [
	          { value: null, text: 'Seleccione tipo busqueda', disabled: true },
	          { value: 'name', text: 'Usuario' },
	          { value: 'fullName', text: 'Nombres' },
	          { value: 'email', text: 'Correo' }
	          
	        ],
        
		}
	},
 

	methods : {
		async addUser(){
			if (this.data.name.trim()=='') return this.$swal('Nombre del rol','Requerido','warning')
			if (this.data.fullName.trim()=='') return this.$swal('Nombres completos son ','Requeridos','warning')
			if (this.data.email.trim()=='') return this.$swal('Email es','Requerido','warning')

			
			const res = await this.callApi('post', 'app/user', this.data)
			
			
			if (res.status==201) {
				this.users.data.unshift(res.data)
				//this.$swal('Hello Vue world!!!');
				this.$swal('Usuario creado','Correctamente','success');
				//Swal.fire('Any fool can use a computer','de','success');
				/*this.flashMessage.success({
						message: 'Categoria creada',
						time: 5000
					})*/
				this.addModal = false
				this.data.roleName = ''
				this.data.description = ''
				this.data.role = ''
				this.data.sede_id = ''
				this.data.name = ''
				this.data.fullName = ''
				this.data.empresa_id = ''
				this.data.email = ''

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
		},

		async editUsuario(editData){
			
			if (this.editData.name.trim()=='') return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'Nombre del usuario requerido',
					  showConfirmButton: false,
					  timer: 5000
					});
			if (this.editData.fullName.trim()=='') return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'Nombres completos son requeridos',
					  showConfirmButton: false,
					  timer: 5000
					});
			if (this.editData.email.trim()=='') return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'Email requeridar',
					  showConfirmButton: false,
					  timer: 5000
					});

			//const res = await this.callApi('post', 'app/edit_tags', this.editData)
		
			const res = await this.callApi('put', `app/user/${editData.id}`, this.editData)
			//const res = await this.callApi('post', 'back/app/user', this.editData)
				
			if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
				this.users[this.index] = this.editData
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
		showEditModal(user, index){
			let obj ={
				id : user.id,
				name : user.name,
				email : user.email,
				fullName : user.fullName,
				sede_id : user.sede_id,
            roles: user.roles,
            sedes: user.sedes,
            empresas : user.empresas,
            roleR : user.roleR,
            empresaR : user.empresaR,
            sedeR: user.sedeR,


			}
         this.sedes = ''
			this.editData = obj
			this.editModal = true
			this.index = index
		},

		async deleteUser(deleteItem, index){
			this.isDeleing = true
			//const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
			
			const res = await this.callApi('delete', `app/user/${deleteItem.id}`, this.deleteItem)
			if(res.status==200){
				this.users.splice(index, 1)
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

		showdeletingModal(user, i){

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
		          	this.deleteUser(user, i)
		            this.$swal('Eliminado', 'Usted elimino el registro corecctamente', 'success')
		          } else {
		            this.$swal('Cancelado', 'Usted cancelo la accion', 'info')
		          }
		        })
		},

		async editPassUsuario(editPassData){

			const res = await this.callApi('put', `app/user/change_password/${editPassData.id}`, this.dataPassEdit)

			//const res = await this.callApi('post', 'back/app/user', this.editData)
				
			if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
				this.users[this.index] = this.editPassData

				this.$swal('Excelent !','Actualizo sus datoscorrectamente','success')
				this.editPassModal = false
				
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


		showEditPassModal(user, index){
			let obj ={
				id : user.id,
				name : user.name,
				email : user.email,
				fullName : user.fullName,


			}
			this.editPassData = obj
			this.editPassModal = true
			this.index = index
		},

		getSede: function() {
        	
            axios.get('/back/app/getSede',{
             params: {
               empresa_id: this.data.empresa_id

             }
          }).then(function(response){
                this.sedes = response.data;
            }.bind(this));

        },

		getSedeEdit: function() {
         console.log('___---__-',this.editData.empresaR)
        	
            axios.get('/back/app/getSede',{
             params: {
               empresa_id: this.editData.empresaR

             }
          }).then(function(response){
                this.sedes = response.data;
            }.bind(this));

        },

    


    

      


       getShowUser: function (user, index) {
       	console.log('datos enviados',user)

       	axios.get('app/getShowUser',{
                   params: {
                     
                     user_id: user.id
                     
                   }
                }).then(function(response){
                	if (response.data.length === 0) {
                			this.personaID = {nombre: ''};

                	//console.log('lipio',response.data)
                	}else {

                	//console.log('busqueda de la persona',response.data)
                	this.personaID = response.data
                	}
                     // this.personaID = response.data
                      

                      //console.log('id de la persona es:', this.estudiantesID[0].id)
                      //console.log('id de la persona es:', this.personaID)

                  }.bind(this));
           
          
        },

        

        getResults(page = 1) {
            axios.get('app/usuarioFiltrar?page=' + page,{
	             params: {
	             	tipoSearch: this.searchData.tipoSearch,
	               	search: this.searchData.search,
	               	sedesBus: this.searchData.sede

	             }
	          })
                .then(response => {
                    this.buscarUsers = response.data;
                    //this.buscarExtraordinarioR = response.data;
                    this.mostrarBusqueda = true
                    this.mostrar = false
                   
                    console.log(response.data)
                });
        },

        getResultsGeneral(page = 1) {
            axios.get('app/user?page=' + page,{
	             params: {
	             	

	             }
	          })
                .then(response => {
                    //this.buscarExtraordinarios = response.data;
                    //this.buscarExtraordinarioR = response.data;
                    //this.mostrarBusqueda = true
                    //this.mostrar = false
                    console.log('datos buscados____',response.data )
                    //this.users= response.data
                    this.users = response.data['users']
                    this.userLogged = response.data['userLogged']
                   
                   // console.log(response.data)
                });
        },

	

		

			




	},



	async created(){
	try	{
		//console.log(this.isWritePermitted)
		//console.log('esto es el permiso')
		this.getResultsGeneral();
		

		//const [res, resRol, resEmp, resSedFil] = await Promise.all([
		const [resRol, resEmp, resSedFil] = await Promise.all([
				//this.callApi('get', 'app/user'),
				this.callApi('get', 'app/role'),
				this.callApi('get', 'app/empresa'),
				this.callApi('get', 'app/getSedes')
			])
		
		//	this.usuario=this.user

			console.log('el usuario es:',this.usuario)

			//this.users = res.data['users']
			
			//this.userLogged = res.data['userLogged']
			this.roles = resRol.data
			this.empresas = resEmp.data
			this.sedeFiltros = resSedFil.data

			//console.log('es el usuario',this.users)
			//console.log('es el usuario logueado ',this.userLogged['permissions'])

		} catch {
			this.$swal('Ocurrio algun error','de','error')
		}
		
		
	},



}




  </script>