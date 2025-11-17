<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}

$data_file = __DIR__ . "/data/contacts.json";

// Kalau file belum ada, buat kosong
if (!file_exists($data_file)) {
    file_put_contents($data_file, json_encode([], JSON_PRETTY_PRINT));
}

$contacts = json_decode(file_get_contents($data_file), true);
if (!is_array($contacts)) $contacts = [];

// Ambil data dari form
$nama = trim($_POST["nama"] ?? "");
$email = trim($_POST["email"] ?? "");
$hp = trim($_POST["hp"] ?? "");

// Validasi sederhana
if ($nama === "" || $email === "" || $hp === "") {
    die("Semua field wajib diisi!");
}

// Push data baru
$contacts[] = [
    "nama" => $nama,
    "email" => $email,
    "hp" => $hp
];

file_put_contents($data_file, json_encode($contacts, JSON_PRETTY_PRINT));

header("Location: index.php");
exit;
?>
