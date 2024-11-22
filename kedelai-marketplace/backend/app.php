<?php
// Enable CORS
header("Access-Control-Allow-Origin: *"); // Allow all domains, you can specify a domain like "http://localhost"
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Allow the required HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow specific headers

// Check if it's a pre-flight request (OPTIONS method)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}


header('Content-Type: application/json');
$servername = "localhost"; // Ganti dengan host Anda
$username = "root"; // Ganti dengan username DB Anda
$password = ""; // Ganti dengan password DB Anda
$dbname = "kedelai_marketplace"; // Nama database Anda

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["message" => "Connection failed: " . $conn->connect_error]));
}

// Menangani request
$action = $_GET['action'] ?? null;
$data = json_decode(file_get_contents('php://input'), true);

switch($action) {
    case 'getAll':
        getAllProducts($conn);
        break;
    case 'add':
        addProduct($conn, $data);
        break;
    case 'update':
        updateProduct($conn, $data);
        break;
    case 'delete':
        deleteProduct($conn, $_GET['id']);
        break;
    default:
        echo json_encode(["message" => "Invalid action"]);
}

function getAllProducts($conn) {
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $products = [];
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        echo json_encode($products);
    } else {
        echo json_encode([]);
    }
}

function addProduct($conn, $data) {
    $name = $data['name'];
    $description = $data['description'];
    $image_url = $data['image_url'];

    $sql = "INSERT INTO products (name, description, image_url) VALUES ('$name', '$description', '$image_url')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Product added successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $sql . "<br>" . $conn->error]);
    }
}

function updateProduct($conn, $data) {
    $id = $data['id'];
    $name = $data['name'];
    $description = $data['description'];
    $image_url = $data['image_url'];

    $sql = "UPDATE products SET name='$name', description='$description', image_url='$image_url' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Product updated successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $sql . "<br>" . $conn->error]);
    }
}

function deleteProduct($conn, $id) {
    $sql = "DELETE FROM products WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Product deleted successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
}

$conn->close();
?>
