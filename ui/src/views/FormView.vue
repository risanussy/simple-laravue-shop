<template>
  <NavbarRoot />
  <div class="container pt-4">
    <div v-if="edity === true">
    <h1>Edit Product.</h1>
    <br>
    <div class="info"></div>
      <form @submit.prevent="update(beli.id)">
        <div class="mb-3">
          <label class="form-label">Nama Product</label>
          <input class="form-control" type="text" :value="beli.nama" @input="e => nama = e.target.value" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi Product</label>
          <input class="form-control" type="text" :value="beli.desc" @input="e => desc = e.target.value" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Foto Product</label>
          <input class="form-control" type="file" @input="e => foto = e.target.files[0]" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Harga Product</label>
          <input class="form-control" type="number" :value="beli.harga" @input="e => harga = e.target.value" required>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
      </form>
    </div>
    <div v-else>
    <h1>Tambah Product.</h1>
    <br>
    <div class="info"></div>
      <form @submit.prevent="add()">
        <div class="mb-3">
          <label class="form-label">Nama Product</label>
          <input class="form-control" type="text" @input="e => nama = e.target.value" required>
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
  </div>
  <br>
  <hr>
  <br>
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">nama produk</th>
          <th scope="col">deskripsi</th>
          <th scope="col">gambar</th>
          <th scope="col">harga</th>
          <th scope="col">fitur</th>
        </tr>
      </thead>
      <tbody v-for="(data , index) in datas" :key="data.id">
        <tr>
          <th scope="row">{{ index + 1 }}</th>
          <td>{{ data.nama }}</td>
          <td>{{ data.desc }}</td>
          <td><img :src="'http://localhost:8000/images/'+data.foto" style="height: 60px;"></td>
          <td>{{ data.harga }}</td>
          <td>
            <button class="btn btn-success me-2" @click="edit(data.id)">edit</button>
            <button class="btn btn-danger" @click="hapus(data.id)">hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
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
        harga: '',
        datas: [],
        beli: [],
        edity: false
      }
    },
    mounted(){
      axios.get("http://localhost:8000/api/products/list")
        .then(res => {
          this.datas = res.data.data
        })
    },
    methods : {
      list(){
        axios.get("http://localhost:8000/api/products/list")
          .then(res => {
            this.datas = res.data.data
          })
      },
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
            this.list()
            this.nama = ''
            this.desc = ''
            this.foto = null
            this.harga = ''
          })
      },
      update(id){
        let formData = new FormData()

        formData.append('nama', this.nama)
        formData.append('desc', this.desc)
        formData.append('foto', this.foto)
        formData.append('harga', this.harga)

        axios.post("http://localhost:8000/api/products/edit/" + id, formData, {
          Headers: {'Content-Type': 'multipart/form-data'}
        })
          .then(res => {
            this.list()
            this.edity = false
            this.beli = []
            this.nama = ''
            this.desc = ''
            this.foto = null
            this.harga = ''
            setTimeout(()=>{
              document.querySelector('.info').innerHTML = `
              <div class="alert alert-success" role="alert">
                ${res.data.message}
              </div>`
            }, 3000)
          })
          .catch(err => console.log(err))
      },
      hapus(id){
        axios.delete("http://localhost:8000/api/products/delete/" + id)
          .then(res => {
            document.querySelector('.info').innerHTML = `
            <div class="alert alert-success" role="alert">
              ${res.data.message}
            </div>`
            this.list()
          })
      },
      edit(id){
        axios.get("http://localhost:8000/api/products/detail/" + id)
          .then(res => {
            this.beli = res.data.data
            this.edity = true
            this.nama = this.beli.nama
            this.desc = this.beli.desc
            this.harga = this.beli.harga
          })
      },
    }
  }
</script>
