<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

$data_file = __DIR__ . "/data/contacts.json";
if (!file_exists($data_file)) {
    file_put_contents($data_file, json_encode([], JSON_PRETTY_PRINT));
}

$contacts = json_decode(file_get_contents($data_file), true);
if (!is_array($contacts)) $contacts = [];

if ($id === null || !isset($contacts[$id])) {
    die("Kontak tidak ditemukan.");
}

$nama = $contacts[$id]['nama'];
$email = $contacts[$id]['email'];
$hp = $contacts[$id]['hp'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kontak - JTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #fff9db; }
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
        }
        .btn-jtech {
            background-color: #f1c40f;
            border: none;
            font-weight: 600;
        }
        .btn-jtech:hover { background-color: #d4ac0d; }
        .back-link { text-decoration: none; color: #555; font-size: 14px; }
        .back-link:hover { color: #000; }
    </style>
</head>

<body>
<div class="container col-md-6 mt-5">

    <div class="card p-4">
        <h4 class="mb-3 fw-bold">✏️ Edit Kontak</h4>

        <a href="index.php" class="back-link mb-3 d-inline-block">← Kembali ke daftar kontak</a>

        <form action="edit-process.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($nama) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($email) ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Nomor HP</label>
                <input type="text" class="form-control" name="hp" value="<?= htmlspecialchars($hp) ?>" required>
            </div>

            <button class="btn btn-jtech w-100 py-2">Simpan Perubahan</button>
        </form>

    </div>
</div>
</body>
</html>
