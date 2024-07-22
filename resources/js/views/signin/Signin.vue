<template>
    <main class="form-signin">
        <form  @submit.prevent="submit">
            <h1 class="h3 mb-3 fw-normal text-center">Iniciar sesión</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="form.email">
                <label for="floatingInput">Correo electrónico</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="form.password">
                <label for="floatingPassword">Contraseña</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Ingresar</button>
        </form>
    </main>
</template>

<style>

  .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
    margin-top: 10%;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
  }

  .form-signin .form-floating {
    margin-bottom: 15px;
  }

  .form-signin input[type="email"],
  .form-signin input[type="password"] {
    font-size: 16px;
    border-radius: 5px;
    padding: 10px;
    border: 1px solid #ccc;
  }

  .form-signin input[type="email"]:focus,
  .form-signin input[type="password"]:focus {
    outline: none;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    border-color: #6c757d;
  }

  .form-signin .btn-primary {
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    padding: 12px;
    background-color: #007bff;
    border: 1px solid #007bff;
    transition: background-color 0.3s ease, border-color 0.3s ease;
  }

  .form-signin .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
  }

  .form-signin h1 {
    font-size: 24px;
    font-weight: bold;
    color: #333;
  }

  .form-check-input {
    margin-top: 5px;
  }

</style>


<script>

import { mapActions } from 'vuex';

export default {

  name: 'signIn',
  components: {
      //
  },

  data() {

    return {

      validation: {
        noUser: "",
        errors: {}
      },


      form: {
        email: '',
        password: ''
      }

    }

  },
  methods: {

    ...mapActions({

      signIn: 'auth/signIn'

    }),
    submit() {

      this.signIn(this.form)
        .then(() => {


          // Una vez iniciada la sesión, se redirecciona a la vista home
          this.$router.replace({
            name: 'welcome'
          })

        })
        .catch((e) => {

          const arr = e.response;
          // const toast = arr.data.errors;

          if (arr.status == 401) {

            //


          }
          else if (arr.status == 422) {
            //

          }

        })


    }

  }

}
</script>
