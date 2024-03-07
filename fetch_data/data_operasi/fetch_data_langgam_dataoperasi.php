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

$valuecurrentDate = date("y-m-d");

$sql_langgam = "SELECT total_beban FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result_langgam = mysqli_query($conn, $sql_langgam);
 
$data_langgam = array();
while ($row = mysqli_fetch_assoc($result_langgam)) {
  $data_langgam[] = $row['total_beban'];
}


$sql_forecast = "SELECT beban_prediksi FROM load_forcasting WHERE tanggal = CURDATE()";
$result_forecast = mysqli_query($conn, $sql_forecast);

$data_forecast = array();
while ($row = mysqli_fetch_assoc($result_forecast)) {
  $data_forecast[] = $row['beban_prediksi'];
}

// Query untuk mengambil data total_beban dari tabel beban_kit
$sql = "SELECT 	pltu_blk1, 	pltu_blk2 FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result = mysqli_query($conn, $sql);
$sql1 = "SELECT pltu_ipp_kpng1, pltu_ipp_kpng2 FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT pltd_cogindo FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result2 = mysqli_query($conn, $sql2);
$sql3 = "SELECT pltmg_kpng FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result3 = mysqli_query($conn, $sql3);
$sql4 = "SELECT plts_ipp_kpng FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result4 = mysqli_query($conn, $sql4);
$sql5 = "SELECT plts_ipp_atmb FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result5 = mysqli_query($conn, $sql5);
$sql6 = "SELECT ulpl_kpng_ngt FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result6 = mysqli_query($conn, $sql6);
$sql7 = "SELECT ulpl_kpng_mak FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result7 = mysqli_query($conn, $sql7);
$sql8 = "SELECT ulpl_atmb_cat2 FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result8 = mysqli_query($conn, $sql8);
$sql9 = "SELECT ulpl_atmb_mwm FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result9 = mysqli_query($conn, $sql9);
$sql10 = "SELECT ulpl_atmb_swd FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result10 = mysqli_query($conn, $sql10);
$sql11 = "SELECT 	pltu_timor1, 	pltu_timor2 FROM beban_kit WHERE DATE(tanggal) = CURDATE()";
$result11 = mysqli_query($conn, $sql11);
 
$data_pembangkit_pltu_bolok = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data_pembangkit_pltu_bolok[] = round($row['pltu_blk1'] + $row['pltu_blk2'], 2);
}
$data_pembangkit_pltu_ipp_kupang = array();
while ($row = mysqli_fetch_assoc($result1)) {
  $data_pembangkit_pltu_ipp_kupang[] = round($row['pltu_ipp_kpng1'] + $row['pltu_ipp_kpng2'], 2);
}
$data_pembangkit_pltd_cogindo = array();
while ($row = mysqli_fetch_assoc($result2)) {
  $data_pembangkit_pltd_cogindo[] = round($row['pltd_cogindo'], 2);
}
$data_pembangkit_pltmg_kupang = array();
while ($row = mysqli_fetch_assoc($result3)) {
  $data_pembangkit_pltmg_kupang[] = round($row['pltmg_kpng'], 2);
}
$data_pembangkit_plts_ipp_kpng = array();
while ($row = mysqli_fetch_assoc($result4)) {
  $data_pembangkit_plts_ipp_kpng[] = round($row['plts_ipp_kpng'], 2);
}
$data_pembangkit_plts_ipp_atmb = array();
while ($row = mysqli_fetch_assoc($result5)) {
  $data_pembangkit_plts_ipp_atmb[] = round($row['plts_ipp_atmb'], 2);
}
$data_pembangkit_ulpl_kpng_ngt = array();
while ($row = mysqli_fetch_assoc($result6)) {
  $data_pembangkit_ulpl_kpng_ngt[] = round($row['ulpl_kpng_ngt'], 2);
}
$data_pembangkit_ulpl_kpng_mak = array();
while ($row = mysqli_fetch_assoc($result7)) {
  $data_pembangkit_ulpl_kpng_mak[] = round($row['ulpl_kpng_mak'], 2);
}
$data_pembangkit_ulpl_atmb_cat2 = array();
while ($row = mysqli_fetch_assoc($result8)) {
  $data_pembangkit_ulpl_atmb_cat2[] = round($row['ulpl_atmb_cat2'], 2);
}
$data_pembangkit_ulpl_atmb_mwm = array();
while ($row = mysqli_fetch_assoc($result9)) {
  $data_pembangkit_ulpl_atmb_mwm[] = round($row['ulpl_atmb_mwm'], 2);
}
$data_pembangkit_ulpl_atmb_swd = array();
while ($row = mysqli_fetch_assoc($result10)) {
  $data_pembangkit_ulpl_atmb_swd[] = round($row['ulpl_atmb_swd'], 2);
}
$data_pembangkit_pltu_timor = array();
while ($row = mysqli_fetch_assoc($result11)) {
  $data_pembangkit_pltu_timor[] = round($row['pltu_timor1'] + $row['pltu_timor2'], 2);
}

mysqli_close($conn);

$data = array(
    'data_forecast' => $data_forecast,
    'data_langgam' => $data_langgam,
    'pltu_bolok' => $data_pembangkit_pltu_bolok,
    'pltu_ipp_kupang' => $data_pembangkit_pltu_ipp_kupang,
    'pltd_cogindo' => $data_pembangkit_pltd_cogindo,
    'pltmg_kupang' => $data_pembangkit_pltmg_kupang,
    'plts_ipp_kpng' => $data_pembangkit_plts_ipp_kpng,
    'plts_ipp_atmb' => $data_pembangkit_plts_ipp_atmb,
    'ulpl_kpng_ngt' => $data_pembangkit_ulpl_kpng_ngt,
    'ulpl_kpng_mak' => $data_pembangkit_ulpl_kpng_mak,
    'ulpl_atmb_cat2' => $data_pembangkit_ulpl_atmb_cat2,
    'ulpl_atmb_mwm' => $data_pembangkit_ulpl_atmb_mwm,
    'ulpl_atmb_swd' => $data_pembangkit_ulpl_atmb_swd,
    'pltu_timor' => $data_pembangkit_pltu_timor
  );

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
