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
    const product_name = ref("");
    const quantity = ref(0);
    const total_price = ref("");
    const category = ref("");
    const shipping_address = ref("");
    const payment_method = ref("");
    const status = ref("");
    const errors = ref([]);
 
    //onMounted
    onMounted( async () => {
 
        //fetch detail data post by ID
        await api.get(`/api/order/${route.params.id}`)
        .then(response => {
 
            //set response data to state
            product_name.value = response.data.data.product_name;
            quantity.value = response.data.data.quantity;
            total_price.value = response.data.data.total_price;
            category.value = response.data.data.category;
            shipping_address.value = response.data.data.shipping_address;
            payment_method.value = response.data.data.payment_method;
            status.value = response.data.data.status;
        });
    })
 
    //method "updatePost"
    const updatePost = async () => {
 
        //init formData
        let formData = new FormData();
 
        //assign state value to formData
        formData.append("product_name", product_name.value);
        formData.append("quantity", quantity.value);
        formData.append("total_price", total_price.value);
        formData.append("category", category.value);
        formData.append("shipping_address", shipping_address.value);
        formData.append("payment_method", payment_method.value);
        formData.append("status", status.value);
        formData.append("_method", "PATCH");
 
        //store data with API
        await api.post(`/api/order/${route.params.id}`, formData)
        .then(() => {
            //redirect
            router.push({ path: "/order" });
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
                        <form @submit.prevent="updatePost()">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Product Name</label>
                                <input type="text" class="form-control" v-model="product_name" placeholder="Product Name">
                                <div v-if="errors.product_name" class="alert alert-danger mt-2">
                                    <span>{{ errors.product_name[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" class="form-control" v-model="quantity" placeholder="Quantity">
                                <div v-if="errors.quantity" class="alert alert-danger mt-2">
                                    <span>{{ errors.quantity[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Total Price</label>
                                <input type="text" class="form-control" v-model="total_price" placeholder="Total Price">
                                <div v-if="errors.total_price" class="alert alert-danger mt-2">
                                    <span>{{ errors.total_price[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <input type="text" class="form-control" v-model="category" placeholder="Category">
                                <div v-if="errors.category" class="alert alert-danger mt-2">
                                    <span>{{ errors.category[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Shipping Address</label>
                                <input type="text" class="form-control" v-model="shipping_address" placeholder="Shipping Address">
                                <div v-if="errors.shipping_address" class="alert alert-danger mt-2">
                                    <span>{{ errors.shipping_address[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Payment Method</label>
                                <input type="text" class="form-control" v-model="payment_method" placeholder="Payment Method">
                                <div v-if="errors.payment_method" class="alert alert-danger mt-2">
                                    <span>{{ errors.payment_method[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <input type="text" class="form-control" v-model="status" placeholder="Status">
                                <div v-if="errors.status" class="alert alert-danger mt-2">
                                    <span>{{ errors.status[0] }}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
