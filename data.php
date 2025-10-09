<?php
require 'db/koneksi.php';
$pesanan = $pdo->query("SELECT p.*, f.judul FROM pesanan p JOIN film f ON p.film_id = f.id ORDER BY p.id DESC")->fetchAll(); ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemesan</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js" defer></script>
</head>

<body>
    <nav class="navbar">
        <div class="logo">🎬 TiketKu</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="booking.php">Pemesanan</a></li>
            <li><a href="data.php">Data Pemesan</a></li>
            <li><a href="film.php">Kelola Film</a></li>
        </ul>
        <div class="hamburger">&#9776;</div>
    </nav>

    <section class="container data-section">
        <h1>📊 Data Pemesan</h1>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Film</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pesanan as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nama']) ?></td>
                        <td><?= htmlspecialchars($p['email']) ?></td>
                        <td><?= htmlspecialchars($p['judul']) ?></td>
                        <td><?= $p['jumlah'] ?></td>
                        <td>Rp <?= number_format($p['total'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>

</html>