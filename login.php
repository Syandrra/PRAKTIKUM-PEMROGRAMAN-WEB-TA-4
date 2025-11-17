<?php
session_start();

if (isset($_SESSION["logged_in"])) {
    header("Location: index.php");
    exit;
}

$err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST["username"] ?? "";
    $pass = $_POST["password"] ?? "";

    if ($user === "admin" && $pass === "123") {
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $user;
        header("Location: index.php");
        exit;
    } else {
        $err = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - JTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fff9db; }
        .card { margin-top: 100px; border-radius: 12px; }
    </style>
</head>
<body>

<div class="container col-md-4">
    <div class="card p-4 shadow">
        <h3 class="text-center">Login</h3>

        <?php if ($err): ?>
            <div class="alert alert-danger mt-3"><?= $err ?></div>
        <?php endif; ?>

        <form method="POST">
            <label class="mt-3">Username</label>
            <input type="text" name="username" class="form-control" required>

            <label class="mt-3">Password</label>
            <input type="password" name="password" class="form-control" required>

            <button class="btn btn-warning w-100 mt-4">Login</button>
        </form>
    </div>
</div>

</body>
</html>
