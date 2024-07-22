<template>
    <main class="container py-5">

      <div>
        <router-link :to="{ name: 'productcreate' }" class="btn btn-primary"><i class="bi bi-plus"></i> Agregar producto</router-link>
      </div>

        <div class="table-responsive">
          <DataTable class="table table-striped display" :data="products" :columns="columns" :options="options">
            <thead>
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Categoría</th>
                  <th scope="col">Acciones</th>
                </tr>
            </thead>
            <template #action="props">
              <div class="d-grid gap-2 d-md-flex">
                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal"
                  @click="editProduct(props.rowData)"><i class="bi bi-pencil"></i></button>
                <button type="button" class="btn btn-sm btn-danger" @click="confirmDelete(props.rowData.id)"><i class="bi bi-x"></i></button>
              </div>
            </template>
          </DataTable>
        </div>

           <!-- Modal -->
        <UpdateProduct @succesfully="getData" :data="selectedProduct"></UpdateProduct>
    </main>
  </template>

  <style>
    @import 'datatables.net-bs5';
  </style>

  <script>

  import { mapGetters, mapActions } from 'vuex';
  import axios from 'axios';
  // Datatable
  import DataTable from 'datatables.net-vue3';
  import DataTableLib from 'datatables.net-bs5';
  import 'datatables.net-responsive-bs5';
  //Modal
  import UpdateProduct from "@/components/modals/UpdateProduct.vue"

  // Usar Datatable bs5
  DataTable.use(DataTableLib);

  export default {
    name: 'productView',

    data() {
      return {

        products: [],
        selectedProduct: null,

        // Config Datatables
        options: {
          responsive: true,
          autowidth: false,
          language:{
            search:'Buscar', zeroRecords:'No hay registros para mostrar',
            lengthMenu: "Mostrar _MENU_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            info: 'Mostrando del _START_ a _END_ de _TOTAL_ registros',
            infoFiltered: '(Filtrados de _MAX_ registros.)',
            paginate: {first: 'Primero', previous: 'Anterior', next: 'Siguiente', last: 'Ultimo'},
            emptyTable: "No hay datos disponibles en la tabla"
          }
        },
        columns: [

          {data:'name'},
          {data:'description'},
          {data:'quantity'},
          {data:'categories.name'},
          {
            data: null,
            render: {
              _: 'name',
              display: '#action'
            },
            title: 'Acciones'
          },

        ],
        // End config Datatables

      }
    },
    components: {

      DataTable,
      UpdateProduct

    },
    computed: {

      ...mapGetters({

        authenticated: 'auth/authenticated',
        user: 'auth/user'

      })
    },
    mounted() {
      // Mostrar listado de productos
      this.getData();
    },
    methods: {

      async getData() {
        try {
          const response = await axios.get(`/products`);
          this.products = response.data.products;

        } catch (error) {
          console.error("Error fetching products list:", error);
        }
      },
      editProduct(rowData) {
        this.selectedProduct = { ...rowData }; // Obtenemos los parametros para ser enviados a la modal update
      },
      confirmDelete(id) {

        this.$swal.fire({
          title: '¿Seguro?',
          text: "¿Quieres eliminar este usuario?",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si',
          cancelButtonText: 'No',
        }).then((result) => {
          if (result.isConfirmed) {

            this.deleteProduct(id);

          }
        })

      },
      async deleteProduct(id) {
        try {
          await axios.delete(`/product/${id}`);
          this.getData(); // Refresh listado de productos
          this.$swal.fire(
            'Eliminado!',
            'Usuario eliminado exitosamente.',
            'success'
          );
        } catch (error) {
          console.error("Error deleting product:", error);
        }
      }
    }
  }
  </script>
