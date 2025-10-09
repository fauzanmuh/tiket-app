<?php
require 'db/koneksi.php';
$films = $pdo->query("SELECT * FROM film ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemesanan Tiket</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/booking.js" defer></script>
  <script src="js/script.js" defer></script>
</head>

<body>
  <nav class="navbar">
    <div class="logo">🎬 TiketKu</div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="booking.php" class="active">Pemesanan</a></li>
      <li><a href="data.php">Data Pemesan</a></li>
      <li><a href="film.php">Kelola Film</a></li>
    </ul>
    <div class="hamburger">&#9776;</div>
  </nav>

  <section class="cart-section">
    <h1 class="section-title">🧾 Pemesanan Tiket</h1>

    <div class="cart-container">
      <div class="film-carousel-container">
        <button class="carousel-btn prev">&#10094;</button>

        <div class="film-carousel">
          <?php foreach ($films as $film): ?>
            <div class="film-item" data-id="<?= $film['id'] ?>" data-harga="<?= $film['harga'] ?>">
              <img src="<?= $film['gambar'] ?: 'https://placehold.co/300x400?text=No+Image' ?>"
                alt="<?= htmlspecialchars($film['judul']) ?>">
              <div class="film-info">
                <h2><?= htmlspecialchars($film['judul']) ?></h2>
                <p>Harga: Rp <?= number_format($film['harga'], 0, ',', '.') ?></p>
                <button class="btn-select" data-id="<?= $film['id'] ?>">Pilih</button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <button class="carousel-btn next">&#10095;</button>
      </div>

      <div class="cart-form">
        <form id="formPemesanan" action="submit.php" method="POST">
          <h3>Detail Pemesan</h3>

          <label>Nama:</label>
          <input type="text" name="nama" id="nama" placeholder="Masukkan nama kamu">

          <label>Email:</label>
          <input type="email" name="email" id="email" placeholder="Masukkan email kamu">

          <label>Film yang Dipilih:</label>
          <input type="text" id="filmTitle" readonly style="background:#eee;">
          <input type="hidden" name="film_id" id="film_id">

          <label>Jumlah Tiket:</label>
          <div class="counter">
            <button type="button" id="decrement">−</button>
            <input type="number" name="jumlah" id="jumlahTiket" value="1" readonly>
            <button type="button" id="increment">+</button>
          </div>

          <p id="totalHarga">Total: Rp 0</p>

          <button type="submit" id="btnSubmit">Pesan Sekarang</button>
        </form>

        <div id="hasilPemesanan" style="display:none;"></div>
      </div>
    </div>
  </section>
</body>

</html>