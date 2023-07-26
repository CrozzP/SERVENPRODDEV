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

              <h1>Test welcome</h1>


             <div class="files-app" id="app">

        

        <header class="header">
            <div class="header-options">

                
               <b-button variant="link"   @click="goRoot">
                    <b-icon icon="house-door" scale="1" variant="warning" width="24" height="24"></b-icon>
               </b-button>

               <b-button variant="link"  @click="goBack" v-show="currentDirectory != rootDirectory">
                    <b-icon icon="arrow-up-circle" scale="1" variant="success"></b-icon>
               </b-button>

               <b-button @click="showFolderForm=true"  variant="link">
                    <b-icon icon="folder-plus" scale="1" variant="success"></b-icon>
               </b-button>

               <b-button @click="showFileForm=true"  variant="link">
                    <b-icon icon="file-earmark-plus" scale="1" variant="success"></b-icon>
               </b-button>

                

            </div>
            <div class="header-path">

                <div class="path">/@{{ currentDirectory }}</div>

                 <b-breadcrumb  >
                   <b-breadcrumb-item href="#home">
                     <b-icon icon="house-fill" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon>
                     Home
                   </b-breadcrumb-item>


                   <b-breadcrumb-item href="#foo"v-for="(xdds, i) in xdd" :key="i" v-if="xdd.length" @click="linkEstado(xdds,i)">{{ xdds }}-{{i}}</b-breadcrumb-item>

                   
                 </b-breadcrumb>

            </div>
        </header>

        <main class="main">
            <div class="files-container">

                <file-box
                    v-for="directory in directories" :key="directory"
                    v-on:change-directory="changeDirectory"
                    :file="directory"
                    type="directory"></file-box>

                <file-box
                    v-for="file in files" :key="file"
                    v-on:change-directory="changeDirectory"
                    :file="file"
                    type="file"></file-box>

            </div>
        </main>

    </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  


<b-modal id="modal-center" centered title="Crear Carpeta" v-model="showFolderForm" hide-footer>
    

      <folder-form-box
            
            v-on:close="showFolderForm = false"
            v-on:success="changeDirectory(currentDirectory)"
            :directory="currentDirectory">
               
      </folder-form-box>

</b-modal>

<b-modal id="modal-center" centered title="Subir Archivo" v-model="showFileForm" hide-footer>
    
   <file-form-box
      
      v-on:close="showFileForm = false"
      v-on:success="changeDirectory(currentDirectory)"
      :directory="currentDirectory">
            
   </file-form-box>

</b-modal>

</base-layout>

</template>

<script>





import Breadcrumbs from '../../components/layouts/back/includes/Breadcrumbs.vue';
import * as categoryService from '../../services/category_service';

import FileBox from './components/File';
import FolderFormBox from './components/FolderForm';
import FileFormBox from './components/FileForm';
import {
        FileIcon,
        FolderIcon,
        MoreVerticalIcon,
        DownloadIcon,
        Trash2Icon,
        XCircleIcon } from 'vue-feather-icons'



export default{
  components: {
      Breadcrumbs,
      FileBox,
      FolderFormBox,
      FileFormBox,

            FileIcon,
            FolderIcon,
            MoreVerticalIcon,
            DownloadIcon,
            Trash2Icon,
            XCircleIcon,
      
    
    
  },



  data(){
    return {
      data : {
        
      },


         rootDirectory: 'box',
         currentDirectory: 'box',
         directories: [],
         files: [],
         showFolderFormModal: false,
         showFileFormModal: false,

         showFileForm: false,
         showFolderForm: false,
         count: 0,
         rr:[],
         xdd:[],
      
    }
  },



   mounted() {
     this.loadFiles(this.currentDirectory)
   },


   methods : {

     loadFiles(path) {
         path = path.split('/').join('-@folder@-')
         path = path.split(' ').join('-@space@-')

         //let fullpath = `/files?path=${path}`
         let fullpath = `app/files?path=${path}`

         this.directories = []
         this.files = []

         window.axios.get(fullpath)
             .then((response) => {

                 this.directories = response.data.directories
                 this.files = response.data.files

             })
     },

     changeDirectory(directory) {
      this.count++
      //console.log('path:_______________', directory)
      //console.log('count:_______________', this.count)
         this.currentDirectory = directory
         this.loadFiles(this.currentDirectory)
         this.rr[this.count]=directory
         //this.rr[2]=directory
      //console.log('RR-count:_______________', this.rr)
      //console.log('currentDirectory:_______________', this.currentDirectory.split('/'))
      this.xdd =this.currentDirectory.split('/');
     },

     goRoot() {
         this.changeDirectory(this.rootDirectory)
     },

     goBack() {
         let temp = this.currentDirectory.split('/')
         temp.splice(temp.length - 1, 1)

         let previousDirectory = temp.join('/')

         if (this.currentDirectory != this.rootDirectory) {

             this.changeDirectory(previousDirectory)

         }
     },

     linkEstado(dataXdds, index) {
      console.log('index__________---',index)
         let temp = this.currentDirectory.split('/')
         console.log('temp  ---',temp)
         console.log('temp.length  ---',temp.length)
         //temp.splice(temp.length - 1, 1)
         if(index != 0){
            temp.splice(index + 1, index + 1)
         }else{
            temp.splice(index + 1, temp.length)

         }


         console.log('temp.splice(temp.length - index, 1)  ---',temp.splice(index + 1, index + 1))
      

         let previousDirectory = temp.join('/')

         if (this.currentDirectory != this.rootDirectory) {

             this.changeDirectory(previousDirectory)

         }
     }
    




  },


    

    


  




}




  </script>