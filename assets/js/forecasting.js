  function updateChartBySelection(selectedValue) {
    if (selectedValue === "default") {
    //   view_default();   
    } else {
      $.ajax({
        url: 'fetch_data/forecasting.php', // Ganti dengan path ke file PHP yang berisi script untuk mengambil data monitoring
        method: 'POST',
        data: { tanggal: selectedValue },
        dataType: 'html',
        error: function(xhr, status, error) {
          console.error(error); // Menampilkan pesan error jika permintaan AJAX gagal
        }
      });
    }
  }
  
  $("#tanggal").on("change", function () {
    updateChartBySelection(this.value);
  });
  
  updateChartBySelection("default");