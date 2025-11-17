<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}

$data_file = __DIR__ . "/data/contacts.json";
if (!file_exists($data_file)) {
    file_put_contents($data_file, json_encode([], JSON_PRETTY_PRINT));
}
$contacts = json_decode(file_get_contents($data_file), true);
if (!is_array($contacts)) $contacts = [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>JTech Contact Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #fdfbf3;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Header */
        .topbar {
            background: #ffeb8a;
            padding: 14px 0;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            border-bottom: 1px solid #e5d37a;
        }

        /* Tombol simpel */
        .btn-jtech {
            background: #f7d24b;
            border: 1px solid #e3bf3f;
            font-weight: 500;
        }

        .btn-jtech:hover {
            background: #eac141;
        }

        /* Table */
        .table thead {
            background: #ffeaa7;
        }

        /* Card rapi */
        .card {
            border-radius: 10px;
            border: 1px solid #e9e2c8;
        }
    </style>
</head>
<body>

<div class="topbar">JTech Contact Manager</div>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold" style="margin:0;">Daftar Kontak</h4>

        <div class="d-flex gap-2">
            <a href="add.php" class="btn btn-jtech">Tambah</a>
            <a href="logout.php" class="btn btn-outline-danger">Logout</a>
        </div>
    </div>

    <div class="card p-3 mt-3">
        <table class="table table-bordered mb-0">
            <thead>
            <tr>
                <th style="width:50px;">#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th style="width:120px;">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($contacts)): ?>
                <tr>
                    <td colspan="5" class="text-center py-3">Belum ada kontak.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($contacts as $i => $c): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($c['nama']) ?></td>
                        <td><?= htmlspecialchars($c['email']) ?></td>
                        <td><?= htmlspecialchars($c['hp']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $i ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="delete.php?id=<?= $i ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Hapus kontak ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
