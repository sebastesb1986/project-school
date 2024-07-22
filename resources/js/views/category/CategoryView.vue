<template>
    <main class="container py-5">

      <div>
        <router-link :to="{ name: 'categorycreate' }" class="btn btn-primary"><i class="bi bi-plus"></i> Agregar categoria</router-link>
      </div>

        <div class="table-responsive">
          <DataTable class="table table-striped display" :data="categories" :columns="columns" :options="options">
            <thead>
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Acciones</th>
                </tr>
            </thead>
            <template #action="props">
              <div class="d-grid gap-2 d-md-flex">
                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal"
                  @click="editCategory(props.rowData)"><i class="bi bi-pencil"></i></button>
                <button type="button" class="btn btn-sm btn-danger" @click="confirmDelete(props.rowData.id)"><i class="bi bi-x"></i></button>
              </div>
            </template>
          </DataTable>
        </div>

        <!-- Modal -->
        <UpdateCategory @succesfully="getData" :data="selectedCategory"></UpdateCategory>
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
  import UpdateCategory from "@/components/modals/UpdateCategory.vue"

  // Usar Datatable bs5
  DataTable.use(DataTableLib);

  export default {
    name: 'userView',

    data() {
      return {

        categories: [],
        selectedCategory: null,
        categoryId: 0,

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
      UpdateCategory,

    },
    computed: {

      ...mapGetters({

        authenticated: 'auth/authenticated',
        user: 'auth/user'

      })
    },
    mounted() {
      // Mostrar listado de categorías
      this.getData();
    },
    methods: {

      async getData() {
        try {
          const response = await axios.get(`/categories`);
          this.categories = response.data.categories;
        } catch (error) {
          console.error("Error fetching category list:", error);
        }
      },
      editCategory(rowData) {
        this.selectedUser = { ...rowData }; // Make a copy to avoid mutating original data
        this.categoryId = rowData.id;
      },
      confirmDelete(id) {

        this.$swal.fire({
          title: '¿Seguro?',
          text: "¿Quieres eliminar esta categoría?",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si',
          cancelButtonText: 'No',
        }).then((result) => {
          if (result.isConfirmed) {

            this.deleteCategory(id);

          }
        })

      },
      async deleteCategory(id) {
        try {
          await axios.delete(`/category/${id}`);
          this.getData(); // Refresh listado de categoría
          this.$swal.fire(
            'Eliminado!',
            'Categoría eliminado exitosamente.',
            'success'
          );
        } catch (error) {
          console.error("Error deleting categoría:", error);
        }
      }
    }
  }
  </script>
