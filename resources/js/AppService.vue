<template>
	
		
	
	<main>
	<body data-background-color="bg3">
		<div class="wrapper">
				
		<Header>
			<template v-slot:user>
			<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
				<li class="nav-item toggle-nav-search hidden-caret">
					<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
						<i class="fa fa-search"></i>
					</a>
				</li>
				<li class="nav-item dropdown hidden-caret">
					<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
						<div class="avatar-sm">
							
							<img class="userlogin" src="/assets/img/tec.png">
						</div>
					</a>
					<ul class="dropdown-menu dropdown-user animated fadeIn">
						<div class="dropdown-user-scroll scrollbar-outer">
							<li>
								<div class="user-box">
									<div class="avatar-lg"><img src="/assets/img/tec.png" alt="image profile" class="avatar-img rounded"></div>
									<div class="u-text">
										<h4>{{user.name}}</h4>
										<p class="text-muted">{{user.email}}</p><a href="#" class="btn btn-xs btn-secondary btn-sm">usuario</a>
									</div>
								</div>
							</li>
							<li>
								
								
								<a class="btn btn-light" @click="logout">Cerrar Sesion</a>
							</li>
						</div>
					</ul>
				</li>
			</ul>
			</template>
		</Header>

		<Sidebar>
			
			<template v-slot:usersidebar>
				<div class="user">
				<div class="avatar-sm float-left mr-2">
					<img class="userlogin2" src="/assets/img/tec.png">
				</div>
				<div class="info">
					<div class="nav-item "  v-for="(role, i) in roles" :key="i" v-if="roles.length || role.slug=='administrador'" >
						<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
							<span>
								{{user.name}}
								<span class="user-level">{{role.roleName}}</span>
								<span class="caret"></span>
							</span>
						</a>
					</div>
					<div class="clearfix"></div>

					<div class="collapse in" id="collapseExample">
						<ul class="nav">
							
							<li>
								
								<button class="btn btn-primary btn-sm ml-auto" @click="showEditPassModal"><span class="fa fa-plus"></span> Cambiar contraseña</button>
							</li>
						</ul>
					</div>
				</div>
			</div>
			</template>
			<template v-slot:prueba_li>
			<!--
		    	<li class="nav-item "v-for="(menuItem, i) in permissions" :key="i" v-if="permissions.length " >
					<router-link :to="menuItem.slug" exact>
						<span class="sub-item">{{menuItem.slug}}</span>
					</router-link>	
				</li>
			-->
			<div class="nav-item "  v-for="(role, i) in roles" :key="i" v-if="roles.length || role.slug=='administrador'" >
				<li>
					<a data-toggle="collapse" :href="`#${role.slug}`">
						<i class="fas fa-layer-group"></i>
						<p style="text-transform: capitalize;">{{role.slug}}</p>
						<span class="caret"></span>
					</a>
					

					<div class="collapse" :id="`${role.slug}`">
						<ul class="nav nav-collapse">
							<div v-for="(permission, i) in permissions" >
								<li v-if="permissions.length && permission.slug ==('view-tecnicoservice')">
									<router-link :to="`/service/tecnicoservice`" exact>

										<span class="sub-item">Extraordinario Derivar</span>
									</router-link>
								</li>
								<li v-if="permissions.length && permission.slug ==('view-user')">
									<router-link :to="`/back/user`" exact>

										<span class="sub-item">Usuario</span>
									</router-link>
								</li>
								
							</div>
						</ul>
					</div>
				</li>

				<li>
					<a data-toggle="collapse" :href="`#Elpu-RER`">
						<i class="fas fa-reply-all"></i>
						<p style="text-transform: capitalize;">Elpu-RER</p>
						<span class="caret"></span>
					</a>

					<div class="collapse" :id="`Elpu-RER`">
						<ul class="nav nav-collapse">
							<div v-for="(permission, i) in permissions" >
								
								
								
								
								<li v-if="permissions.length && permission.slug ==('view-suministrorer')">
									<a :href="'/rer/suministrorer'"> 
										<span class="sub-item">SuministrosRer</span>
									</a>
								</li>
								

							</div>
						</ul>
					</div>
				</li>

				<li>
					<a data-toggle="collapse" :href="`#Elpu-SerVen`">
						<i class="fas fa-reply-all"></i>
						<p style="text-transform: capitalize;">Elpu-SerVen</p>
						<span class="caret"></span>
					</a>

					<div class="collapse" :id="`Elpu-SerVen`">
						<ul class="nav nav-collapse">
							<div v-for="(permission, i) in permissions" >
								
								
								<li v-if="permissions.length && permission.slug ==('view-suministro')">
									<a :href="'/back/suministro'"> 
										<span class="sub-item">Suministro</span>
									</a>
								</li>
								<li v-if="permissions.length && permission.slug ==('view-extraordinario')">
									<a :href="'/back/extraordinario'"> 
										<span class="sub-item">Extraordinario</span>
									</a>
								</li>
								

							</div>
						</ul>
					</div>
				</li>

			</div>

				
	  		</template>

		</Sidebar>
		
				
		
		
		
