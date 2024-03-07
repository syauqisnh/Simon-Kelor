<?php
if (isset($_POST['tanggal'])) {
    $tanggalHari = $_POST['tanggal'];
    $valuecurrentDate = strtotime($tanggalHari);
    $date = date("d F Y", $valuecurrentDate);
}else{
    $tanggalHariIni = date("Y-m-d");
    $valuecurrentDate = strtotime($tanggalHariIni);
    $date = date("d F Y", $valuecurrentDate);
}
echo ' - '.$date;
?>