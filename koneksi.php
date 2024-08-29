<?php
// Kelas database yang akan menjadi induk bagi kelas lain yang membutuhkan koneksi database
class database {
    // Deklarasi properti untuk menyimpan informasi koneksi database
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "siwali";
    protected $koneksi;

    // Konstruktor kelas untuk menginisialisasi koneksi ke database saat objek dibuat
    public function __construct() {
        // Membuat koneksi ke database menggunakan mysqli_connect
        $koneksi = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        // Menyimpan koneksi dalam properti kelas untuk digunakan di metode lain
        $this->koneksi = $koneksi;
        // Komentar out untuk pengecekan koneksi
        // if($koneksi) {
        //     echo "Koneksi Berhasil";
        // } else {
        //     echo "Koneksi Gagal";
        // }
    }

    // Metode untuk menampilkan semua data dari tabel 'students'
    public function tampil_students() {
        // Menjalankan query untuk mengambil semua data dari tabel 'students'
        $data = mysqli_query($this->koneksi, "SELECT * FROM students");
        // Mengambil setiap baris data dan menyimpannya ke dalam array $hasil
        while($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        // Memastikan $hasil di-set sebelum mengembalikannya
        if(isset($hasil)) {
            return $hasil;
        }
    }

    // Metode untuk menampilkan semua data dari tabel 'achievements'
    public function tampil_achievements() {
        // Menjalankan query untuk mengambil semua data dari tabel 'achievements'
        $data = mysqli_query($this->koneksi, "SELECT * FROM achievements");
        // Mengambil setiap baris data dan menyimpannya ke dalam array $hasil
        while($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        // Memastikan $hasil di-set sebelum mengembalikannya
        if(isset($hasil)) {
            return $hasil;
        }
    }
}

// Kelas students yang merupakan turunan dari kelas database
class students extends database {
    // Konstruktor kelas yang memanggil konstruktor induk
    public function __construct() {
        parent::__construct();
    }

    // Metode untuk menampilkan semua data dari tabel 'students'
    // Ini merupakan override dari metode tampil_students di kelas induk
    public function tampil_students() {
        // Menjalankan query untuk mengambil semua data dari tabel 'students'
        $data = mysqli_query($this->koneksi, "SELECT * FROM students");
        // Mengambil setiap baris data dan menyimpannya ke dalam array $hasil
        while($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        // Memastikan $hasil di-set sebelum mengembalikannya
        if(isset($hasil)) {
            return $hasil;
        } 
    }
}

// Kelas dosen yang merupakan turunan dari kelas database
class dosen extends database {
    // Konstruktor kelas yang memanggil konstruktor induk
    public function __construct() {
        parent::__construct();
    }

    // Metode untuk menampilkan data students dan achievements dengan join
    public function tampil_students() {
        // Menjalankan query untuk mengambil data dari tabel 'students' dengan join ke tabel 'achievements'
        $data = mysqli_query($this->koneksi, "SELECT * FROM students left join achievements on students.id_achievement = achievements.id_achievement");
        // Mengambil setiap baris data dan menyimpannya ke dalam array $hasil
        while($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        // Memastikan $hasil di-set sebelum mengembalikannya
        if(isset($hasil)) {
            return $hasil;
        } 
    }
}

// Kelas achievements yang merupakan turunan dari kelas database
class achievements extends database {
    // Konstruktor kelas yang memanggil konstruktor induk
    public function __construct() {
        parent::__construct();
    }
}

// Membuat objek dari kelas achievements dan menyimpan data yang diambil dari metode tampil_achievements ke dalam variabel $achievements
$achievements = new achievements();
$achievements = $achievements->tampil_achievements();

// Membuat objek dari kelas students dan menyimpan data yang diambil dari metode tampil_students ke dalam variabel $rows
$students = new students();
$rows = $students->tampil_students();

// Membuat objek dari kelas dosen dan menyimpan data yang diambil dari metode tampil_students ke dalam variabel $rows2
$dosen = new dosen();
$rows2 = $dosen->tampil_students();

?>