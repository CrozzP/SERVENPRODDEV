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

              <h1>Test dios</h1>

            </div>

          </div>
        </div>
      </div>
    </div>
  

</base-layout>

</template>

<script>

import Breadcrumbs from '../../components/layouts/back/includes/Breadcrumbs.vue';
import * as categoryService from '../../services/category_service';

export default{
  components: {
    Breadcrumbs,
    
    
  },



  data(){
    return {
      data : {
        
      },
      
    }
  },


  methods : {
    




  },


    

    


  




}




  </script>