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
      <li><a href="booking.php">Pemesanan</a></li>
      <li><a href="data.php">Data Pemesan</a></li>
      <li><a href="film.php">Kelola Film</a></li>
    </ul>
    <div class="hamburger">&#9776;</div>
  </nav>

  <section class="form-section">
    <h1>🧾 Form Pemesanan Tiket</h1>
    <form id="formPemesanan" action="submit.php" method="POST">
      <label>Nama:</label>
      <input type="text" name="nama" id="nama">

      <label>Email:</label>
      <input type="email" name="email" id="email">

      <label>Pilih Film:</label>
      <select name="film_id" id="filmSelect">
        <option value="">-- Pilih Film --</option>
        <?php foreach ($films as $film): ?>
          <option value="<?= $film['id'] ?>" data-harga="<?= $film['harga'] ?>">
            <?= htmlspecialchars($film['judul']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label>Jumlah Tiket:</label>
      <input type="number" name="jumlah" id="jumlahTiket" min="1" value="1">

      <p id="totalHarga">Total: Rp 0</p>

      <button type="submit" id="btnSubmit">Pesan Sekarang</button>
    </form>

    <div id="hasilPemesanan" style="display:none;"></div>
  </section>
</body>

</html>