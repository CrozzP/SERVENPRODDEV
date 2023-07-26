<template>

    <div class="tara">
      
        <b-card
        >
        <template #header>
          <h3 class="mb-0">Orientacion respecto al tramite</h3>
        </template>

              <div role="tablist">

                <b-row v-for="(orientacion, i) in orientaciones" :key="i" v-if="orientaciones.length">
                  <b-col>
                    <b-button block  v-b-toggle="'accordion-'+orientacion.id"  variant="outline-primary">{{orientacion.nombre}}</b-button>

                  </b-col>
                  <b-col cols="8">
                    <b-collapse :id="'accordion-'+orientacion.id" visible accordion="my-accordion" role="tabpanel">
                   
                      <b-card
                        border-variant="primary"
        
                        >
                        <b-card-text>Informacion <code>importante</code></b-card-text>
                        <b-card-text  v-for="(desOrientacion, i) in orientacion.des_orientacion" :key="i" v-if="orientacion.des_orientacion.length">
                        <b-iconstack font-scale="1" >
                          <b-icon stacked icon="plug-fill" variant="info" scale="0.95" ></b-icon>
                          
                        </b-iconstack>  {{ desOrientacion.descripcion }}</b-card-text>

                      
                      </b-card>

                    </b-collapse>
                  </b-col>
                </b-row>

              </div>

        </b-card>

    </div>  
        

            
</template>

<script>
  export default {
    data() {
      return {
           
        tabIndex: 1,

        orientaciones: [],

        
      }
    },
    methods: {


    },

    async created(){

      try {
            //this.getResults();
            //console.log(this.isWritePermitted)
            //console.log('esto es el permiso')
            

            //const [res, resTipoExtraordinario] = await Promise.all([
            const [ res] = await Promise.all([
                    //this.callApi('get', 'app/suministro'),
                    this.callApi('get', 'app/orientacion')
                ])
            

                //this.suministros = res.data
                //console.log('datos de la relaciuon', res.data )
                this.orientaciones = res.data
                //console.log('los datos del suministro son',resTipoExtraordinario.data)
                //console.log('los datos del suministro son',this.tipoExtraordinarios)

                //console.log('es el usuario',this.users)
                //console.log('es el usuario logueado ',this.userLogged['permissions'])

            } catch {
                this.$swal('Algo salio mal','intente nuevamente','error')
            }
                  

                  
                  
            },

            

  }
</script>
