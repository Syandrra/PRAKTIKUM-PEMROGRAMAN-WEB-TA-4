<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}

$data_file = __DIR__ . "/data/contacts.json";
$contacts = json_decode(file_get_contents($data_file), true);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kontak - JTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #fffbea;
            font-family: 'Segoe UI', sans-serif;
        }

        .page-title {
            font-size: 26px;
            font-weight: 700;
            color: #3d3d3d;
        }

        .card-custom {
            border-radius: 14px;
            padding: 28px;
            border: 1px solid #f0e3b2;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            background: #ffffff;
        }

        .btn-jtech {
            background: #ffc107;
            font-weight: 600;
            border-radius: 8px;
            border: none;
        }

        .btn-jtech:hover {
            background: #e0a800;
        }

        .back-link {
            font-size: 14px;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5" style="max-width: 750px;">

    <div class="card-custom">

        <a href="index.php" class="back-link">← Kembali</a>

        <div class="page-title mb-4">Tambah Kontak</div>

        <!-- PERBAIKAN DI SINI ———— -->
        <form action="add_process.php" method="POST">

            <label class="mb-1">Nama</label>
            <input type="text" name="nama" class="form-control mb-3" required>

            <label class="mb-1">Email</label>
            <input type="email" name="email" class="form-control mb-3" required>

            <label class="mb-1">No HP</label>
            <input type="text" name="hp" class="form-control mb-4" required>

            <button class="btn btn-jtech w-100 py-2">Simpan</button>
        </form>

    </div>

</div>

</body>
</html>
