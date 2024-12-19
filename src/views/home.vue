<script setup>
// Tambahkan logika khusus jika diperlukan di sini
</script>

<template>
  <div class="container-fluid full-screen-container">
    <!-- Hero Section -->
    <div class="text-center text-white hero-section">
      <h1 class="display-4 fw-bold text-shadow">Selamat datang di Soybean Marketplace</h1>
      <p class="col-md-8 fs-4 mx-auto text-shadow">
        Temukan produk kedelai terbaik, yang dipilih dengan cermat dari alam untuk kesehatan Anda.
      </p>
      <router-link :to="{ name: 'products.index' }" class="btn btn-outline-light btn-lg mt-4 shadow-lg explore-btn">
        Jelajahi Produk
      </router-link>
    </div>

    <!-- Seksi Pilihan Produk -->
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-5 product-section">
      <!-- Produk 1 -->
      <div class="col">
        <div class="card shadow-lg border-0 rounded-3 product-card">
          <img src="https://cdn1-production-images-kly.akamaized.net/tKYk8nbe19YPlJpuGHtr6Ifcg3o=/1200x900/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/1458777/original/084376100_1483459341-Protein-Kedelai-dan-Kolesterol.jpg" class="card-img-top" alt="Protein Kedelai">
          <div class="card-body">
            <h5 class="card-title">Protein Kedelai</h5>
            <p class="card-text text-muted">Kandungan protein tinggi yang sempurna untuk diet sehat Anda.</p>
            <a href="https://www.klikdokter.com/ibu-anak/kesehatan-anak/kedelai-biji-bijian-dengan-beragam-manfaat" target="_blank" class="btn btn-outline-success">Lihat Detail</a>
          </div>
        </div>
      </div>

      <!-- Produk 2 -->
      <div class="col">
        <div class="card shadow-lg border-0 rounded-3 product-card">
          <img src="https://healthybelly.s3.amazonaws.com/gambar_sampul/gambar_sampul_1723127037.webp" class="card-img-top" alt="Manfaat Kedelai">
          <div class="card-body">
            <h5 class="card-title">Manfaat Kedelai</h5>
            <p class="card-text text-muted">Pelajari berbagai manfaat kesehatan dari kedelai untuk tubuh Anda.</p>
            <a href="https://www.klikdokter.com/ibu-anak/kesehatan-anak/kedelai-biji-bijian-dengan-beragam-manfaat" target="_blank" class="btn btn-outline-success">Lihat Detail</a>
          </div>
        </div>
      </div>

      <!-- Produk 3 -->
      <div class="col">
        <div class="card shadow-lg border-0 rounded-3 product-card">
          <img src="https://radartanggamus.disway.id/upload/707f02a866ede7a902e2c184ea5789e1.jpg" class="card-img-top" alt="Kedelai dan Kolesterol">
          <div class="card-body">
            <h5 class="card-title">Kedelai & Kolesterol</h5>
            <p class="card-text text-muted">Ketahui bagaimana kedelai dapat membantu menurunkan kadar kolesterol dalam darah.</p>
            <a href="https://www.klikdokter.com/ibu-anak/kesehatan-anak/kedelai-biji-bijian-dengan-beragam-manfaat" target="_blank" class="btn btn-outline-success">Lihat Detail</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Full-screen container */
.full-screen-container {
  height: 100vh;
  background: linear-gradient(to right, #81c784, #388e3c);
  animation: gradientAnimation 5s infinite alternate;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 0;
}

/* Hero section */
.hero-section {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  background: rgba(0, 0, 0, 0.5); /* dark overlay */
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Shadow text for titles */
.text-shadow {
  text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.2);
}

/* Animation for background gradient */
@keyframes gradientAnimation {
  0% {
    background: linear-gradient(to right, #81c784, #388e3c);
  }
  100% {
    background: linear-gradient(to right, #66bb6a, #2c6e2f);
  }
}

/* Explore Button */
.explore-btn {
  background-color: #ffffff;
  color: #388e3c;
  padding: 12px 30px;
  font-size: 1.25rem;
  text-transform: uppercase;
  border-radius: 30px;
  transition: all 0.3s ease;
  border: none;
}

.explore-btn:hover {
  background-color: #388e3c;
  color: white;
}

/* Product Section Styling */
.product-section {
  flex: 2;
  margin-top: 5%;
}

.product-card {
  transition: transform 0.3s ease-in-out;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.product-card:hover {
  transform: scale(1.05);
}

.card-img-top {
  height: 250px;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.product-card:hover .card-img-top {
  transform: scale(1.1);
}

.card-title {
  color: #388e3c;
  font-weight: bold;
}

.card-body {
  padding: 20px;
}

.card-text {
  font-size: 1rem;
  color: #777;
}

.card-body a {
  margin-top: 10px;
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-section {
    height: 50%;
  }
}
</style>
