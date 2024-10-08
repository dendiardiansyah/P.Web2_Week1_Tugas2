﻿# P.Web2 Tugas2
## Pendahuluan
SIWALI JKB merupakan sistem manajemen akademik yang dirancang untuk memudahkankan proses mengelola kinerja siswa, konseling, dan data akademik lainnya untuk institusi pendidikan yang lebih tinggi. <br>
Pada Tugas 2 ini saya mendapatkan studi kasus students & achievements dimana saya mengimplementasikan tugas :
1. Membuat <b>View</b> berbasis OOP, dengan mengambil data dari database MySQL
2. Menggunakan <b>method _construct</b> sebagai tautan ke database
3. Menerapkan <b>encapsulation</b> sesuai dengan logika studi kasus
4. Membuat kelas turunan menggunakan konsep <b>inheritance</b>
5. Menerapkan <b>polymorphism</b> untuk 2 role sesuai dengan studi kasus

## ERD
![357750791-40c6870d-13cf-4278-adbc-3089686a7282](https://github.com/user-attachments/assets/b9c2fb8b-415a-4724-a8d7-f3371ce4a7ec)

## Code

### 1. koneksi.php
```php
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
```
<br> <br>

### 2. students.php
```php
<?php
// Memuat file koneksi database
require_once 'koneksi.php';

// Menyertakan file index.php, yang berisi navbar dan bootstrap
include 'index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIWALI</title>
</head>

<body>
    <main class="container mt-5">
        <h1 class="text-center mb-4">Student Access</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>NIM</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Signature</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Looping melalui setiap baris data yang ada di $rows2 -->           
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <!-- Menampilkan data ID mahasiswa -->
                            <td><?= $row['id_student'] ?></td>
                            <!-- Menampilkan NIM mahasiswa -->
                            <td><?= $row['student_number'] ?></td>
                            <!-- Menampilkan nama mahasiswa -->
                            <td><?= $row['name'] ?></td>
                            <!-- Menampilkan nomor telepon mahasiswa -->
                            <td><?= $row['phone_number'] ?></td>
                            <!-- Menampilkan alamat mahasiswa -->
                            <td><?= $row['address'] ?></td>
                            <!-- Menampilkan tanda tangan mahasiswa -->
                            <td><?= $row['signature'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
```
<br> <br>

### 3. lecturers.php
```php
<?php
// Memuat file koneksi database
require_once 'koneksi.php';

// Menyertakan file index.php, yang berisi navbar dan bootstrap
include 'index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIWALI</title>
</head>

<body>
    <main class="container mt-5">
        <h1 class="text-center mb-4">Lecturers Access</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>NIM</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Signature</th>
                        <th>Achievements</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Looping melalui setiap baris data yang ada di $rows2 -->
                    <?php foreach ($rows2 as $row) : ?>
                        <tr>
                            <!-- Menampilkan data ID mahasiswa -->
                            <td><?= $row['id_student'] ?></td>
                            <!-- Menampilkan NIM mahasiswa -->
                            <td><?= $row['student_number'] ?></td>
                            <!-- Menampilkan nama mahasiswa -->
                            <td><?= $row['name'] ?></td>
                            <!-- Menampilkan nomor telepon mahasiswa -->
                            <td><?= $row['phone_number'] ?></td>
                            <!-- Menampilkan alamat mahasiswa -->
                            <td><?= $row['address'] ?></td>
                            <!-- Menampilkan tanda tangan mahasiswa -->
                            <td><?= $row['signature'] ?></td>
                            <!-- Menampilkan tipe pencapaian mahasiswa -->
                            <td><?= $row['achievement_type'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
```
<br> <br>

### 4. achievements.php
```php
<?php
// Memuat file koneksi database
require_once 'koneksi.php';

// Menyertakan file index.php, yang berisi navbar dan bootstrap
include 'index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIWALI</title>
</head>

<body>
    <main class="container mt-5">
        <h1 class="text-center mb-4">Achievements List</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID Achievement</th>
                        <th>Achievement Type</th>
                        <th>Level</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Looping melalui setiap baris data yang ada di $achievements -->
                    <?php foreach ($achievements as $row) : ?>
                        <tr>
                            <!-- Menampilkan data ID achievement -->
                            <td><?= $row['id_achievement'] ?></td>
                            <!-- Menampilkan tipe achievement -->
                            <td><?= $row['achievement_type'] ?></td>
                            <!-- Menampilkan level achievement -->
                            <td><?= $row['level'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
```
<br> <br>

### 5. index.php
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Menentukan judul halaman yang akan ditampilkan di tab browser -->
    <title>SIWALI</title>
    
    <!-- Memuat file CSS Bootstrap dari CDN untuk penggunaan fitur Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Bagian navigasi (navbar) menggunakan Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">SIWALI</a>
            
            <!-- Tombol untuk menampilkan navbar dalam mode collapse pada perangkat mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Daftar link navigasi yang akan muncul ketika tombol navbar ditekan pada perangkat mobile -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <!-- Menu untuk halaman Students -->
                    <li class="nav-item">
                        <a class="nav-link active" href="students.php">Students</a>
                    </li>
                    <!-- Menu untuk halaman Lecturers -->
                    <li class="nav-item">
                        <a class="nav-link active" href="lecturers.php">Lecturers</a>
                    </li>
                    <!-- Menu untuk halaman Achievements -->
                    <li class="nav-item">
                        <a class="nav-link active" href="achievements.php">Achievements</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Menampilkan judul halaman -->
        <h1 class="text-center mb-4">Welcome to SIWALI</h1>
    </div>

    <!-- Memuat file JavaScript Bootstrap dari CDN untuk interaksi dan komponen dinamis -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
```

## Output

### 1. index.php
![image](https://github.com/user-attachments/assets/f160782f-ceab-4903-aa81-c6260d404c09)
<br> <br>

### 2. students.php
![image](https://github.com/user-attachments/assets/e66f09a0-a783-4d21-8a62-2c3564de6e8c)
<br> <br>

### 3. lecturers.php
![image](https://github.com/user-attachments/assets/af6b56c8-dd2c-4af5-8483-9df9b2276ee2)
<br> <br>

### 4. achievements.php
![image](https://github.com/user-attachments/assets/081a7641-7f2f-4b6f-a496-22486262802c)


## Database

### Students
![image](https://github.com/user-attachments/assets/968e7acc-7ba0-4e2f-aa0e-6081df96634b)


### Achievements
![image](https://github.com/user-attachments/assets/dc231200-34aa-4ed1-892a-997e5f3d5b29)
