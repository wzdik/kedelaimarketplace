<?php
require_once 'models/productModel.php';

// Mendapatkan semua produk
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'getAll') {
    $products = ProductModel::getAllProducts();
    echo json_encode($products);
}

// Menambahkan produk
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];

    $result = ProductModel::addProduct($name, $description, $image_url);
    if ($result) {
        echo json_encode(["message" => "Produk berhasil ditambahkan"]);
    } else {
        echo json_encode(["message" => "Gagal menambahkan produk"]);
    }
}

// Mengupdate produk
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];

    $result = ProductModel::updateProduct($id, $name, $description, $image_url);
    if ($result) {
        echo json_encode(["message" => "Produk berhasil diperbarui"]);
    } else {
        echo json_encode(["message" => "Gagal memperbarui produk"]);
    }
}

// Menghapus produk
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = ProductModel::deleteProduct($id);
    if ($result) {
        echo json_encode(["message" => "Produk berhasil dihapus"]);
    } else {
        echo json_encode(["message" => "Gagal menghapus produk"]);
    }
}
