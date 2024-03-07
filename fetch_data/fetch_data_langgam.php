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
$sql = "SELECT total_beban FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result = mysqli_query($conn, $sql);
 
$total_beban = array();
while ($row = mysqli_fetch_assoc($result)) {
  $total_beban[] = $row['total_beban'];
}


$sql = "SELECT * FROM monitoring_realtimes WHERE 
parameter LIKE '%PLTU BOLOK%' OR
parameter LIKE '%PLTU IPP%' OR 
parameter LIKE '%PLANT%' OR
parameter LIKE '%PLTS%' OR
parameter LIKE '%CAT 2%' OR
parameter LIKE '%WMW%' OR
parameter LIKE '%PLTU_TIMOR-1%'
";

$result1 = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql);

// Membuat variabel untuk menampung output
$output1 = '';
$total_seluruh_beban = 0;

while ($row = mysqli_fetch_assoc($result1)) {
  $total_seluruh_beban += $row['value'];
}

$batubara = 0;
$mfo = 0;
$b30 = 0;
$surya = 0;

while ($row = mysqli_fetch_assoc($result2)) {
  if (strpos($row['parameter'], 'PLTU') !== false) {
    $batubara += $row['value'];
  }elseif (strpos($row['parameter'], 'PLTD') !== false) {
    $mfo += $row['value'];
  }elseif (strpos($row['parameter'], 'PLTS') !== false) {
    $surya += $row['value'];
  }else{
    $b30 += $row['value'];
  }
}

$presentase_batubara = round($batubara / $total_seluruh_beban * 100, 2);
$presentase_mfo = round($mfo / $total_seluruh_beban * 100, 2);
$presentase_b30 = round($b30 / $total_seluruh_beban * 100, 2);
$presentase_surya = round($surya / $total_seluruh_beban * 100, 2);

$data_chart_donut = [$presentase_batubara, $presentase_mfo, $presentase_b30, $presentase_surya];

mysqli_close($conn);

$data = array(
  'langgam_beban' => $total_beban,
  'data_chart_donut' => $data_chart_donut
);

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);

?>