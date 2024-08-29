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