<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_simonkelor_native";

$koneksi = mysqli_connect($servername, $username, $password, $dbname);

if (!$koneksi) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
    if (isset($_POST['tanggal'])) {
        $date_select = strtotime($_POST['tanggal']);
        $date_select = date('Y-m-d', $date_select);
    }else {
        $date_select = "";
    }
    echo $date_select

?>
