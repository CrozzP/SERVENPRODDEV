<template>

  


    <div>

        <div class="modal-folder-back" @click="closeForm"></div>
        <div class="modal-folder-front">

            
            <b-form-group
              id="nombreCarpeta"
              label="Nombre de la carpeta:"
              label-for="nombreCarpeta"
            >
              <b-form-input
                id="nombreCarpeta"
                v-model="name"
                type="text"
                placeholder="Ingrese nombre de la carpeta"
                required
              ></b-form-input>
           </b-form-group>

            <b-button class="mt-3" variant="outline-success" block @click="saveFolder">
               <b-icon icon="save" scale="1" ></b-icon> Guardar
            </b-button>
            <b-button class="mt-2" variant="outline-danger" block @click="closeForm">
               <b-icon icon="x-circle" scale="1" ></b-icon> Cancelar
            </b-button>

           

            

        </div>

    </div>

</template>

<script>

    import {
        SaveIcon,
        XCircleIcon } from 'vue-feather-icons'

    export default {

        name: 'FolderForm',

        props: {

            directory: {
                type: String,
                required: true
            }

        },

        components: {
            SaveIcon,
            XCircleIcon
        },

        data() {
            return {
                name: ''
            }
        },

        methods: {

            saveFolder() {
                const data = {
                    directory: this.directory,
                    name: this.name.trim(),
                    type: 'folder'
                }

                window.axios.post('app/files', data)
                    .then(response => {

                        this.name = ''
                        this.$emit('success')
                        this.closeForm()

                    })
                    .catch(response => {

                        this.name = ''
                        console.log(response)

                    })
            },

            closeForm() {
                this.$emit('close')
            }

        },

        computed: {

            canSummitForm() {
                if (this.name.length == 0) {

                    return false

                } else if (this.name.indexOf('-@folder@-') >= 0 || this.name.indexOf('-@space@-') >= 0) {

                    return false

                }

                return true
            }

        }

    }

</script>

<style lang="scss">

    .modal-folder {
        display: block;

        .modal-folder-back {
            background-color: var(--color-black-transparent);
            left: 0;
            height: 100vh;
            position: fixed;
            top: 0;
            width: 100vw;
            z-index: 500;
        }

        .modal-folder-front {
            align-items: stretch;
            background-color: var(--color-black);
            border: 3px solid var(--color-gray);
            border-radius: 1rem;
            display: flex;
            flex-flow: column nowrap;
            left: 50%;
            padding: 1rem;
            position: fixed;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            z-index: 600;

            &>* {
                margin: 0.5rem 0;
            }

            .title {
                color: var(--color-gray);
                margin-bottom: 1rem;
                margin-top: 0;
                padding: 0.5rem 0;
            }

            .input {
                border: 0;
                border-radius: 0.3rem;
                color: var(--color-black);
                padding: 0.5rem;
            }
        }
    }

</style>
