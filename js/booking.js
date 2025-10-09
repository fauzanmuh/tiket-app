$(document).ready(function () {
  // Hitung total otomatis
  $('#filmSelect, #jumlahTiket').on('change keyup', function () {
    const harga = parseInt($('#filmSelect option:selected').data('harga')) || 0;
    const jumlah = parseInt($('#jumlahTiket').val()) || 0;
    const total = harga * jumlah;
    $('#totalHarga').text('Total: Rp ' + total.toLocaleString('id-ID'));
  });

  // Validasi form
  $('#formPemesanan').on('submit', function (e) {
    e.preventDefault();
    let valid = true;
    let pesan = "";

    const nama = $('#nama').val().trim();
    const email = $('#email').val().trim();
    const film = $('#filmSelect').val();
    const jumlah = $('#jumlahTiket').val();

    if (nama === "") { valid = false; pesan += "Nama wajib diisi!\n"; }
    if (email === "" || !email.includes("@")) { valid = false; pesan += "Email tidak valid!\n"; }
    if (!film) { valid = false; pesan += "Pilih film terlebih dahulu!\n"; }
    if (jumlah <= 0) { valid = false; pesan += "Jumlah tiket minimal 1!\n"; }

    if (!valid) {
      alert(pesan);
      return;
    }

    // Kirim AJAX tanpa reload
    $.ajax({
      url: 'submit.php',
      method: 'POST',
      data: $(this).serialize(),
      success: function (res) {
        $('#hasilPemesanan').html(res).hide().fadeIn(300).fadeOut(3000);
        $('#formPemesanan')[0].reset();
        $('#totalHarga').text('Total: Rp 0');
      },
      error: function () {
        alert('Terjadi kesalahan server!');
      }
    });
  });
});
