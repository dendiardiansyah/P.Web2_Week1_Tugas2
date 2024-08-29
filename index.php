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
