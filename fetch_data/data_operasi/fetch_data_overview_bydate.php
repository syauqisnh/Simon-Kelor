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

$date = $_POST['tanggal'];


$sql_langgam = "SELECT total_beban FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result_langgam = mysqli_query($conn, $sql_langgam);
 
$data_langgam = array();
while ($row = mysqli_fetch_assoc($result_langgam)) {
  $data_langgam[] = $row['total_beban'];
}

$sql_forecast = "SELECT beban_prediksi FROM load_forcasting WHERE DATE(tanggal) = '$date'";
$result_forecast = mysqli_query($conn, $sql_forecast);

$data_forecast = array();
while ($row = mysqli_fetch_assoc($result_forecast)) {
  $data_forecast[] = $row['beban_prediksi'];
}


// Query untuk mengambil data total_beban dari tabel beban_kit

$sql_beban_real = "SELECT total_beban FROM beban_kit WHERE DATE(tanggal) = '$date'";
$sql_beban_forecast = "SELECT beban_prediksi FROM load_forcasting WHERE DATE(tanggal) = '$date'";
$sql_beban_puncak_forecast = "SELECT MAX(beban_prediksi) as nilai_tertinggi FROM load_forcasting WHERE DATE(tanggal) = '$date'";
$sql_beban_puncak_sebenarnya = "SELECT MAX(total_beban) as nilai_tertinggi_sebenarnya FROM beban_kit WHERE DATE(tanggal) = '$date'";

$result = mysqli_query($conn, $sql_beban_puncak_forecast);
$result2 = mysqli_query($conn, $sql_beban_puncak_sebenarnya);
$result3 = mysqli_query($conn, $sql_beban_real);
$result4 = mysqli_query($conn, $sql_beban_forecast);

$data = 0;
$data_predic = 0;
$a = 0;
$b = 0;
$c = 0;
$deviasi = 0;
$load_factor = 0;

while ($row = mysqli_fetch_assoc($result3)) {
  $data += $row['total_beban'];
}
while ($row = mysqli_fetch_assoc($result4)) {
  $data_predic += $row['beban_prediksi'];
}
$deviasi = abs(($data - $data_predic) / $data_predic * 100);

// Membuat variabel untuk menampung output
$output1 = '';
$output2 = '';
$output3 = '';
$output4 = '';

while ($row = mysqli_fetch_assoc($result)) {
    $output1 .= '<td>Beban Puncak Rencana Sebesar</td>';
    $output1 .= '<td>' . $row['nilai_tertinggi'] . ' MW'.'</td>';
    $a = $row['nilai_tertinggi'];
}
while ($row = mysqli_fetch_assoc($result2)) {
    $output2 .= '<td>Beban Puncak Realisasi Sebesar</td>';
    $output2 .= '<td>' . $row['nilai_tertinggi_sebenarnya'] . ' MW'.'</td>';
    $b = $row['nilai_tertinggi_sebenarnya'];
}
$c = $b * 48;
$load_factor = ($data / $c) * 100;

$output3 .= '<td>Deviasi Rencana Realisasi</td>';
$output3 .= '<td>' . round($deviasi, 1). ' %'.'</td>';

$output4 .= '<td>Load Factor (LF) Sebesar</td>';
$output4 .= '<td>' .round($load_factor, 1). ' %'.'</td>';

// Menampilkan output
echo '<tr>'.$output1.'</tr>';
echo '<tr>'.$output2.'</tr>';
echo '<tr>'.$output3.'</tr>';
echo '<tr>'.$output4.'</tr>';

mysqli_close($conn);
