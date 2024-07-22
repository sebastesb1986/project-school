
<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Producto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <div class="mb-3">
                    <label for="name" class="col-form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" v-model="product.name" :class="{ 'is-invalid': validation.errors.name && validation.errors.name.length > 0 }" @input="clearError('name')">
                    <p class="text-danger" v-if="validation.errors.name && validation.errors.name.length > 0">{{ validation.errors.name[0] }}</p>
                </div>
                <div class="mb-3">
                    <label for="description" class="col-form-label">Descripción</label>
                    <input type="text" class="form-control" id="email" v-model="product.description" :class="{ 'is-invalid': validation.errors.quantity && validation.errors.quantity.length > 0 }" @input="clearError('description')">
                    <p class="text-danger" v-if="validation.errors.quantity && validation.errors.quantity.length > 0">{{ validation.errors.quantity[0] }}</p>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="col-form-label">Cantidad</label>
                    <input type="text" class="form-control" id="quantity" v-model="product.quantity" :class="{ 'is-invalid': validation.errors.quantity && validation.errors.quantity.length > 0 }" @input="clearError('quantity')">
                    <p class="text-danger" v-if="validation.errors.quantity && validation.errors.quantity.length > 0">{{ validation.errors.quantity[0] }}</p>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="col-form-label">Categoría</label>
                    <select class="form-select" aria-label="Default select example" id="category_id" v-model="product.category_id" :class="{ 'is-invalid': validation.errors.category_id && validation.errors.category_id.length > 0 }" @input="clearError('category_id')">
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                    </select>
                    <p class="text-danger" v-if="validation.errors.category_id && validation.errors.category_id.length > 0">{{ validation.errors.category_id[0]}}</p>
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
  name: 'updateProduct',
  props: { data: Object },
  data() {
    return {
      theModal: null,
      product: {
        id: "",
        name: "",
        description: "",
        quantity: "",
        category_id: "",
      },
      categories: [],
      validation: {
          errors: {}
      }

    };
  },
  mounted() {
    this.theModal = new Modal('#exampleModal');
    this.theModal._element.addEventListener('hidden.bs.modal', this.cleanModal);

    this.getCategories();
  },
  methods: {
    cleanModal() {
          // Restablecer los campos del formulario
          this.product.name = "";
          this.product.description = "";
          this.product.quantity = "";
          this.product.category_id = "";
          // Limpiar los errores
          this.validation.errors = {};
    },
    async getCategories() {
      try {
        const response = await axios.get(`/categories`);
        this.categories = response.data.categories;
      } catch (error) {
        console.error("Error fetching categories:", error);
      }
    },
    updateCategory() {
      const id = this.product.id;
      const route = `/product/update/${id}`;

      const formData = new FormData();

      // Agrega los campos de producto al FormData
      const arrayProduct = ['id', 'name', 'description', 'quantity', 'category_id'];

      arrayProduct.forEach((element) => {

          formData.append(element, this.product[element]);

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
          console.error("Error updating product:", error);
        }
      });
    },
    successUpdate(toast){

        this.$swal.fire({
            title: `${toast.success}`,
            icon: 'success',
            timer: 2000, // La alerta desaparecerá después de 6 segundos (6000 milisegundos)
            showConfirmButton: false // No mostrará el botón de confirmación "OK"
        });

    },
    /*handleFileChange(event) {

        this.product.files = Array.from(event.target.files);
    },*/
    clearError(fieldName) {
        if (this.validation.errors[fieldName] && this.validation.errors[fieldName].length > 0) {
            this.validation.errors[fieldName] = [];
        }
    }
  },
  watch: {
    data: {
      handler(newValue) {
        this.product = { ...newValue }; // Cargar y refresh datos en la ventana modal
        console.log(this.product)
      },
      deep: true
    }
  },
};
</script>
