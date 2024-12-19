<script setup>
    //import ref
    import { ref } from "vue";
 
    //import router
    import { useRouter } from 'vue-router';
 
    //import api
    import api from "../../api";
 
    //init router
    const router = useRouter();
 
    //define state
    const name = ref("");
    const description = ref("");
    const price = ref("");
    const stock = ref(0);
    const category = ref("");
    const errors = ref([]);
 
    //method "storeProduct"
    const storeProduct = async () => {
        //init formData
        let formData = new FormData();
 
        //assign state value to formData
        formData.append("name", name.value);
        formData.append("description", description.value);
        formData.append("price", price.value);
        formData.append("stock", stock.value);
        formData.append("category", category.value);
 
        //store data with API
        await api.post('/api/products', formData)
        .then(() => {
            //redirect
            router.push({ path: "/products" });
        })
        .catch((error) => {
            //assign response error data to state "errors"
            errors.value = error.response.data;
        });
    };
</script>
 
<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <form @submit.prevent="storeProduct()">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Product Name</label>
                                <input type="text" class="form-control" v-model="name" placeholder="Enter Product Name">
                                <div v-if="errors.name" class="alert alert-danger mt-2">
                                    <span>{{ errors.name[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea class="form-control" v-model="description" rows="3" placeholder="Enter Description"></textarea>
                                <div v-if="errors.description" class="alert alert-danger mt-2">
                                    <span>{{ errors.description[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="text" class="form-control" v-model="price" placeholder="Enter Price">
                                <div v-if="errors.price" class="alert alert-danger mt-2">
                                    <span>{{ errors.price[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Stock</label>
                                <input type="number" class="form-control" v-model="stock" placeholder="Enter Stock">
                                <div v-if="errors.stock" class="alert alert-danger mt-2">
                                    <span>{{ errors.stock[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <input type="text" class="form-control" v-model="category" placeholder="Enter Category">
                                <div v-if="errors.category" class="alert alert-danger mt-2">
                                    <span>{{ errors.category[0] }}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
