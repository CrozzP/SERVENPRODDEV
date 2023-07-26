<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Atencion
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Atencion de Registros</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Usuario </li>
  	</template>
</Breadcrumbs>

	<div class="card mb-3">
		<div class="card-header d-flex">
			<span>
				<i class="fas fa-chart-area"></i>
					Administrar Registro de Atencion
			</span>
		<button class="btn btn-primary btn-sm ml-auto" @click="addModal=true" v-if="isWritePermitted" ><span class="fa fa-plus"></span> Nuevo</button>
		 
		</div>
	</div>
		<div class="row">
			<div class="col-md-12  ml-auto mr-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">

							<h1>Atencion</h1>
							<div>
								
								<form v-on:submit.prevent="addUser">
							    <div class="form-group-row">
							        <h3>Subir Excel</h3>
							    </div>

							    <div class="form-group-row">
							        <div class="col-sm-10">
							            

												<div class="col-sm-10">
							            

							            <b-form-file
											      v-model="data.file"
											      :state="Boolean(file1)"
											      placeholder="Choose a file or drop it here..."
											      drop-placeholder="Drop file here..."
											    ></b-form-file>
							        </div>

							        </div>
							    </div>

							    <br>

							    
							    
							    <br>
		
				
				<!--button class="btn btn-primary" v-on:click="addUser"><span class="fa fa-check"></span>: Add role</button-->
				<button class="btn btn-primary"  ><span class="fa fa-check"></span>: Add role</button>
							</form>	

							</div>

							<div>
								
								<form v-on:submit.prevent="subirUser">
							    <div class="form-group-row">
							        <h3>Subir imagen</h3>
							    </div>

							    <div class="form-group-row">
							        <div class="col-sm-10">
							            

												<div class="col-sm-10">
							            

							            <b-form-file
											      v-model="data.file2"
											      :state="Boolean(file1)"
											      placeholder="Choose a file or drop it here..."
											      drop-placeholder="Drop file here..."
											    ></b-form-file>
							        </div>

							        </div>
							    </div>

							    <br>

							     <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                      <b-col>
										    <b-form-group id="input-group-1" label="Subir imagen :" label-for="image">
			                      <input type="file" v-on:change="attachImage" ref="newDescuentoImage" class="form-control" id="data.image" aria-describedby="emailHelp"


			                        :headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
			                            >
			                          
			                  </b-form-group>

			                  </b-col>
			                  <b-col >
			                        
			                        <b-img thumbnail rounded fluid src="https://picsum.photos/250/250/?image=54" ref="newDescuentoImageDisplay" alt="Image 1" ></b-img>

			                  
			                  
			                </b-col>
			              </b-row>

<b-button block variant="success" @click="pruebita()"><span class="far fa-share"></span>     Exportar en Excel</b-button>
							    
							    
							    <br>
		
				
				<!--button class="btn btn-primary" v-on:click="addUser"><span class="fa fa-check"></span>: Add role</button-->
				<button class="btn btn-primary"  ><span class="fa fa-check"></span>: subir imagen</button>
							</form>	
							
							</div>

	

</div>
<div>
    <b-iconstack font-scale="5" animation="spin">
      <b-icon stacked icon="camera" variant="info" scale="0.75" shift-v="-0.25"></b-icon>
      <b-icon stacked icon="slash-circle" variant="danger"></b-icon>
    </b-iconstack>
  </div>

<div id="pru">
		<vueSignature ref="signature" :sigOption="option" :w="'400px'" :h="'200px'" :disabled="disabled" :defaultUrl="dataUrl"></vueSignature> 

		<button @click="save">Save</button>
		<button @click="clear">Clear</button>
		<button @click="undo">Undo</button>
		<button @click="addWaterMark">addWaterMark</button>
		<button @click="handleDisabled">disabled</button>
	</div>

						</div>
						

					</div>
				</div>
			</div>


		</div>



   


</base-layout>

</template>
<style scoped>

 
</style>
<script>

import Breadcrumbs from '../../../components/layouts/back/includes/Breadcrumbs.vue';
import * as categoryService from '../../../services/category_service';
import vueSignature from "vue-signature"


