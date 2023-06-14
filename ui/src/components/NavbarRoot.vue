<template>   
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
      <router-link class="navbar-brand" to="#">
        <img src="../assets/logo.png" class="logo">
        Navbar
      </router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link class="nav-link active" aria-current="page" to="/home">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/form">Admin</router-link>
          </li>
        </ul>
        <div class="ms-auto">
          <button class="btn btn-outline-danger" @click="logout()">
            Log-out
          </button>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
    import axios from 'axios';
    export default {
        name:'navbarRoot',
        methods: {
          logout(){
            axios.post("http://localhost:8000/api/auth/logout")
            .then(()=> {
              window.location = '/' 
            })
          }
        }
    }
</script>