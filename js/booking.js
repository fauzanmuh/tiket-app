$(document).ready(function () {
  let selectedHarga = 0;

  // Klik tombol pilih film
  $(".btn-select").on("click", function () {
    const filmItem = $(this).closest(".film-item");
    const filmId = filmItem.data("id");
    const harga = parseInt(filmItem.data("harga"));
    const judul = filmItem.find("h2").text();

    // Simpan ke form
    $("#film_id").val(filmId);
    $("#filmTitle").val(judul);
    selectedHarga = harga;

    // Highlight film yang dipilih
    $(".film-item").removeClass("selected");
    filmItem.addClass("selected");

    hitungTotal();
  });

  // Counter tombol
  $("#increment").click(function () {
    let jumlah = parseInt($("#jumlahTiket").val()) || 1;
    $("#jumlahTiket").val(jumlah + 1);
    hitungTotal();
  });

  $("#decrement").click(function () {
    let jumlah = parseInt($("#jumlahTiket").val()) || 1;
    if (jumlah > 1) {
      $("#jumlahTiket").val(jumlah - 1);
      hitungTotal();
    }
  });

  // Fungsi hitung total
  function hitungTotal() {
    const jumlah = parseInt($("#jumlahTiket").val()) || 0;
    const total = selectedHarga * jumlah;
    $("#totalHarga").text("Total: Rp " + total.toLocaleString("id-ID"));
  }

  // Validasi & submit form
  $("#formPemesanan").on("submit", function (e) {
    e.preventDefault();

    const nama = $("#nama").val().trim();
    const email = $("#email").val().trim();
    const film = $("#film_id").val();
    const jumlah = parseInt($("#jumlahTiket").val()) || 0;

    let pesan = "";
    let valid = true;

    if (nama === "") {
      valid = false;
      pesan += "Nama wajib diisi!\n";
    }
    if (email === "" || !email.includes("@")) {
      valid = false;
      pesan += "Email tidak valid!\n";
    }
    if (!film) {
      valid = false;
      pesan += "Pilih film terlebih dahulu!\n";
    }
    if (jumlah <= 0) {
      valid = false;
      pesan += "Jumlah tiket minimal 1!\n";
    }

    if (!valid) {
      alert(pesan);
      return;
    }

    // Kirim AJAX tanpa reload
    $.ajax({
      url: "submit.php",
      method: "POST",
      data: $(this).serialize(),
      success: function (res) {
        $("#hasilPemesanan").html(res).hide().fadeIn(400).delay(5000).fadeOut(400);
        $("#formPemesanan")[0].reset();
        $("#film_id").val("");
        $("#filmTitle").val("");
        $("#totalHarga").text("Total: Rp 0");
        $(".film-item").removeClass("selected");
        selectedHarga = 0;
      },
      error: function () {
        alert("Terjadi kesalahan server!");
      },
    });
  });
});