export default{
	name: "pru",
	
	components: {
	vueSignature,
	
	},



	data(){
		return {
			data : {

				

				data : {
					
					file:'',
					file2:'',
					image:'',
					},

			option:{
				penColor:"rgb(0, 0, 0)",
				backgroundColor:"rgb(255,255,255)"
			},
			disabled:false,
			dataUrl:"",
		


					
			

				

				
			},
			
		}
	},



	mounted(){

		//this.camera('environment');

	},



	methods : {

		//geolocalizacion
pruebita(){
 //	this.asd = navigator.geolocation.getCurrentPosition(showPosition);
	this.asd = navigator.geolocation.getCurrentPosition(this.success, this.error, this.options);
	
},


success(pos) {
  var crd = pos.coords;

  console.log('Your current position is:');
  console.log('Latitude : ' + crd.latitude);
  console.log('Longitude: ' + crd.longitude);
  console.log('More or less ' + crd.accuracy + ' meters.');

  this.$swal('Las coordenadas son : ','Latitud : ' + crd.latitude + ', Longitud : ' + crd.longitude,'success')
},

error(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
},






		save(){
			var _this = this;
			var png = _this.$refs.signature.save()
			var jpeg = _this.$refs.signature.save('image/jpeg')
			var svg = _this.$refs.signature.save('image/svg+xml');
			console.log(png);
			console.log(jpeg)
			console.log(svg)
		},
		clear(){
			var _this = this;
			_this.$refs.signature.clear();
		},
		undo(){
			var _this = this;
			_this.$refs.signature.undo();
		},
		addWaterMark(){
			var _this = this;
			_this.$refs.signature.addWaterMark({
				text:"mark text",          // watermark text, > default ''
				font:"20px Arial",         // mark font, > default '20px sans-serif'
				style:'all',               // fillText and strokeText,  'all'/'stroke'/'fill', > default 'fill		
				fillStyle:"red",           // fillcolor, > default '#333' 
				strokeStyle:"blue",	   // strokecolor, > default '#333'	
				x:100,                     // fill positionX, > default 20
				y:200,                     // fill positionY, > default 20				
				sx:100,                    // stroke positionX, > default 40
				sy:200                     // stroke positionY, > default 40
			});
		},
		fromDataURL(url){
			var _this = this;
			_this.$refs.signature.fromDataURL("data:image/png;base64,iVBORw0K...");
		},
		handleDisabled(){
			var _this = this;
			_this.disabled  = !_this.disabled
		},


	






// subir archivos

		async addUser(){
 console.log('estas dentro de SUBIR',this.data.file);
			const formData = new FormData();
                  //formData.append('photo', this.photo);
                  formData.append('file', this.data.file);
                 
                  

			const res = await this.callApi('post', 'app/importAtencionExtraordinario', formData)
			if (res.status==200) {
				this.$swal('Datos Importados','Correctamente','success')
				this.data.file = ''

			}else{
				this.$swal('Algo salio mal','Verifique los correos','error')

			}


          /*  let formData = new FormData();
            formData.append('file', this.file);
            axios.post(`/back/app/importAtencionExtraordinario`,

                    formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(){
                    console.log('SUCCESS!!');
                })
                .catch(function(){
                    console.log('FAILURE!!');
                });*/

        },
        handleFileUpload(){
            this.file = this.$refs.file.files[0];
        },

       async subirUser(){
 console.log('estas dentro de SUBIR',this.data.file);
			const formData = new FormData();
                  //formData.append('photo', this.photo);
                  formData.append('file2', this.data.file2);
                  formData.append('firma', this.$refs.signature.save('image/jpeg'));
                 
                  

			const res = await this.callApi('post', 'app/subirAtencionExtraordinario', formData)
			if (res.status==200) {
				this.$swal('Datos Importados','Correctamente','success')
				this.data.file2 = ''

			}else{
				this.$swal('Algo salio mal','Verifique los correos','error')

			}

        },


        attachImage(){
                        this.data.image = this.$refs.newDescuentoImage.files[0];
                        let reader = new FileReader();
                        reader.addEventListener('load', function(){
                              this.$refs.newDescuentoImageDisplay.src = reader.result;
                        }.bind(this), false);
                        reader.readAsDataURL(this.data.image);
                  },



       
   

    

    	
		




	},


		beforeMount(){
		this.init();
	},

		


	




}




  </script>