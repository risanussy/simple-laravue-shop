<template>
  <NavbarAnon />
  <div class="container pt-4">
    <h1>Login</h1>
    <br>
    <div class="info"></div>
    <form @submit.prevent="login()">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="email" required>
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" v-model="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
</template>

<script>
  import NavbarAnon from '@/components/NavbarAnon.vue';
  import axios from 'axios';

  export default {
    name: 'LoginView',
    components: {
      NavbarAnon
    },
    data(){
      return {
        email : '',
        password : '' 
      }
    },
    methods : {
      login(){
        axios.post("http://localhost:8000/api/auth/login", {
          email: this.email, password : this.password
        })
          .then(res => {
            if(res.data.code == 200){
              window.location = '/home'
            }else {
              document.querySelector('.info').innerHTML = `
              <div class="alert alert-danger" role="alert">
                ${res.data.message}
              </div>`
            }
          })
      }
    }
  }
</script>
