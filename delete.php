<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
$data_file = __DIR__ . "/data/contacts.json";
if (!file_exists($data_file)) file_put_contents($data_file, json_encode([], JSON_PRETTY_PRINT));
$contacts = json_decode(file_get_contents($data_file), true);
if (!is_array($contacts)) $contacts = [];

if ($id === null || !isset($contacts[$id])) {
    die("Kontak tidak ditemukan.");
}

// remove element and reindex
array_splice($contacts, $id, 1);

file_put_contents($data_file, json_encode($contacts, JSON_PRETTY_PRINT));
header("Location: index.php");
exit;
