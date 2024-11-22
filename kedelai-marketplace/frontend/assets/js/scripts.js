// Fungsi untuk menampilkan atau menyembunyikan form tambah produk
function toggleProductForm() {
    const formContainer = document.getElementById('product-form-container');
    formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
}

// Fungsi untuk mengambil data produk dari server
function getProducts() {
    fetch('http://localhost:8000?action=getAll')
        .then(response => response.json())
        .then(data => {
            const productList = document.getElementById('product-list');
            productList.innerHTML = ''; // Kosongkan daftar produk sebelumnya
            data.forEach(product => {
                const productDiv = document.createElement('div');
                productDiv.classList.add('product-card');
                productDiv.innerHTML = `
                    <img src="${product.image_url}" alt="${product.name}">
                    <h3>${product.name}</h3>
                    <p>${product.description}</p>
                    <button onclick="editProduct(${product.id})">Edit</button>
                    <button onclick="deleteProduct(${product.id})">Hapus</button>
                `;
                productList.appendChild(productDiv);
            });
        });
}

// Fungsi untuk menambahkan produk
document.getElementById('product-form').addEventListener('submit', function (e) {
    e.preventDefault();  // Mencegah form melakukan reload

    const name = document.getElementById('name').value;
    const description = document.getElementById('description').value;
    const image_url = document.getElementById('image_url').value;

    // Mengirim data produk ke backend (app.php)
    fetch('http://localhost:8000?action=add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name, description, image_url })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);  // Menampilkan pesan sukses/gagal
        toggleProductForm();  // Menyembunyikan form setelah pengiriman
        getProducts();  // Memperbarui daftar produk
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambah produk.');
    });
});

// Fungsi untuk mengedit produk
function editProduct(id) {
    const newName = prompt('Nama Produk Baru:');
    const newDescription = prompt('Deskripsi Produk Baru:');
    const newImageUrl = prompt('URL Gambar Produk Baru:');
    if (newName && newDescription && newImageUrl) {
        fetch('http://localhost:8000?action=update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id: id,
                name: newName,
                description: newDescription,
                image_url: newImageUrl
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            getProducts();  // Memperbarui daftar produk
        });
    }
}

// Fungsi untuk menghapus produk
function deleteProduct(id) {
    if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
        fetch(`http://localhost:8000?action=delete&id=${id}`, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            getProducts();  // Memperbarui daftar produk
        });
    }
}

// Panggil fungsi getProducts untuk menampilkan produk saat halaman dimuat
window.onload = getProducts;

