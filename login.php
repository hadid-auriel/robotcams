<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Konfigurasi Kredensial Admin
    $valid_user = 'beli?';
    $valid_pass = 'terimakasih';

    if ($username === $valid_user && $password === $valid_pass) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body { margin: 0; padding: 0; background: #0f172a; display: flex; justify-content: center; align-items: center; height: 100vh; font-family: sans-serif; }
        .login-box { background: #1e293b; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.3); width: 100%; max-width: 350px; text-align: center; }
        .login-box h2 { color: #f8fafc; margin-bottom: 20px; font-weight: 500; }
        .input-group { margin-bottom: 15px; text-align: left; }
        .input-group label { display: block; color: #94a3b8; margin-bottom: 5px; font-size: 0.9rem; }
        .input-group input { width: 100%; padding: 10px; background: #0f172a; border: 1px solid #334155; color: white; border-radius: 4px; outline: none; box-sizing: border-box; }
        .input-group input:focus { border-color: #3b82f6; }
        .btn { width: 100%; padding: 10px; background: #3b82f6; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; margin-top: 10px; }
        .btn:hover { background: #2563eb; }
        .error { color: #ef4444; font-size: 0.85rem; margin-bottom: 15px; }
        .back-link { display: block; margin-top: 20px; color: #64748b; text-decoration: none; font-size: 0.85rem; }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Secure Area</h2>
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" required autocomplete="off">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <a href="index.php" class="back-link">← Kembali ke Halaman Utama</a>
    </div>

</body>
</html>