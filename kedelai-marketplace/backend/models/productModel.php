<?php
require_once 'app.php';

class ProductModel {

    // Menambahkan produk
    public static function addProduct($name, $description, $image_url) {
        global $pdo;
        $sql = "INSERT INTO products (name, description, image_url) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$name, $description, $image_url]);
    }

    // Mendapatkan semua produk
    public static function getAllProducts() {
        global $pdo;
        $sql = "SELECT * FROM products";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mendapatkan produk berdasarkan ID
    public static function getProductById($id) {
        global $pdo;
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mengupdate produk
    public static function updateProduct($id, $name, $description, $image_url) {
        global $pdo;
        $sql = "UPDATE products SET name = ?, description = ?, image_url = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$name, $description, $image_url, $id]);
    }

    // Menghapus produk
    public static function deleteProduct($id) {
        global $pdo;
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
