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
    const productName = ref("");
    const quantity = ref(0);
    const totalPrice = ref("");
    const category = ref("");
    const shippingAddress = ref("");
    const paymentMethod = ref("");
    const status = ref("");
    const errors = ref([]);
 
    //method "storeorder"
    const storeorder = async () => {
        //init formData
        let formData = new FormData();
 
        //assign state value to formData
        formData.append("product_name", productName.value);
        formData.append("quantity", quantity.value);
        formData.append("total_price", totalPrice.value);
        formData.append("category", category.value);
        formData.append("shipping_address", shippingAddress.value);
        formData.append("payment_method", paymentMethod.value);
        formData.append("status", status.value);
 
        //store data with API
        await api.post('/api/order', formData)
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
                        <form @submit.prevent="storeorder()">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Product Name</label>
                                <input type="text" class="form-control" v-model="productName" placeholder="Enter Product Name">
                                <div v-if="errors.product_name" class="alert alert-danger mt-2">
                                    <span>{{ errors.product_name[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" class="form-control" v-model="quantity" placeholder="Enter Quantity">
                                <div v-if="errors.quantity" class="alert alert-danger mt-2">
                                    <span>{{ errors.quantity[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Total Price</label>
                                <input type="text" class="form-control" v-model="totalPrice" placeholder="Enter Total Price">
                                <div v-if="errors.total_price" class="alert alert-danger mt-2">
                                    <span>{{ errors.total_price[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <input type="text" class="form-control" v-model="category" placeholder="Enter Category">
                                <div v-if="errors.category" class="alert alert-danger mt-2">
                                    <span>{{ errors.category[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Shipping Address</label>
                                <textarea class="form-control" v-model="shippingAddress" rows="3" placeholder="Enter Shipping Address"></textarea>
                                <div v-if="errors.shipping_address" class="alert alert-danger mt-2">
                                    <span>{{ errors.shipping_address[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Payment Method</label>
                                <input type="text" class="form-control" v-model="paymentMethod" placeholder="Enter Payment Method">
                                <div v-if="errors.payment_method" class="alert alert-danger mt-2">
                                    <span>{{ errors.payment_method[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <input type="text" class="form-control" v-model="status" placeholder="Enter Status">
                                <div v-if="errors.status" class="alert alert-danger mt-2">
                                    <span>{{ errors.status[0] }}</span>
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
