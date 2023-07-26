<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Roles
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
					Administrar Roles
			</span>
		<button class="btn btn-primary btn-sm ml-auto" @click="addModal=true" v-if="isWritePermitted" ><span class="fa fa-plus"></span> Nuevo</button>
		 
		</div>
	</div>
		
		<div class="row">
			<div class="col-md-12  ml-auto mr-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">
						
							<div class="col-md-12">
								<div class="card card-dark bg-primary-gradient">
									<div class="card-body bubble-shadow">
										<h3>{{extraordinario.id}}</h3>
										
										<h6 >Direccion: <p class="op-8">{{extraordinario.estado_extraordinario.extraordinario.suministro.DireccionPredio}}</p></h6>
										<h6 >Nombres: <p class="op-8">{{extraordinario.estado_extraordinario.extraordinario.suministro.NombreSuministro}}</p></h6>
										<h6 >Descripcion: <p class="op-8">{{extraordinario.estado_extraordinario.extraordinario.obs_tipo_extraordinario.descripcion}}</p></h6>
										<div class="pull-right">
											<h4 class="fw-bold op-8">{{extraordinario.estado_extraordinario.extraordinario.obs_tipo_extraordinario.tipo_extraordinario.nombreTipoExt}}</h4>
										  <h4 class="pull-right fw-bold">{{extraordinario.estado_extraordinario.extraordinario.suministro.CodigoSuministro}}</h4>
										</div>
									</div>
								</div>
							</div>
							
						</div>

						<b-container class="bv-example-row">
						  <b-row  class="text-center">
						    <b-col>
								  <b-button block variant="outline-primary" @click="Action1">Imagenes</b-button>
								</b-col>
						    <b-col>
								  <b-button block variant="outline-primary" @click="Action2">Firmas</b-button>
								</b-col>
						  </b-row>
						</b-container>

						
							<div class="row" v-show="bloque1">
								<div class="col-md-12  ml-auto mr-auto">
									<div class="card ">
										<div class="card-body bubble-shadow">

				

				  
				    	
												<div class="form-group-row">
													<h3>Cargar imagenes</h3>
													</div>

											

												<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
													<b-col>
													    <b-form-group id="input-group-1" label="Pre-Reparacion :" label-for="image">
													<input type="file" v-on:change="attachImage4" ref="newDescuentoImage4" class="form-control" id="data.image4" aria-describedby="emailHelp" 


													:headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
													>

													</b-form-group>

													</b-col>
													<b-col >

													<b-img v-bind="mainProps" thumbnail rounded fluid src="https://picsum.photos/250/250/?image=54" ref="newDescuentoImageDisplay4" alt="Image 1" ></b-img>



													</b-col>
												</b-row>

												<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
													<b-col>
													    <b-form-group id="input-group-1" label="Reparacion :" label-for="image">
													<input type="file" v-on:change="attachImage1" ref="newDescuentoImage1" class="form-control" id="data.image1" aria-describedby="emailHelp" 


													:headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
													>

													</b-form-group>

													</b-col>
													<b-col >

													<b-img v-bind="mainProps" thumbnail rounded fluid src="https://picsum.photos/250/250/?image=54" ref="newDescuentoImageDisplay1" alt="Image 1" ></b-img>



													</b-col>
												</b-row>

												<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
													<b-col>
													    <b-form-group id="input-group-1" label="Medidor :" label-for="image">
													<input type="file" v-on:change="attachImage2" ref="newDescuentoImage2" class="form-control" id="data.image2" aria-describedby="emailHelp" 


													:headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
													>

													</b-form-group>

													</b-col>
													<b-col >

													<b-img v-bind="mainProps" thumbnail rounded fluid src="https://picsum.photos/250/250/?image=54" ref="newDescuentoImageDisplay2" alt="Image 1" ></b-img>
													

													</b-col>
												</b-row>


												<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
													<b-col>
													    <b-form-group id="input-group-1" label="Usuario / Fachada :" label-for="image">
													<input type="file" v-on:change="attachImage3" ref="newDescuentoImage3" class="form-control" id="data.image3" aria-describedby="emailHelp" 


													:headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
													>

													</b-form-group>

													</b-col>
													<b-col >

													<b-img v-bind="mainProps" thumbnail rounded fluid src="https://picsum.photos/250/250/?image=54" ref="newDescuentoImageDisplay3" alt="Image 1" ></b-img>



													</b-col>
												</b-row>

											  <b-row>
											    <b-col sm="2">
											      <label for="textarea-small">Observaciones:</label>
											    </b-col>
											    <b-col sm="10">
											      <b-form-textarea
											        
											        size="sm"
											        placeholder="Consignar alguna observacion"
											        v-model="data.observacion"
											      ></b-form-textarea>
											    </b-col>
											  </b-row>
																								
									

												


										    	

										</div>
									</div>
								</div>
							</div>

							<div class="row" v-show="bloque2">
								<div class="col-md-12  ml-auto mr-auto">
									<div class="card ">
										
										<b-form-group id="input-group-1" label="Firmas:" label-for="image">
													
                                 <b-button @click="modalShowFt = !modalShowFt" :variant=" (data.ftecnico == false) ? 'outline-primary' : 'success'" :disabled=" (data.ftecnico == false) ? false : true">Firma Tecnico</b-button>
                                 <b-button @click="modalShowFu = !modalShowFu" :variant=" (data.fusuario == false) ? 'outline-primary' : 'success'" :disabled=" (data.fusuario == false) ? false : true">Firma Usuario</b-button>
										</b-form-group>


                              <b-row class="text-center" v-if="showFt">
                                 <b-col>
                                    <b-form-group id="input-group-1" label="Firma del Tecnico :" label-for="image">

                                    </b-form-group>
                                 </b-col>
                                 <b-col>
                                    <b-form-checkbox v-model="data.ftecnico" name="check-button" switch>
                                                         Validar 
                                    </b-form-checkbox>
                                 </b-col>
                              </b-row>
                              <b-row class="text-center"  v-if="showFt">
                                 <b-col>
                                    <b-img v-bind="mainProps" thumbnail rounded fluid src="https://picsum.photos/250/250/?image=54" ref="newFirmaTecnico" alt="Image 1" ></b-img>
                                 </b-col>
                              </b-row>


                              <b-row class="text-center" v-if="showFu">
                                 <b-col>
                                    <b-form-group id="input-group-1" label="Firma del Usuario :" label-for="image">

                                    </b-form-group>
                                 </b-col>
                                 <b-col>
                                    <b-form-checkbox v-model="data.fusuario" name="check-button" switch>
                                                         Validar 
                                    </b-form-checkbox>
                                 </b-col>
                              </b-row>
                              <b-row class="text-center"  v-if="showFu">
                                 <b-col>
                                    <b-img v-bind="mainProps" thumbnail rounded fluid src="https://picsum.photos/250/250/?image=54" ref="newFirmaUsuario" alt="Image 1" ></b-img>
                                 </b-col>
                              </b-row>

                                 

											<br>
											<button class="btn btn-warning"  @click="pruebita" v-if="coordenadasAtencion"><span class="fas fa-map-marker-alt"></span> Obteaner coordenadas</button>
                                 
											<br>
									
											<button class="btn btn-success"  @click="registrarAtencionDR" v-if="RegistrarAtencion"><span class="fa fa-check"></span>Registrar</button>
									</div>
								</div>
							</div>

					</div>
				</div>
			</div>
		</div>

   <b-modal
      v-model="modalShowFt"
      title="Firma del Tecnico"
      :header-bg-variant="headerBgVariant"
      :header-text-variant="headerTextVariant"
      :body-bg-variant="bodyBgVariant"
      :body-text-variant="bodyTextVariant"
      :footer-bg-variant="footerBgVariant"
      :footer-text-variant="footerTextVariant"
    >
    
      
       <div class="text-center" > 
         <div id="pru" style="border:solid 2px; width:330px; height:220px; display: inline-block; ">
                     <vueSignature ref="editFirmaTecnico" :sigOption="option"  :w="'325px'" :h="'215px'"  :disabled="disabled" :defaultUrl="dataUrlndft" ></vueSignature> 

                  </div>
                  </div>

         <template #modal-footer>
           <div class="w-100 text-center"  style="display: inline-block;">
            
             <b-button class="btn btn-primary float-center" size="sm" @click="cleart"><span class="fas fa-chalkboard"> </span> Limpiar</b-button>
             <b-button class="btn btn-primary float-center" size="sm" @click="undot"><span class="fas fa-backspace"> </span> Retroceder</b-button>
             <b-button class="btn btn-success float-center" size="sm" @click="attachFirmaTecnico"  ><span class="fas fa-check"> </span> Aceptar</b-button>
             <b-button
               variant="danger"
               size="sm"
               class="float-center"
               @click="modalShowFt=false"
             >
               Cerrar
             </b-button>
                     
           </div>
         </template>
   </b-modal>

   <b-modal
      v-model="modalShowFu"
      title="Firma del Usuario"
      :header-bg-variant="headerBgVariant"
      :header-text-variant="headerTextVariant"
      :body-bg-variant="bodyBgVariant"
      :body-text-variant="bodyTextVariant"
      :footer-bg-variant="footerBgVariant"
      :footer-text-variant="footerTextVariant"
    >

    

    

       <div class="text-center" > 
         <div id="pru" style="border:solid 2px; width:330px; height:220px; display: inline-block; ">
                     <vueSignature ref="editFirmaUsuario" :sigOption="option"  :w="'325px'" :h="'215px'"  :disabled="disabled" :defaultUrl="dataUrlndfu" ></vueSignature> 

                  </div>
                  </div>

         <template #modal-footer>
           <div class="w-100 text-center"  style="display: inline-block;">
             <b-button class="btn btn-primary float-center" size="sm" @click="cleart"><span class="fas fa-chalkboard"> </span> Limpiar</b-button>
             <b-button class="btn btn-primary float-center" size="sm" @click="undot"><span class="fas fa-backspace"> </span> Retroceder</b-button>
             <b-button class="btn btn-success float-center" size="sm" @click="attachFirmaUsuario"  ><span class="fas fa-check"> </span> Aceptar</b-button>
             <b-button
               variant="danger"
               size="sm"
               class="float-center"
               @click="modalShowFu=false"
             >
               Cerrar
             </b-button>
                     
           </div>
         </template>
    </b-modal>

