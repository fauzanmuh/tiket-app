<?php
require 'db/koneksi.php';

// Tambah
if (isset($_POST['tambah'])) {
    $judul = trim($_POST['judul']);
    $harga = (int) $_POST['harga'];
    $gambar = trim($_POST['gambar']);
    if ($judul !== '' && $harga > 0) {
        $ins = $pdo->prepare("INSERT INTO film (judul, harga, gambar) VALUES (?, ?, ?)");
        $ins->execute([$judul, $harga, $gambar]);
        header("Location: film.php");
        exit;
    }
}

// Hapus
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $del = $pdo->prepare("DELETE FROM film WHERE id = ?");
    $del->execute([$id]);
    header("Location: film.php");
    exit;
}

// Update
if (isset($_POST['update'])) {
    $id = (int) $_POST['id'];
    $judul = trim($_POST['judul']);
    $harga = (int) $_POST['harga'];
    $gambar = trim($_POST['gambar']);
    if ($judul !== '' && $harga > 0) {
        $up = $pdo->prepare("UPDATE film SET judul = ?, harga = ?, gambar = ? WHERE id = ?");
        $up->execute([$judul, $harga, $gambar, $id]);
        header("Location: film.php");
        exit;
    }
}

// Read
$films = $pdo->query("SELECT * FROM film ORDER BY id DESC")->fetchAll();
$editFilm = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM film WHERE id = ?");
    $stmt->execute([$id]);
    $editFilm = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Kelola Film</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar">
        <div class="logo">🎬 LenTix</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="film.php">Kelola Film</a></li>
        </ul>
        <div class="hamburger">&#9776;</div>
    </nav>

    <div class="container">
        <div class="crud-container">
            <h1>Kelola Film</h1>

            <?php if ($editFilm): ?>
                <h2>Edit Film</h2>
                <form method="post" class="crud-form">
                    <input type="hidden" name="id" value="<?= $editFilm['id'] ?>">
                    <input type="text" name="judul" value="<?= htmlspecialchars($editFilm['judul']) ?>"
                        placeholder="Judul Film" required>
                    <input type="number" name="harga" value="<?= $editFilm['harga'] ?>" placeholder="Harga Tiket" required>
                    <input type="text" name="gambar" value="<?= htmlspecialchars($editFilm['gambar']) ?>"
                        placeholder="URL Gambar (opsional)">

                    <div style="display: flex; gap: 10px;">
                        <button type="submit" name="update" style="flex: 1;">Update</button>
                        <a href="film.php" class="btn-cancel" style="flex: 1;">Batal</a>
                    </div>
                </form>
            <?php else: ?>
                <h2>Tambah Film</h2>
                <form method="post" class="crud-form">
                    <input type="text" name="judul" placeholder="Judul Film" required>
                    <input type="number" name="harga" placeholder="Harga Tiket" required>
                    <input type="text" name="gambar" placeholder="URL Gambar (opsional)">
                    <button type="submit" name="tambah">Tambah</button>
                </form>
            <?php endif; ?>
        </div>

        <h2>Daftar Film</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Poster</th>
                    <th>Judul</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($films as $f): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><img src="<?= htmlspecialchars($f['gambar']) ?>" alt="" width="80"></td>
                        <td><?= htmlspecialchars($f['judul']) ?></td>
                        <td>Rp <?= number_format($f['harga'], 0, ',', '.') ?></td>
                        <td>
                            <a class="btn-sm" href="film.php?edit=<?= $f['id'] ?>">Edit</a>
                            <a class="btn-sm btn-danger" href="film.php?hapus=<?= $f['id'] ?>"
                                onclick="return confirm('Hapus film?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js" defer></script>
</body>

</html>