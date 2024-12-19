<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
      <div class="container">
        <router-link :to="{ name: 'home' }" class="navbar-brand">HOME</router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link 
                :to="{ name: 'orders.index' }" 
                class="nav-link" 
                :class="{ active: isActiveRoute('orders.index') }"
                aria-current="page"
              >
                Orders
              </router-link>
            </li>
            <li class="nav-item">
              <router-link 
                :to="{ name: 'products.index' }" 
                class="nav-link" 
                :class="{ active: isActiveRoute('products.index') }"
                aria-current="page"
              >
                Products
              </router-link>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0" role="search">
            <a href="#" target="_blank" class="btn btn-success">LOGIN</a>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Render router view -->
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  methods: {
    isActiveRoute(routeName) {
      return this.$route.name === routeName; // Mengecek apakah route saat ini sesuai dengan nama route
    },
  },
};
</script>

<style>
.nav-link.active {
  color: white !important; /* Warna teks ketika aktif */
  background-color: #0d6efd; /* Background biru untuk aktif */
  border-radius: 5px; /* Untuk tampilan lebih estetik */
}
</style>
