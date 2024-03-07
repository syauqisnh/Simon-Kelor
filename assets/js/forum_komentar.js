$.ajax({
  url: 'fetch_data/fetch_data_ruang_diskusi.php?id=' + id, // Ganti dengan path ke file PHP yang berisi script untuk mengambil data monitoring
  method: 'GET',
  dataType: 'html',
  success: function(data) {
    // Menampilkan data monitoring ke dalam elemen dengan id "monitoring-data"
    $('#page_message').html(data);
  console.log(data);
  },
  error: function(xhr, status, error) {
    console.error(error); // Menampilkan pesan error jika permintaan AJAX gagal
  }
});

setInterval(function() {
  $.ajax({
    url: 'fetch_data/fetch_data_ruang_diskusi.php?id=' + id + '&nama_user=' + nama, // Ganti dengan path ke file PHP yang berisi script untuk mengambil data monitoring
    method: 'GET',
    dataType: 'html',
    success: function(data) {
      // Menampilkan data monitoring ke dalam elemen dengan id "monitoring-data"
      $('#page_message').html(data);
    console.log(data);
    }
  });
}, 1000);
