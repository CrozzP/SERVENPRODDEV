<template>

    <div class="tara">
  <b-card>
      <template #header>
        <h3 class="mb-0">Contactenos</h3>
      </template>

     
      <b-row cols-sm="1">
          
        <b-col cols="8" md="8" lg="8">
          <form v-on:submit.prevent="addReclamo">
              <b-form-group id="input-group-1" label="Suministro :" label-for="suministro" >
                        <b-form-input id="suministro" v-model="dataReg.suministro" type="text" placeholder="Ingresar la suministro" >
                        </b-form-input>
              </b-form-group>


              <b-form-group id="input-group-1" label="Email : *" label-for="email" >
                  <b-form-input id="email" v-model="dataReg.email" type="email" placeholder="Ingresar el email"   :state="dataRegEmail" trim>
                  </b-form-input>

                      <b-form-invalid-feedback id="input-live-feedback" v-if="dataRegemail" >
                            ejemplo - prueba@correo.com
                      </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group id="input-group-1" label="Asunto :" label-for="asunto" >
                        <b-form-input id="asunto" v-model="dataReg.asunto" type="text" placeholder="Ingresar el asunto" >
                        </b-form-input>
              </b-form-group>

              <b-form-group id="input-group-1" label="Comentario :" label-for="comentario" >
                         <b-form-textarea
                          id="comentario"
                          v-model="dataReg.comentario"
                          size="sm"
                          rows="7"
                          placeholder="Registre sus comentarios"
                        ></b-form-textarea>
              </b-form-group>

              <b-form-group id="input-group-1" label="Adjuntar archivo :" label-for="telefono" >
                        <b-form-file
                          v-model="dataReg.archivo"
                          :state="Boolean(dataReg.archivo)"
                          placeholder="Adjuntar su archivo aqui"
                        ></b-form-file>
              </b-form-group>

              

          </form>
        </b-col>

        <b-col cols="4" md="4"  lg="4">
          
         
           
            <b-card>
              <h4>Informacion importante</h4>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas viverra nunc sapien,
              non rhoncus elit tincidunt vitae. Vestibulum maximus, ligula eu feugiat molestie,
              massa diam imperdiet odio, vitae viverra ligula est id nisi. Aliquam ut molestie est.
              Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
              turpis egestas. Phasellus at consequat dui. Aenean tristique sagittis quam,
              sit amet sollicitudin neque sodales in.
            </b-card>

         

        </b-col>
      </b-row>

        
            
                
                   
    </b-card>  
    </div>  
        

            
</template>

<script>
  export default {
    data() {
      return {
           
        tabIndex: 1,

        dataReg: {
          archivo:'',
        },
      }
    },
    methods: {


    },

    async created(){
                  

                  
                  
            },

            

  }
</script>
