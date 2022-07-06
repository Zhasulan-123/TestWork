<template>
  <div class="container">
    <div class="row justify-content-md-center mt-5">
      <div class="col-6">
        <div v-if="error" class="alert alert-danger d-flex align-items-center" role="alert">
          <span class="material-symbols-outlined">bolt</span>
          <div>
            Ошибка! Логин/Пароль 
          </div>
        </div>
        <div class="card mt-5">
          <div class="card-body">
             <form @submit.prevent="login">
                <h2 class="text-center text-primary">Авторизация</h2>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email:</label>
                  <input 
                     v-model="form.email"
                     type="email" 
                     class="form-control" 
                     id="exampleInputEmail1" 
                     aria-describedby="emailHelp"
                  >
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Пароль:</label>
                  <input 
                     v-model="form.password"
                     type="password" 
                     class="form-control" 
                     id="exampleInputPassword1"
                  >
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import authService from "@/api/auth.service";

export default {
   name: 'Login',
   data() {
      return {
        form: {
          email: '',
          password: '',
        },
        error: false,
      }
    },
    methods: {
      async login() {
        const {success, errors} = await authService.login(this.form);
        if (success) {
          this.$router.push({name: 'Page'});
        }
        if(errors){
           this.error = true;
           setTimeout(() => {
              this.error = false;
            }, 3000);
        }
      }
    }
}
</script>
