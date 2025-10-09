<?php
require 'db/koneksi.php';
$films = $pdo->query("SELECT * FROM film ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home - TiketKu</title>
  <link rel="stylesheet" href="css/style.css" />
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

  <section class="home">
    <h1 class="section-title">🎬 Daftar Film</h1>
    <main class="container">
      <div class="film-grid">
        <?php foreach ($films as $film): ?>
          <div class="film-card">
            <img src="<?= $film['gambar'] ?: 'https://placehold.co/300x400?text=No+Image' ?>"
              alt="<?= htmlspecialchars($film['judul']) ?>">
            <h2><?= htmlspecialchars($film['judul']) ?></h2>
            <p>Harga: Rp <?= number_format($film['harga'], 0, ',', '.') ?></p>
            <a href="booking.php" class="btn-book">Pesan Sekarang</a>
          </div>
        <?php endforeach; ?>
      </div>
    </main>
  </section>
</body>

</html>