<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api';

// define state
const products = ref([]);

// method fetchDataProducts
const fetchDataProducts = async () => {
    await api.get('/api/products')
        .then(response => {
            products.value = response.data.data.data;
        });
};

// run hook "onMounted"
onMounted(() => {
    fetchDataProducts();
});

// method deleteProduct
const deleteProduct = async (id) => {
    await api.delete(`/api/products/${id}`)
        .then(() => {
            fetchDataProducts();
        });
};
</script>

<template>
    <div class="container mt-5 mb-5 gradient-bg">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <router-link 
                    :to="{ name: 'products.create' }" 
                    class="btn btn-md btn-success rounded shadow gradient-btn mb-4"
                >
                    <i class="fas fa-plus me-2"></i> ADD NEW PRODUCT
                </router-link>
                <div class="card border-0 rounded shadow gradient-card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover gradient-table">
                            <thead class="text-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Category</th>
                                    <th scope="col" style="width:15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="products.length === 0">
                                    <td colspan="6" class="text-center">
                                        <div class="alert alert-danger mb-0">
                                            <i class="fas fa-exclamation-circle me-2"></i> Data Not Available!
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else v-for="(product, index) in products" :key="index">
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.description }}</td>
                                    <td>${{ product.price }}</td>
                                    <td>{{ product.stock }}</td>
                                    <td>{{ product.category }}</td>
                                    <td class="text-center">
                                        <router-link 
                                            :to="{ name: 'products.edit', params:{id: product.id} }" 
                                            class="btn btn-sm rounded-sm shadow gradient-btn me-2"
                                        >
                                            <i class="fas fa-edit"></i> EDIT
                                        </router-link>
                                        <button 
                                            @click.prevent="deleteProduct(product.id)" 
                                            class="btn btn-sm rounded-sm shadow btn-danger gradient-btn"
                                        >
                                            <i class="fas fa-trash"></i> DELETE
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Color theme: Black and Green */
:root {
    --gradient-primary: linear-gradient(135deg, #32a852, #219639);
    --gradient-secondary: linear-gradient(135deg, #25d366, #128c4c);
    --gradient-bg: linear-gradient(135deg, #0d1117, #161b22);
    --text-light: #ffffff;
    --text-dark: #0d1117;
    --shadow-color: rgba(0, 255, 128, 0.3);
}

/* Background container */
.gradient-bg {
    background: var(--gradient-bg);
    padding: 40px;
    border-radius: 25px;
    box-shadow: 0 20px 30px var(--shadow-color);
    animation: fadeIn 1s ease-in-out;
}

/* Card styling */
.gradient-card {
    background: var(--text-dark);
    border: none;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 25px var(--shadow-color);
}

/* Tabel styling */
.gradient-table {
    border-radius: 15px;
    overflow: hidden;
}

/* Header tabel */
.gradient-table thead {
    background-color: #000000; /* Hitam */
    color: #ffffff;  /* Teks putih */
}

.gradient-table tbody tr {
    transition: all 0.3s ease;
}

.gradient-table tbody tr:hover {
    background: var(--gradient-secondary);
    color: var(--text-light);
    transform: scale(1.02);
    cursor: pointer;
}

/* Buttons with gradient */
.gradient-btn {
    background: var(--gradient-primary);
    color: var(--text-light);
    transition: all 0.3s ease;
    box-shadow: 0 6px 15px var(--shadow-color);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-weight: bold;
}

.gradient-btn:hover {
    background: var(--gradient-secondary);
    transform: scale(1.1);
    box-shadow: 0 8px 20px var(--shadow-color);
}

/* Alert styling */
.alert-danger {
    background-color: #ff4d4f;
    color: #ffffff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    padding: 10px;
    border-radius: 5px;
}

/* Smooth transitions and animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes shake {
    0% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    100% { transform: translateX(0); }
}

button, .btn, table, .card, .container {
    transition: all 0.3s ease;
}
</style>
