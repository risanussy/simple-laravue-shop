<template>
  <NavbarRoot />
  <div class="container pt-4">
    <h1>Tambah Product.</h1>
    <br>
    <div class="info"></div>
    <form @submit.prevent="add()">
      <div class="mb-3">
        <label class="form-label">Nama Product</label>
        <input class="form-control" type="text" v-model="nama" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Deskripsi Product</label>
        <input class="form-control" type="text" v-model="desc" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Foto Product</label>
        <input class="form-control" type="file" @input="e => foto = e.target.files[0]" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Harga Product</label>
        <input class="form-control" type="number" v-model="harga" required>
      </div>
      <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
  </div>
  <br>
  <hr>
  <br>
</template>

<script>
  import NavbarRoot from '@/components/NavbarRoot.vue';
  import axios from 'axios';

  export default {
    name: 'LoginView',
    components: {
      NavbarRoot
    },
    data(){
      return {
        nama: '',
        desc: '',
        foto: null,
        harga: ''
      }
    },
    methods : {
      add(){
        let formData = new FormData()

        formData.append('nama', this.nama)
        formData.append('desc', this.desc)
        formData.append('foto', this.foto)
        formData.append('harga', this.harga)

        axios.post("http://localhost:8000/api/products/add", formData, {
          Headers: {'Content-Type': 'multipart/form-data'}
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
