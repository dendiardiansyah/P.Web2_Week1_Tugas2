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