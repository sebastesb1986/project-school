<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">

        <div class="container-fluid">

            <router-link :to="{ name: 'welcome' }" class="navbar-brand">
                <i class="bi bi-person-workspace"></i> project-school
            </router-link>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <template v-if="authenticated">
                        <li class="nav-item">
                            <router-link :to="{ name: 'home' }" class="nav-link" :class="$route.name == 'home' ? 'active' : '' ">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'categorylist' }" class="nav-link" :class="$route.name == 'categorylist' ? 'active' : '' ">Lista de categorias</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'productlist' }" class="nav-link" :class="$route.name == 'product' ? 'active' : '' ">Listado de productos</router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">
                                    <i class="bi bi-person-fill"></i>
                                    {{  user.name  }}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                    <i class="bi bi-envelope-at"></i>
                                    {{  user.email  }}
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#" @click.prevent="signOut">Cerrar sesión</a></li>
                            </ul>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>

import { mapGetters, mapActions } from 'vuex';

export default {

  data() {

    return {

    }

  },
  components: {

  },

  computed: {

    ...mapGetters({

      authenticated: 'auth/authenticated',
      user: 'auth/user'


    })
  },

  methods: {

    ...mapActions({
      signOutAction: 'auth/signOut'
    }),

    signOut() {
      this.signOutAction().then(() => {

        //this.$toast.success("Has finalizado tu sesión");

        this.$router.replace({
          name: 'home'
        })

      })
    }

  }
}

</script>
