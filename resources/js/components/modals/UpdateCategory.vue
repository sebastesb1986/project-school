<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Categoría</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <div class="mb-3">
                    <label for="name" class="col-form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" v-model="category.name" :class="{ 'is-invalid': validation.errors.name && validation.errors.name.length > 0 }" @input="clearError('name')">
                    <p class="text-danger" v-if="validation.errors.name && validation.errors.name.length > 0">{{ validation.errors.name[0] }}</p>
                </div>
                <div class="mb-3">
                    <label for="description" class="col-form-label">Descripción</label>
                    <input type="text" class="form-control" id="description" v-model="category.description" :class="{ 'is-invalid': validation.errors.description && validation.errors.description.length > 0 }" @input="clearError('description')">
                    <p class="text-danger" v-if="validation.errors.description && validation.errors.description.length > 0">{{ validation.errors.description[0] }}</p>
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-warning" @click="updateCategory">Guardar</button>
        </div>
        </div>
    </div>
    </div>
</template>

<script>

import axios from 'axios';
import { Modal } from "bootstrap";

export default {
  name: 'updateCategory',
  props: { data: Object },
  data() {
    return {
      theModal: null,
      category: {
        id: "",
        name: "",
        description: "",
      },
      validation: {
          errors: {}
      }

    };
  },
  mounted() {
    this.theModal = new Modal('#exampleModal');
    this.theModal._element.addEventListener('hidden.bs.modal', this.cleanModal);
  },
  methods: {
    cleanModal() {
          // Restablecer los campos del formulario
          this.category.name = "";
          this.category.description = "";
          // Limpiar los errores
          this.validation.errors = {};
    },

    updateCategory() {
      const id = this.category.id;
      const route = `/category/update/${id}`;

      const formData = new FormData();

      // Agrega los campos de la categoría al FormData
      const arrayCategory = ['id', 'name', 'description'];

      arrayCategory.forEach((element) => {

          formData.append(element, this.category[element]);

      })

      axios.post(route, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'X-HTTP-Method-Override': 'PUT'
        }
      })
      .then(response => {
        const toast = response.data;

        this.successUpdate(toast)

        this.theModal.hide();
        this.$emit('succesfully');
      })
      .catch(error => {
        // Validación errores en campos
        if (error.response && error.response.status === 422) {
          const toast = error.response.data.errors;

          this.validation.errors = toast;

        } else {
          console.error("Error updating user:", error);
        }
      });
    },
    successUpdate(toast){

        this.$swal.fire({
            title: `${toast.success}`,
            icon: 'success',
            timer: 2000,
            showConfirmButton: false // No mostrará el botón de confirmación "OK"
        });

    },
    clearError(fieldName) {
        if (this.validation.errors[fieldName] && this.validation.errors[fieldName].length > 0) {
            this.validation.errors[fieldName] = [];
        }
    }
  },
  watch: {
    data: {
      handler(newValue) {
        this.category = { ...newValue }; // Cargar y refresh datos en la ventana modal
      },
      deep: true
    }
  },
};
</script>
