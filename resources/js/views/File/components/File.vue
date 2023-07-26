<template>

    <div class="files-item item-file">

         

         <b-button variant="outline-primary" size="lg"  v-if="type == 'directory'">
            <b-icon icon="folder" scale="2"  v-on:dblclick="changeDirectory(file)"  ></b-icon>
            
         </b-button>

         <b-button variant="outline-success" size="lg"   v-if="type == 'file'">
            <b-icon icon="file-earmark" scale="1.5"  ></b-icon>
         </b-button>


        

        <span class="file-name">{{ file | file_format }}</span>

        <div class="files-item-option">

           


           <b-dropdown
             no-caret
             dropright
             variant="link"
           >
            <template #button-content>
                  <b-icon icon="three-dots-vertical" scale="1.5"  variant="success"></b-icon>
               
            </template>
            <b-dropdown-text style="width: 240px;">
               <h5>{{ file | file_format }}</h5>
             </b-dropdown-text>

             <b-dropdown-item href="#">
                <button v-if="type == 'directory'" class="action-button green" v-on:click="changeDirectory(file)">
                  <b-icon icon="folder-symlink" scale="1.2"   ></b-icon>
                   
                   <span>Abrir Carpeta</span>
               </button>
             </b-dropdown-item>
             <b-dropdown-item href="#">
                <a v-if="type == 'file'" class="action-button green" :href="getDownloadUrl(file)">
                  <b-icon icon="download" scale="1.2"   ></b-icon>
                   <span>Descargar</span>
               </a>
             </b-dropdown-item>
             <b-dropdown-item href="#">
                <button class="action-button red" @click="deleteFile(file)">
                  <b-icon icon="trash" scale="1.2"   ></b-icon>
                   <span>Borrar</span>
               </button>
             </b-dropdown-item>
             
           </b-dropdown>

        </div>
       


        
        

    </div>

</template>

<script>

    import {
        FileIcon,
        FolderIcon,
        MoreVerticalIcon,
        DownloadIcon,
        Trash2Icon,
        XCircleIcon } from 'vue-feather-icons'

    export default {

        props: {
            file: {
                type: String,
                required: true
            },
            type: {
                type: String,
                required: true
            }
        },

        name: "File",

        components: {
            FileIcon,
            FolderIcon,
            MoreVerticalIcon,
            DownloadIcon,
            Trash2Icon,
            XCircleIcon
        },

        data() {
            return {
                showOptions: false
            }
        },

        methods: {

            getDownloadUrl(file) {
                return '/files/' + file.split('/').join('-@folder@-').split(' ').join('-@space@-')
            },

            changeDirectory(directory) {
                //this.showOptions = false
                this.$emit('change-directory', directory)
            },

            deleteFile(file) {
                let directory = file.split('/')
                directory.splice(directory.length - 1, 1)
                directory = directory.join('/')

                axios.delete( '/files/' + file.split('/').join('-@folder@-').split(' ').join('-@space@-'))
                    .then(response => {

                        this.changeDirectory(directory)

                    }).catch(response => {

                        console.log(response)

                    })
            }

        },

        filters: {

            file_format(value) {
                let filename = value.split('/').reverse()[0]
                return filename
            }

        }

    }

</script>

<style lang="scss">

    .files-item {
        align-items: center;
        border-radius: 0.5rem;
        display: flex;
        flex-flow: column nowrap;
        height: auto;
        margin: 0.5rem;
        padding: 0.5rem;
        position: relative;
        width: 140px;

        .file-name {
            display: inline-block;
            margin-top: 0.5rem;
            text-align: center;
            word-wrap: break-word;
            width: 100%;
        }

        .files-item-option {
            align-items: center;
            display: flex;
            flex-flow: row nowrap;
            justify-content: flex-end;
            position: absolute;
            right: 0;
            top: 0;

            &>* {
                margin: 0;
            }

        }

        &:hover {
            background-color: var(--color-black-transparent);
            color: var(--color-green);
        }
    }

    .files-item-options-wp {
        background-color: var(--color-black-transparent);
        display: none;
        left: 0;
        height: 100vh;
        position: fixed;
        top: 0;
        width: 100vw;
        z-index: 100;

        &.show {
            display: block;
        }
    }

    .files-item-options {
        align-items: stretch;
        background-color: var(--color-black);
        border: 3px solid var(--color-gray);
        border-radius: 1rem;
        display: none;
        flex-flow: column nowrap;
        left: 50%;
        padding: 1rem;
        position: fixed;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        z-index: 200;

        &>* {
            margin: 0.5rem 0;
        }

        .title {
            color: var(--color-gray);
            margin-bottom: 1rem;
            padding: 0.5rem 0.8rem;
            word-wrap: break-word;
        }

        &.show {
            display: flex;
        }
    }

</style>
