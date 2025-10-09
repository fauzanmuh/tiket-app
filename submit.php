<?php
require 'db/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $film_id = $_POST['film_id'];
    $jumlah = $_POST['jumlah'];

    $film = $pdo->prepare("SELECT * FROM film WHERE id = ?");
    $film->execute([$film_id]);
    $dataFilm = $film->fetch();

    $total = $dataFilm['harga'] * $jumlah;

    $stmt = $pdo->prepare("INSERT INTO pesanan (nama, email, film_id, jumlah, total) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nama, $email, $film_id, $jumlah, $total]);

    echo "<div class='hasil-box'>
          <h3>✅ Pemesanan Berhasil!</h3>
          <p><strong>Nama:</strong> $nama</p>
          <p><strong>Email:</strong> $email</p>
          <p><strong>Film:</strong> {$dataFilm['judul']}</p>
          <p><strong>Jumlah Tiket:</strong> $jumlah</p>
          <p><strong>Total Bayar:</strong> Rp " . number_format($total, 0, ',', '.') . "</p>
        </div>";
}
?>