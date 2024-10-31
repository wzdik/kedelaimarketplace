<?php

// Namespace untuk mengatur kelas dalam kelompok berbeda
namespace PemrogramanWebsite2024;

// Trait yang akan digunakan di dalam kelas
trait Pesan {
    public function tampilPesan() {
        return "Selamat datang di aplikasi Data Mahasiswa!";
    }
}

// Abstract Class
abstract class Manusia {
    abstract public function pekerjaan();
}

// Kelas Orang menggunakan Abstract Class dan Trait
class Orang extends Manusia {
    // Properties
    public $nama;
    public $umur;
    protected $status;

    use Pesan; // Menggunakan trait

    // Constructor (Magic Method)
    public function __construct($nama, $umur, $status = "Tidak Aktif") {
        $this->nama = $nama;
        $this->umur = $umur;
        $this->status = $status;
    }

    // Method pekerjaan diimplementasikan dari Abstract Class
    public function pekerjaan() {
        return "Mahasiswa";
    }

    // Method tambahan
    public function tampilkanInfo() {
        return "Nama : {$this->nama}<br>Umur : {$this->umur}<br>Pekerjaan : " . $this->pekerjaan() . "<br>Status : " . $this->status;
    }

    // Magic Method __toString
    public function __toString() {
        return $this->tampilkanInfo();
    }
}

// Kelas Mahasiswa mewarisi (Inheritance) dari kelas Orang
class Mahasiswa extends Orang {
    private $jurusan;

    // Constructor
    public function __construct($nama, $umur, $jurusan, $status = "Aktif") {
        parent::__construct($nama, $umur, $status);
        $this->jurusan = $jurusan;
    }

    // Method untuk menampilkan jurusan
    public function tampilJurusan() {
        return "Jurusan : {$this->jurusan}";
    }

    // Method untuk menampilkan status keaktifan mahasiswa
    public function statusMahasiswa() {
        return $this->status === "Aktif" ? "Mahasiswa Aktif" : "Mahasiswa Tidak Aktif";
    }

    // Overloading method tampilkanInfo untuk tambahan informasi jurusan
    public function tampilkanInfo() {
        return parent::tampilkanInfo() . "<br>" . $this->tampilJurusan();
    }
}

// Instansiasi objek
$mahasiswa = new Mahasiswa("Andika Nur Islamy", 21, "Teknik Informatika");
echo $mahasiswa->tampilPesan() . "<br><br>";
echo $mahasiswa . "<br>"; // Menggunakan magic method __toString
echo $mahasiswa->statusMahasiswa() . "<br>";
?>

