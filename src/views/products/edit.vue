<script setup>
    //import ref
    import { ref, onMounted } from "vue";
 
    //import router
    import { useRouter, useRoute } from 'vue-router';
 
    //import api
    import api from "../../api";
 
    //init router
    const router = useRouter();
 
    //init route
    const route = useRoute();
 
    //define state
    const name = ref("");
    const description = ref("");
    const price = ref(0);
    const stock = ref(0);
    const category = ref("");
    const errors = ref([]);
 
    //onMounted
    onMounted(async () => {
        //fetch detail data post by ID
        await api.get(`/api/products/${route.params.id}`)
        .then(response => {
            //set response data to state
            name.value = response.data.data.name;
            description.value = response.data.data.description;
            price.value = response.data.data.price;
            stock.value = response.data.data.stock;
            category.value = response.data.data.category;
        });
    });
 
    //method "updateproduct"
    const updateproduct = async () => {
        //init formData
        let formData = new FormData();

        //assign state value to formData
        formData.append("name", name.value);
        formData.append("description", description.value);
        formData.append("price", price.value);
        formData.append("stock", stock.value);
        formData.append("category", category.value);
        formData.append("_method", "PATCH");
 
        //store data with API
        await api.post(`/api/products/${route.params.id}`, formData)
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
                <div class="card bproduct-0 rounded shadow">
                    <div class="card-body">
                        <form @submit.prevent="updateproduct()">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control" v-model="name" placeholder="Product Name">
                                <div v-if="errors.name" class="alert alert-danger mt-2">
                                    <span>{{ errors.name[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea class="form-control" v-model="description" rows="3" placeholder="Product Description"></textarea>
                                <div v-if="errors.description" class="alert alert-danger mt-2">
                                    <span>{{ errors.description[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="number" class="form-control" v-model="price" placeholder="Product Price">
                                <div v-if="errors.price" class="alert alert-danger mt-2">
                                    <span>{{ errors.price[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Stock</label>
                                <input type="number" class="form-control" v-model="stock" placeholder="Product Stock">
                                <div v-if="errors.stock" class="alert alert-danger mt-2">
                                    <span>{{ errors.stock[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <input type="text" class="form-control" v-model="category" placeholder="Product Category">
                                <div v-if="errors.category" class="alert alert-danger mt-2">
                                    <span>{{ errors.category[0] }}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow bproduct-0">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>