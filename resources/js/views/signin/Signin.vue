<template>
    <main class="form-signin">
        <form @submit.prevent="submit">
            <h1 class="h3 mb-3 fw-normal text-center">Iniciar sesión</h1>
            <div v-if="validation.error"  class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ validation.error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="form-floating">
                <input
                    type="email"
                    class="form-control"
                    id="floatingInput"
                    placeholder="name@example.com"
                    v-model="form.email"
                    :class="{ 'is-invalid': validation.errors.email }"
                    @input="clearError('email')"
                    @blur="validateField('email')"
                />
                <label for="floatingInput">Correo electrónico</label>
                <span v-if="validation.errors.email" class="text-danger">{{ validation.errors.email }}</span>
            </div>
            <div class="form-floating">
                <input
                    type="password"
                    class="form-control"
                    id="floatingPassword"
                    placeholder="Password"
                    v-model="form.password"
                    :class="{ 'is-invalid': validation.errors.password }"
                    @input="clearError('password')"
                    @blur="validateField('password')"
                />
                <label for="floatingPassword">Contraseña</label>
                <span v-if="validation.errors.password" class="text-danger">{{ validation.errors.password }}</span>
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
// Validación de campos form login
import { defineComponent, reactive } from 'vue';
import * as yup from 'yup';

// Define el esquema de validación usando Yup
const schema = yup.object({
  email: yup.string().email('Debe ser un correo electrónico válido').required('El correo electrónico es obligatorio'),
  password: yup.string().min(6, 'La contraseña debe tener al menos 6 caracteres').required('La contraseña es obligatoria'),
});

export default defineComponent({
  name: 'signIn',
  data() {
    return {
      form: {
        email: '',
        password: ''
      },
      validation: reactive({
        errors: {},
        error: ""
      })
    };
  },
  methods: {
    ...mapActions({
      signIn: 'auth/signIn',
    }),

    async validateField(field) {
      try {
        await schema.validateAt(field, this.form);
        this.validation.errors[field] = ''; // Limpiar el error para el campo específico
      } catch (error) {
        this.validation.errors[field] = error.message; // Asignar el mensaje de error
      }
    },

    clearError(field) {
      // Limpiar el error para el campo específico
      this.validation.errors[field] = '';
    },

    async submit() {
      try {
        // Limpiar errores
        this.validation.errors = {};

        // Validar formulario login
        await schema.validate(this.form, { abortEarly: false });

        // Si la validación es exitosa, proceder con el envío
        await this.signIn(this.form)
        .then(() => {
            // Una vez iniciada la sesión, se redirecciona a la vista home
            this.$router.replace({ name: 'welcome'})

        })
        .catch((e) => {

            const arr = e.response;
            const toast = arr.data;

            if (arr.status == 401) {

                this.validation.error = toast.error;

            }
            else if(arr.status == 422){

                // Limpiar errores
                this.validation.errors = {};

                // Asignar mensaje de validación desde el backend
                Object.entries(toast.errors).forEach(([field, messages]) => {

                    // Verifica que viene un mensaje por campo validado
                    if (Array.isArray(messages) && messages.length > 0) {
                        this.validation.errors[field] = messages[0];
                    }

                });

            }

        })
      } catch (errors) {

        // Mapear los errores de validación
        errors.inner.forEach(error => {
          this.validation.errors[error.path] = error.message;
        });

      }
    }
  }
});
</script>
