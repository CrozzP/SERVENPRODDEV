import { mapGetters } from 'vuex'

export default {
	
	data(){
		return {

		}
	},
	methods: {
		async callApi(method, url, dataObj){
			try{
				return await axios({
					method: method,
					url: url,
					data: dataObj
				});
			} catch (e){
				return e.response
			}
		},
	

		checkUserPermission(key){
			if(!this.userPermission) return true
			let isPermitted = false;
			//let iterable = this.userPermission

			//for(let r of this.userRole){
			
			//}
					
					
			for(let d of this.userPermission){

						//console.log('r.slug------', r.slug)
						//console.log('rol---------', rol)
				//	if (d.slug==key && r.slug == rol) {
					//console.log('d.slug__________',d.slug)
					//console.log('key-------------',key)
					
					switch (d.slug) {
					  case key:
					    //console.log('El kilogramo de naranjas cuesta $0.59.');
					    isPermitted = true
					    break;
					   default:
						   // console.log('Lo lamentamos, por el momento no disponemos de ' + expr + '.');
					    	break;
						}
				//}
			
			}
			//}

			
			return isPermitted
		}
	},

	computed: {
		...mapGetters({
			'userPermission' : 'getUserPermission',
			'userRole' : 'getUserRole',
         'userRolePermi' : 'getUserRolePermi',
         'userSedes' : 'getUserSedes',
		}),

		isReadPermitted(){
			let isPermittedRole = '';
			
			for(let r of this.userRole){
				//console.log('role pivot role_id: ', r.pivot.role_id)
				//console.log('role id: ', r.id)
				//console.log('role slug: ', r.slug)
				
				console.log('role url: ', this.$route.name)
				
					//console.log('prueba permisos', p)

					switch (r.slug) {
					  case 'administrador':
					  	return true
					    //isPermittedRole = 'view-user'
					    isPermittedRole = 'view-'+ this.$route.name
						//rolito = 'administrador'
					    break;
					  case 'modulo':
					    //isPermittedRole = 'view-user'
					    isPermittedRole = 'view-'+ this.$route.name
						//rolito = 'logistica'
					    break;
					  case 'secretario':
					    //isPermittedRole = 'view-user'
					    isPermittedRole = 'view-'+ this.$route.name
						//rolito = 'secretario'
					    break;
					  case 'jefesupervisor':
					    //isPermittedRole = 'view-user'
					    isPermittedRole = 'view-'+ this.$route.name
						//rolito = 'secretario'
					    break;
					  case 'supervisor':
					    //isPermittedRole = 'view-user'
					    isPermittedRole = 'view-'+ this.$route.name
						//rolito = 'secretario'
					    break;
					  case 'rer':
					    //isPermittedRole = 'view-user'
					    isPermittedRole = 'view-'+ this.$route.name
						//rolito = 'secretario'
					    break;
					  case 'serven':
					    isPermittedRole = 'view-'+ this.$route.name
					    break;
                 case 'aservice':
                   isPermittedRole = 'view-'+ this.$route.name
                   break;
					  case 'stecnico':
					    isPermittedRole = 'view-'+ this.$route.name
					    break;
                 case 'repositorio':
                   isPermittedRole = 'view-'+ this.$route.name
                   break;
					   default:
						   // console.log('Lo lamentamos, por el momento no disponemos de ' + expr + '.');
					    	break;
						}

				//console.log('prueba del isRole: ', isPermittedRole)
				
			}
			
			
			return this.checkUserPermission(isPermittedRole)
		},
		isWritePermitted(){
			let isPermittedRole = '';
			
			for(let r of this.userRole){
					switch (r.slug) {
					  case 'administrador':
					    return true
					    //isPermittedRole = 'create-'+ this.$route.name
					    break;
					  case 'modulo':
					    isPermittedRole = 'create-'+ this.$route.name
					    //isPermittedRole = 'create-extraordinario'
					    break;
					  case 'secretario':
					    isPermittedRole = 'create-'+ this.$route.name
					    break;
					  case 'jefesupervisor':
					    isPermittedRole = 'create-'+ this.$route.name
					    //isPermittedRole = 'create-extraordinario'
					    break;
					  case 'supervisor':
					    isPermittedRole = 'create-'+ this.$route.name
					    //isPermittedRole = 'create-extraordinario'
					    break;
					  case 'serven':
					    isPermittedRole = 'create-'+ this.$route.name
					    break;
                 case 'aservice':
                   isPermittedRole = 'create-'+ this.$route.name
                   break;
					  case 'stecnico':
					    isPermittedRole = 'create-'+ this.$route.name
					    break;
                 case 'repositorio':
                   isPermittedRole = 'create-'+ this.$route.name
                   break;
					   default:
					    	break;
						}
			}
			
			
			return this.checkUserPermission(isPermittedRole)
			//return this.checkUserPermission('view-role')
		},
		isUpdatePermitted(){
			let isPermittedRole = '';
			
			for(let r of this.userRole){
					switch (r.slug) {
					  case 'administrador':
					    return true
					    //isPermittedRole = 'update-'+ this.$route.name
					    break;
					  case 'modulo':
					    isPermittedRole = 'update-'+ this.$route.name
					    break;
					  case 'secretario':
					    isPermittedRole = 'update-'+ this.$route.name
					    break;
					  case 'jefesupervisor':
					    isPermittedRole = 'update-'+ this.$route.name
					    break;
					  case 'supervisor':
					    isPermittedRole = 'update-'+ this.$route.name
					    break;
					  case 'serven':
					    isPermittedRole = 'update-'+ this.$route.name
					    break;
                 case 'aservice':
                   isPermittedRole = 'update-'+ this.$route.name
                   break;
					  case 'stecnico':
					    isPermittedRole = 'update-'+ this.$route.name
					    break;
                 case 'repositorio':
                   isPermittedRole = 'update-'+ this.$route.name
                   break;
					   default:
					    	break;
						}
			}
			
			
			return this.checkUserPermission(isPermittedRole)
			//return this.checkUserPermission('update-role')
		},
		isDeletePermitted(){
			let isPermittedRole = '';
			
			for(let r of this.userRole){
					switch (r.slug) {
					  case 'administrador':
					    return true
					    //isPermittedRole = 'delete-'+ this.$route.name
					    break;
					  case 'modulo':
					    isPermittedRole = 'delete-'+ this.$route.name
					    break;
					  case 'secretario':
					    isPermittedRole = 'delete-'+ this.$route.name
					    break;
					  case 'jefesupervisor':
					    isPermittedRole = 'delete-'+ this.$route.name
					    break;
					  case 'supervisor':
					    isPermittedRole = 'delete-'+ this.$route.name
					    break;
					  case 'serven':
					    isPermittedRole = 'delete-'+ this.$route.name
					    break;
                 case 'aservice':
                   isPermittedRole = 'delete-'+ this.$route.name
                   break;
					  case 'stecnico':
					    isPermittedRole = 'delete-'+ this.$route.name
					    break;
                 case 'repositorio':
                   isPermittedRole = 'delete-'+ this.$route.name
                   break;
					   default:
					    	break;
						}
			}
			
			
			return this.checkUserPermission(isPermittedRole)
			//return this.checkUserPermission('delete-role')
		},
		isIndexPermitted(){
			return this.checkUserPermission('create')
		},

	},
}