<Breadcrumbs>
	
	<template v-slot:prueba>

	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Usuarios del sistema</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Usuario </li>
		
  	</template>
</Breadcrumbs>
	<div class="main-panel">

			<div class="content">
				
				<div class="container">
					
					<router-view> </router-view>

				</div>
				
			</div>
			<Footer/>
			
		</div>
	</div>
	

<b-modal  hide-footer v-model="editPassModal" title="Editar contraseña" :mask-closable="false" :closable="false">
	<form v-on:submit.prevent="editPassUsuario(editPassData)">
		<div class="form-group">
		    <label for="old_password">Ingresar Contraseña actual</label>
		    <input type="password" v-model="dataPassEdit.old_password" class="form-control" id="old_password" >
		</div>
		<div class="form-group">
		    <label for="password">Ingresar contraseña nueva</label>
		    <input type="password" v-model="dataPassEdit.password" class="form-control" id="password" >
		</div>
		<div class="form-group">
			    <label for="password-confirm">Confirmar contraseña</label>
			    
			    <input type="password" id="password_confirmation" class="form-control" placeholder="" v-model="dataPassEdit.password_confirmation" required>
			</div>
		<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="editPassModal=false">Cancelar</button>
				<button class="btn btn-primary">Edit Password</button>
				
			</div>
	</form>
</b-modal>
	</body>
	</main>


	
</template>






<script>

	import Header from './components/layouts/service/includes/Header.vue';
	import Sidebar from './components/layouts/service/includes/Sidebar.vue';
	import Footer from './components/layouts/service/includes/Footer.vue';
	export default{
		components: {
			Header,
			Sidebar,
			Footer  
		},

		props : ['user', 'roles', 'permissions'],

		data(){
			return {
				
				isLoggedIn : false,
				editPassModal : false,
				dataPassEdit:{

				},
				
			}

		},

		methods: {
            logout() {
                axios.post('/logout')
                    .then(() => location.href = '/login')
            },


            async editPassUsuario(editPassData){

				const res = await this.callApi('put', `app/user/change_password/${editPassData.id}`, this.dataPassEdit)

				//const res = await this.callApi('post', 'back/app/user', this.editData)
					
				if (res.status==200) {
					//this.roles[this.index].roleName = this.editData.roleName
					//this.users[this.index] = this.editPassData

					this.$swal('Excelent !','Actualizo sus datoscorrectamente','success')
					this.editPassModal = false

					this.dataPassEdit.old_password = ''
					this.dataPassEdit.password = ''
					this.dataPassEdit.password_confirmation = ''
					

					
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

			showEditPassModal(){
			let obj ={
				id : this.user.id,
				name : this.user.name,
				email : this.user.email,
				fullName : this.user.fullName,
				sede_id : this.user.sede_id,


			}
			console.log('dentro del Edit',this.user)
			this.editPassData = obj
			console.log('dentro del Edit',this.editPassData)
			this.editPassModal = true
			//this.index = index
		},


		


        },



		created(){
			
			console.log('datos del usuarssio ',this.user)
			console.log('los persmisos de app son ',this.permissions)
			console.log('los roles de app son ',this.roles)


			this.users = this.user
			console.log('datos del usuarssio____ ',this.users)
			this.$store.commit('setUpdateUser', this.user)
			this.$store.commit('setUserRole', this.roles)
			this.$store.commit('setUserPermission', this.permissions)
			
		}

		
	}
</script>
