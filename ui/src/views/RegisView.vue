<template>
  <NavbarAnon />
  <div class="container pt-4">
    <h1>Daftar</h1>
    <br>
    <div class="info"></div>
    <form @submit.prevent="regis()">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" v-model="nama" required>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="email" required>
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" v-model="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
  </div>
</template>

<script>
  import NavbarAnon from '@/components/NavbarAnon.vue';
  import axios from 'axios';

  export default {
    name: 'RegisView',
    components: {
      NavbarAnon
    },
    data(){
      return {
        nama : '',
        email : '',
        password : '' 
      }
    },
    methods : {
      regis(){
        axios.post("http://localhost:8000/api/auth/regis", {
          nama: this.nama, email: this.email, password : this.password
        })
          .then(res => {
            document.querySelector('.info').innerHTML = `
            <div class="alert alert-success" role="alert">
              ${res.data.message}
            </div>`
          })
      }
    }
  }
</script>
