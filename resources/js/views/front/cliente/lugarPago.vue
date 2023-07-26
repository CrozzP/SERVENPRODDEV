<template>

    <div class="tara">
          <b-card no-body>

      <b-tabs
      v-model="tabIndex"
        active-nav-item-class="font-weight-bold text-uppercase text-danger"
        active-tab-class="font-weight-bold text-success"
        content-class="mt-3"
        vertical
      >
   
        <b-tab  active><p>I'm the first tab</p>

 <div>
    <gmap-map
    :center="mapCenter"
    :zoom="11"
    style="width: 100%; height: 440px"
    @click="handleMapClick"
  >
      <gmap-info-window
        :options="infoWindowOptions"
        :position="infoWindowPosition"
        :opened="infoWindowOpened"
        @closeclick="handleInfoWindowClose"
      >

        <div class="info-window">
          <h2 v-text="activeLugarPago.nombre"></h2>
          <h5 v-text="activeLugarPago.id"></h5>
          <p v-text="'Coordenadas: '+ activeLugarPago.latitude + ', '+ activeLugarPago.longitude"></p>
          <p v-text="activeLugarPago.slug"></p>
        </div>
      </gmap-info-window>

      <gmap-marker
        v-for="(r, index) in lugarPagos"
        :key="r.id"
        :position="getPosition(r)"
        :title="r.nombre"
        :clickable="true"
        :draggable="false"
        
        

        @click="handleMarkerClicked(r)"
     
      ></gmap-marker>
     
     
  </gmap-map>
  </div>



        </b-tab>
        <b-tab  ><p>I'm the first tab</p></b-tab>
        <b-tab  ><p>I'm the second tab</p></b-tab>
        <b-tab  ><p>I'm a disabled tab!</p></b-tab>
        <b-tab  ><p>I'm the second tab</p></b-tab>
        <b-tab  ><p>I'm a disabled tab!</p></b-tab>
        
      
 

        <div class="text-center mt-3" >
                                            
            <button type="button" class="btn btn-outline-primary" @click="tabIndex--" v-if="tabIndex >= 1" >Anterior</button>
            <button type="button" class="btn btn-outline-primary" @click="tabIndex++" v-if="tabIndex <= 1" >Siguiente</button>
            <p class="font-weight-bold text-success">Avance : {{ tabIndex }} de 5</p>
    
        </div>   
      </b-tabs>
    </b-card>  
    </div>  
        

            
</template>

<script>
  export default {
   
    data() {
      return {
           
        tabIndex: 1,
        lugarPagos:[],
        infoWindowOptions: {
          pixelOffset:{
            width: 0,
            height: -35
          }
        },
        activeLugarPago: {},
        infoWindowOpened: false,

        


      }
    },

   



    

    methods: {

      getPosition(r){
        return{

        lat: parseFloat(r.latitude),
        lng: parseFloat(r.longitude)
        }

      },

      handleMarkerClicked(r){
        this.activeLugarPago = r; 
        this.infoWindowOpened = true;
      },
      handleInfoWindowClose(){
        this.activeLugarPago = {}; 
        this.infoWindowOpened = false;
      },

      handleMapClick(e){
        this.lugarPagos.push({
          nombre: "donato",
          state: "1",
          latitude: e.latLng.lat(),
          longitude: e.latLng.lng()
        });
      },
    },

    computed:{

      mapCenter(){
        if (!this.lugarPagos.length) {
          return{
            lat: -15.836418482427465,
            lng: -70.02615668959257
          }
        }
        return {
          lat:parseFloat(this.lugarPagos[0].latitude),
          lng: parseFloat(this.lugarPagos[0].longitude)
        }
      },

      infoWindowPosition() {
          return {
            lat: parseFloat(this.activeLugarPago.latitude),
            lng: parseFloat(this.activeLugarPago.longitude)
          };
        },

    },

    async created(){
                  
      try {
            //this.getResults();
            //console.log(this.isWritePermitted)
            //console.log('esto es el permiso')
            

            //const [res, resTipoExtraordinario] = await Promise.all([
            const [ res] = await Promise.all([
                    //this.callApi('get', 'app/suministro'),
                    this.callApi('get', 'app/lugarPago')
                ])
            

                //this.suministros = res.data
                console.log('datos de la relaciuon', res.data )
                this.lugarPagos = res.data
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
