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
   
        <b-tab  active><p>I'm the first tab</p></b-tab>
        <b-tab  ><p>I'm the first tab</p></b-tab>
        <b-tab  ><p>I'm the sasdaaecond tab</p></b-tab>
        <b-tab  ><p>I'm a diasdsabled tab!</p></b-tab>
        <b-tab  ><p>I'm the sasdecond tab</p></b-tab>
        <b-tab  ><p>I'm a disablejd tabasd!</p></b-tab>
        
      
 

        <div class="text-center mt-3" >
                                            
            <button type="button" class="btn btn-outline-primary" @click="tabIndex--" v-if="tabIndex >= 1" >Anterior</button>
            <button type="button" class="btn btn-outline-primary" @click="tabIndex++" v-if="tabIndex <= 4" >Siguiente</button>
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
           
        tabIndex: 1
      }
    },
    methods: {


    },

    async created(){
                  

                  
                  
            },

            

  }
</script>
