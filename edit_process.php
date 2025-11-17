<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}

$data_file = __DIR__ . "/data/contacts.json";

// Pastikan file ada
if (!file_exists($data_file)) {
    file_put_contents($data_file, json_encode([], JSON_PRETTY_PRINT));
}

$contacts = json_decode(file_get_contents($data_file), true);
if (!is_array($contacts)) $contacts = [];

// Ambil ID dari URL
$id = isset($_POST['id']) ? intval($_POST['id']) : null;

if ($id === null || !isset($contacts[$id])) {
    die("Kontak tidak ditemukan.");
}

// Ambil data dari form
$nama = trim($_POST["nama"] ?? "");
$email = trim($_POST["email"] ?? "");
$hp = trim($_POST["hp"] ?? "");

// Validasi
$errors = [];

if ($nama === "") $errors[] = "Nama harus diisi";
if ($email === "") $errors[] = "Email harus diisi";
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Format email salah";
if ($hp === "") $errors[] = "Nomor HP harus diisi";

if (!empty($errors)) {
    session_start();
    $_SESSION["edit_errors"] = $errors;
    header("Location: edit.php?id=" . $id);
    exit;
}

// Update data
$contacts[$id] = [
    "nama" => $nama,
    "email" => $email,
    "hp" => $hp
];

// Simpan kembali
file_put_contents($data_file, json_encode($contacts, JSON_PRETTY_PRINT));

// Kembali ke index
header("Location: index.php");
exit;
?>
