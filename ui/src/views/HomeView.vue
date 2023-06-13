<template>
  <NavbarRoot />
  <div class="container pt-4">
    <h1>Products.</h1>
    <br>
    <div class="kotak">
      <div v-for="data in datas" :key="data.id">
        <div class="card shadow" style="width: 18rem;">
          <div class="frame">
            <img :src="'http://localhost:8000/images/'+data.foto" class="card-img-top" :alt="data.nama">
          </div>
          <div class="card-body">
            <h5 class="card-title">{{ data.nama }}</h5>
            <small>{{ data.harga }}</small>
            <br>
            <br>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail" @click="detail(data.id)">Detail</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal --><!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <img :src="'http://localhost:8000/images/'+beli.foto" class="card-img-top" :alt="beli.nama">
          </div>
          <div class="col">
            <ul class="list-group">
              <li class="list-group-item">{{ beli.nama }}</li>
              <li class="list-group-item">{{ beli.harga }}</li>
              <li class="list-group-item">{{ beli.desc }}</li>
            </ul>
          </div>
          <br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Beli</button>
          <button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-cart-plus"></i></button>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
// @ is an alias to /src
import NavbarRoot from "../components/NavbarRoot.vue";
  import axios from 'axios';


export default {
  name: 'HomeView',
  components: {
    NavbarRoot
  },
  data(){
    return {
      datas : [],
      beli : []
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
    detail(id){
      axios.get("http://localhost:8000/api/products/detail/" + id)
        .then(res => {
          this.beli = res.data.data
        })
    },
  }
}
</script>

<style>
  .frame {
    width: 100%;
    height: 160px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
  }

  .kotak {
    display: flex;
    gap: 15px;
  }
</style>