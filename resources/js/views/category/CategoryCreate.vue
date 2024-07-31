<template>
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="bg-light p-4 rounded">
                    <div class="mb-3">
                        <label for="username" class="col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="username" v-model="category.name" :class="{ 'is-invalid': validation.errors.name && validation.errors.name.length > 0 }" @input="clearError('name')">
                        <p class="text-danger" v-if="validation.errors.name && validation.errors.name.length > 0">{{ validation.errors.name[0] }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="col-form-label">Descripción</label>
                        <input type="text" class="form-control" id="description" v-model="category.description" :class="{ 'is-invalid': validation.errors.description && validation.errors.description.length > 0 }" @input="clearError('description')">
                        <p class="text-danger" v-if="validation.errors.description && validation.errors.description.length > 0">{{ validation.errors.description[0] }}</p>
                    </div>

                    <button type="button" class="btn btn-dark" @click="createCategory">Guardar</button>
                </form>
            </div>
        </div>
    </main>
  </template>

  <script>

  import axios from 'axios';

  export default {
    name: 'categoryCreate',

    data() {
      return {

        validation: {
            errors: {}
        },
        category: {
            name: "",
            description: "",
        },

      }
    },
    components: { },
    mounted() {
      //
    },
    methods: {
        createCategory() {

            const route = '/category/create';

            // Gestión campos registrar categoría
            const formData = new FormData();

            const arrayCategory = ['name', 'description'];

            arrayCategory.forEach((element) => {

                formData.append(element, this.category[element]);

            })


            axios.post(route, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then((response) => {

                const toast = response.data;

                this.successUpdate(toast)

                this.$router.push('/categoryList');

            }).catch(error => {

                // Valdación errores de campos
                if (error.response && error.response.status === 422) {
                    const toast = error.response.data.errors;
                    this.validation.errors = toast;

                } else {
                    console.error("Error updating category:", error);

                }

            })

        },
        successUpdate(toast){

            this.$swal.fire({
                title: 'Registrado!',
                text: `${toast.success}`,
                icon: 'success',
                timer: 2000, // La alerta desaparecerá después de 6 segundos (6000 milisegundos)
                showConfirmButton: false // No mostrará el botón de confirmación "OK"
            });

        },
        clearError(fieldName) {
            if (this.validation.errors[fieldName] && this.validation.errors[fieldName].length > 0) {
                this.validation.errors[fieldName] = [];
            }
        }
    }
  }
  </script>
