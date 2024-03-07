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

// Query untuk mengambil data total_beban dari tabel beban_kit
$sql = "SELECT 	pltu_blk1, 	pltu_blk2, pltu_ipp_kpng1, pltu_ipp_kpng2, pltu_timor1, pltu_timor2 FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result = mysqli_query($conn, $sql);
$sql2 = "SELECT pltmg_kpng, ulpl_kpng_ngt, ulpl_kpng_mak, ulpl_atmb_cat2, ulpl_atmb_mwm, ulpl_atmb_swd FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result2 = mysqli_query($conn, $sql2);
$sql3 = "SELECT plts_ipp_atmb, plts_ipp_kpng FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result3 = mysqli_query($conn, $sql3);
$sql4 = "SELECT pltd_cogindo FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result4 = mysqli_query($conn, $sql4);
 
$pltu = array();
while ($row = mysqli_fetch_assoc($result)) {
    $pltu[] = round($row['pltu_blk1'] + $row['pltu_blk2'] + $row['pltu_ipp_kpng1'] + $row['pltu_ipp_kpng2'] + $row['pltu_timor1'] + $row['pltu_timor2'], 2);
}
$ulpl_pltmg = array();
while ($row = mysqli_fetch_assoc($result2)) {
    $ulpl_pltmg[] = round($row['pltmg_kpng'] + $row['ulpl_kpng_ngt'] + $row['ulpl_kpng_mak'] + $row['ulpl_atmb_cat2'] + $row['ulpl_atmb_mwm'] + $row['ulpl_atmb_swd'], 2);
}
$plts = array();
while ($row = mysqli_fetch_assoc($result3)) {
    $plts[] = round($row['plts_ipp_atmb'] + $row['plts_ipp_kpng'], 2);
}
$pltd = array();
while ($row = mysqli_fetch_assoc($result4)) {
  $pltd[] = round($row['pltd_cogindo'], 2);
}


mysqli_close($conn);

$data = array(
        'batubara' => $pltu,
        'mfo' => $pltd,
        'b30' => $ulpl_pltmg,
        'surya' => $plts
  );

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);

