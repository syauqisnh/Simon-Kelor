$.ajax({
    url: 'fetch_data/fetch_data_realtime_beban_pembangkit.php', // Ganti dengan path ke file PHP yang berisi script untuk mengambil data monitoring
    method: 'GET',
    dataType: 'html',
    success: function(data) {
      // Menampilkan data monitoring ke dalam elemen dengan id "monitoring-data"
      $('#card_left').html(data);
    console.log(data);
    },
    error: function(xhr, status, error) {
      console.error(error); // Menampilkan pesan error jika permintaan AJAX gagal
    }
  });
  