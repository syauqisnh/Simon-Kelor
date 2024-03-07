<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_simonkelor_native";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data total_beban dari tabel beban_kit

$sql_forecast = "SELECT beban_prediksi FROM load_forcasting WHERE tanggal = CURDATE()";
$result = mysqli_query($conn, $sql_forecast);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row['beban_prediksi'];
}

mysqli_close($conn);

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
