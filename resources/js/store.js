import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
	state: {
		//apiURL: 'http://localhost:8000/api',
		apiURL: 'http://www.cepreunapuno.com/',
		
		//serverPath: 'http://localhost:8000',
		serverPath: 'http://www.cepreunapuno.com',

		deleteModalObj : {
			showDeleteModal : false,
			deleteUrl : '',
			data : null,
			deletingIndex: -1,
			isDeleted: false,

		},
		user: false,
		userPermission: null,

	},

	getters: {
		getDeleteModalObj(state){
			return state.deleteModalObj
		},
		getUserPermission(state){
			//console.log('pruebas',state.userPermission )
			return state.userPermission
		},

		getUserRole(state){
			console.log('pruebas++++++++++++++++xd',state.userRole )
			return state.userRole
         //return state.userRolePermi
		},

      getUserRolePermi(state){
         console.log('UserRolePermi_____________',state.userRolePermi )
         return state.userRolePermi
      },

      getUserSedes(state){
         console.log('userSedes_____________',state.userSedes )
         return state.userSedes
      },
	},

	mutations: {
		setDeleteModal(state,data){
			const deleteModalObj = {
				showDeleteModal : false,
				deleteUrl : '',
				data : null,
				deletingIndex: -1,
				isDeleted: data,

			}

			state.deleteModalObj = deleteModalObj

		},
		setDeletingModalObj(state, data){
			state.deleteModalObj = data
		},
		setUpdateUser(state, data){
			state.user = data
		},
		setUserPermission(state, data){
			state.userPermission = data
			//console.log('pruebas',state.userPermission )
		},
		setUserRole(state, data){
			state.userRole = data
         //state.userRolePermi = data
			console.log('pruebas Roles',state.userRole )
		},
      setUserRolePermi(state, data){
         state.userRolePermi = data
         console.log('pruebas userRolePermi',state.userRolePermi )
      },
      setUserSedes(state, data){
         state.userSedes = data
         console.log('pruebas userSedes',state.userSedes )
      },
	},
	actions: {},
}); 