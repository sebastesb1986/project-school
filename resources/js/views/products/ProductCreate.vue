<template>
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="bg-light p-4 rounded">
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
                    <button type="button" class="btn btn-dark" @click="createProduct">Guardar</button>
                </form>
            </div>
        </div>
    </main>
</template>

<script>

  import axios from 'axios';

  export default {
    name: 'productCreate',

    data() {
      return {

        validation: {
            errors: {}
        },
        product: {
            name: "",
            description: "",
            quantity: "",
            category_id: "",
        },
        categories: [],

      }
    },
    components: { },
    mounted() {
      // Mostrar las listas de productos.
      this.getCategories();
    },
    methods: {
        async getCategories() {
            try {
                const response = await axios.get(`/categories`);
                this.categories = response.data.categories;
            } catch (error) {
                console.error("Error fetching categories:", error);
            }
        },
        createProduct() {

            const route = '/product/create';

            // Gestión campos registrar producto
            const formData = new FormData();

            const arrayUser = ['name', 'description', 'quantity', 'category_id'];

            arrayUser.forEach((element) => {

                formData.append(element, this.product[element]);

            })

            axios.post(route, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then((response) => {

                const toast = response.data;

                this.successUpdate(toast)

                this.$router.push('/productList');

            }).catch(error => {

                if (error.response && error.response.status === 422) {
                    const toast = error.response.data.errors;
                    this.validation.errors = toast;
                    // Handle validation errors here
                } else {
                    console.error("Error updating user:", error);
                    // Handle other errors here
                }

            })

        },
        successUpdate(toast){

            this.$swal.fire({
                title: 'Registrado!',
                text: `${toast.success}`,
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
    }
  }
</script>
