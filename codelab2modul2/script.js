// script.js

function jumlah() {
    var bil1 = parseFloat(document.getElementById("bil1").value);
    var bil2 = parseFloat(document.getElementById("bil2").value);
    var hasil = bil1 + bil2;

    if (!isNaN(hasil)) {
        document.getElementById("hasil").textContent = hasil;
    } else {
        document.getElementById("hasil").textContent = "Input tidak valid";
    }
}

function reset() {
    document.getElementById("bil1").value = "";
    document.getElementById("bil2").value = "";
    document.getElementById("hasil").textContent = "0";
}