</base-layout>

</template>

<script>


import * as categoryService from '../../../services/category_service';
import vueSignature from "vue-signature";

export default{
	name: "pru",
	
	components: {
	vueSignature,
	
	},
props: ['extraordinario'],


	data(){
		return {
			data : {
					
					file:'',
					file2:'',
					file3:'',
					image:'',
					ftecnico: false,
					fusuario: false,
					},
               modalShowFu: false,
               showFu: false,
               modalShowFt: false,
               showFt: false,
					bloque1: true,
					bloque2: false,


					coordenadasAtencion: true,
					RegistrarAtencion: false,

			mainProps: { blank: true, width: 360, height: 1, class: 'm1' },


			option:{

           // penColor:"rgb(0, 0, 0)",
           // backgroundColor:"rgb(255,255,255)"

				penColor:"rgb(0, 0, 0)",
				//backgroundColor:"rgb(255,255,255)"
				backgroundColor:"rgb(255,255,255)"
			},
			disabled:false,
			dataUrl:"",
			dataUrlt:"",
         dataUrlndft:"",
         dataUrlndfu:"",
			crd:{},


			//extraordinarios: {},
		}
	},


	methods : {

		  async registrarAtencionDR(){
 //console.log('estas dentro de SUBIR',this.data.file);
 //console.log('las coordenadas son:',this.crd.latitude);
 //console.log('archivo cargado',document.getElementById().data.image2.length === 0);

//console.log('archivos:',this.data.image2);
			const formData = new FormData();
                  //formData.append('photo', this.photo);

                   

                  formData.append('archivoPost1', this.data.image1);
                  formData.append('archivoPre1', this.data.image4);
                  formData.append('medidor', this.data.image2);
                  formData.append('usuarioImagen', this.data.image3);
                  //formData.append('file2', (this.data.image2.existsSync(path)) ? this.data.image2 : '' );
                  //formData.append('file2', (this.data.image2.length == 0) ? this.data.image2 : '' );
                  //formData.append('file2', (this.data.image2.length == 8) ? this.data.image2 : '' );
                  //formData.append('file3', (this.data.image3 != 0) ? this.data.image3 : '' );
                  formData.append('latitud', this.crd.latitude);
                  formData.append('longitud', this.crd.longitude);
                  formData.append('observacion', this.data.observacion);
                  formData.append('ftecnico', this.data.ftecnico);
                  formData.append('fusuario', this.data.fusuario);

                  formData.append('derivarRegistro_id', this.extraordinario.id);
                  formData.append('estadoExtraordinario_id', this.extraordinario.estado_extraordinario.id);
                  //formData.append('firmaTecnico', this.$refs.signaturet.save('image/jpeg'));
                  //formData.append('firmaUsuario', this.$refs.signature.save('image/jpeg'));

         console.log('verificar envio')
                 


                  if (this.data.ftecnico == 1) {
                  		//formData.append('firmaTecnico', this.$refs.signaturet.save('image/jpeg'));
                        //formData.append('firmaTecnico', this.$refs.editFirmaTecnico.save('image/jpeg'));
                        formData.append('firmaTecnico', this.editFirmaTecnicob);
                  } else {
                  	formData.append('firmaTecnico', '');
                  }
                  if (this.data.fusuario == 1) {
                  		//formData.append('firmaUsuario', this.$refs.signature.save('image/jpeg'));
                        //formData.append('firmaUsuario', this.$refs.editFirmaUsuario.save('image/jpeg'));
                        formData.append('firmaUsuario', this.editFirmaUsuariob);
                  } else {
                  	formData.append('firmaUsuario', '');
                  	
                  }

                 
               //  $retVal = (condition) ? a : b ;
                  

			const res = await this.callApi('post', 'app/registrarAtencionDR', formData)
			if (res.status==201) {
				this.$swal('Caso registrado','Correctamente','success')
				this.data.file2 = ''

			}else{
				this.$swal('Algo salio mal','Verificar los datos consinados','error')

			}

        },



		attachImage1(){
	            this.data.image1 = this.$refs.newDescuentoImage1.files[0];
	            let reader = new FileReader();
	            reader.addEventListener('load', function(){
	                  this.$refs.newDescuentoImageDisplay1.src = reader.result;
	            }.bind(this), false);
	            reader.readAsDataURL(this.data.image1);
	    },

        attachImage2(){
	            this.data.image2 = this.$refs.newDescuentoImage2.files[0];
	            let reader = new FileReader();
	            reader.addEventListener('load', function(){
	                  this.$refs.newDescuentoImageDisplay2.src = reader.result;
	            }.bind(this), false);
	            reader.readAsDataURL(this.data.image2);
	    },

        attachImage3(){
	            this.data.image3 = this.$refs.newDescuentoImage3.files[0];
	            let reader = new FileReader();
	            reader.addEventListener('load', function(){
	                  this.$refs.newDescuentoImageDisplay3.src = reader.result;
	            }.bind(this), false);
	            reader.readAsDataURL(this.data.image3);
	    },

        attachImage4(){
	            this.data.image4 = this.$refs.newDescuentoImage4.files[0];
              console.log('paso doisddddd:',this.data.image4)
	            let reader = new FileReader();
	            reader.addEventListener('load', function(){
	                  this.$refs.newDescuentoImageDisplay4.src = reader.result;
	            }.bind(this), false);
	            reader.readAsDataURL(this.data.image4);
	    },


        attachFirmaTecnico(){


         var _this = this;
         //var jpeg = _this.$refs.newDescuentoFirmaTecnico.save('image/jpeg')
         this.jpeg = this.$refs.editFirmaTecnico.save('image/jpeg')
         this.editFirmaTecnicob = this.jpeg
         console.log('dentro de la prueba',this.jpeg)

          //var file = dataURLtoFile('data:text/plain;base64,aGVsbG8gd29ybGQ=','hello.txt');
          var file = this.dataURLtoFile(this.jpeg,'firmaTecnico.jpeg');
         console.log(file);


              //this.data.firmaTecnico = this.$refs.newDescuentoImage4.files[0];
              //this.data.firmaTecnico = this.file.files[0];
              console.log('paso dois:',file)
              let reader = new FileReader();
              reader.addEventListener('load', function(){
                    this.$refs.newFirmaTecnico.src = reader.result;
              }.bind(this), false);
              //reader.readAsDataURL(this.data.firmaTecnico);
              reader.readAsDataURL(file);
              this.modalShowFt=false;
              this.showFt=true;
       },

      attachFirmaUsuario(){

         var _this = this;
         //var jpeg = _this.$refs.newDescuentoFirmaTecnico.save('image/jpeg')
         this.jpeg = this.$refs.editFirmaUsuario.save('image/jpeg')
         this.editFirmaUsuariob = this.jpeg
         console.log('dentro de la prueba',this.jpeg)

          //var file = dataURLtoFile('data:text/plain;base64,aGVsbG8gd29ybGQ=','hello.txt');
          var file = this.dataURLtoFile(this.jpeg,'firmaUsuario.jpeg');
         console.log(file);


              //this.data.firmaTecnico = this.$refs.newDescuentoImage4.files[0];
              //this.data.firmaTecnico = this.file.files[0];
              console.log('paso dois:',file)
              let reader = new FileReader();
              reader.addEventListener('load', function(){
                    this.$refs.newFirmaUsuario.src = reader.result;
              }.bind(this), false);
              //reader.readAsDataURL(this.data.firmaTecnico);
              reader.readAsDataURL(file);
              this.modalShowFu=false;
              this.showFu=true;
       },

        dataURLtoFile(dataurl, filename) {
 
        var arr = dataurl.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]), 
            n = bstr.length, 
            u8arr = new Uint8Array(n);
            
        while(n--){
            u8arr[n] = bstr.charCodeAt(n);
        }
        
        return new File([u8arr], filename, {type:mime});
    },







	    saveft(){
				var _this = this;
				var png = _this.$refs.newDescuentoFirmaTecnico.save()
				var jpeg = _this.$refs.newDescuentoFirmaTecnico.save('image/jpeg')
				var svg = _this.$refs.newDescuentoFirmaTecnico.save('image/svg+xml');
				//console.log(png);
				console.log(jpeg)
				//console.log(svg)
			},
       savet(){
            var _this = this;
            var png = _this.$refs.signaturet.save()
            var jpeg = _this.$refs.signaturet.save('image/jpeg')
            var svg = _this.$refs.signaturet.save('image/svg+xml');
            //console.log(png);
            console.log(jpeg)
            //console.log(svg)
         },
			cleart(){
				var _this = this;
				_this.$refs.signaturet.clear();
			},
			undot(){
				var _this = this;
				_this.$refs.signaturet.undo();
			},

	    save(){
				var _this = this;
				var png = _this.$refs.newDescuentoFirmaTecnico.save()
				var jpeg = _this.$refs.newDescuentoFirmaTecnico.save('image/jpeg')
				var svg = _this.$refs.newDescuentoFirmaTecnico.save('image/svg+xml');
				//console.log(png);
				console.log(jpeg)
				//console.log(svg)
			},

       /*save(){
            var _this = this;
            var png = _this.$refs.signature.save()
            var jpeg = _this.$refs.signature.save('image/jpeg')
            var svg = _this.$refs.signature.save('image/svg+xml');
            //console.log(png);
            //console.log(jpeg)
            //console.log(svg)
         },*/
			clear(){
				var _this = this;
				_this.$refs.signature.clear();
			},
			undo(){
				var _this = this;
				_this.$refs.signature.undo();
			},
			fromDataURL(url){
				var _this = this;
				_this.$refs.signature.fromDataURL("data:image/png;base64,iVBORw0K...");
			},

			handleFileUpload(){
	            this.file = this.$refs.file.files[0];
	        },



	    Action1(){
	    	this.bloque1=true
	    	this.bloque2=false

	    },

	    Action2(){
	    	this.bloque2=true
	    	this.bloque1=false
	    },

	    pruebita(){
// 	this.asd = navigator.geolocation.getCurrentPosition(showPosition);
	this.asd = navigator.geolocation.getCurrentPosition(this.success, this.error, this.options);

	
},
       


success(pos) {
  var coordenadas = pos.coords;
  this.crd =coordenadas

					this.coordenadasAtencion= false,
					this.RegistrarAtencion= true,

 //console.log('Your current position is:');
 //console.log('Latitude : ' + coordenadas.latitude);
 //console.log('Longitude: ' + coordenadas.longitude);
 //console.log('More or less ' + coordenadas.accuracy + ' meters.');

  this.$swal('Las coordenadas son : ','Latitud : ' + coordenadas.latitude + ', Longitud : ' + coordenadas.longitude,'success')
},

error(err) {
	this.coordenadasAtencion= true,
	this.RegistrarAtencion= false,
  console.warn('ERROR(' + err.code + '): ' + err.message);
},
		




	},

	created(){
    console.log("Columns: ", this.extraordinario );
    //this.extraordinarios = this.extraordinario
  },


		


}




  </script>