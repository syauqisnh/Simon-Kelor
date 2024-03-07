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

$sql = "SELECT 	pltu_blk1, 	pltu_blk2 FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result = mysqli_query($conn, $sql);
$sql1 = "SELECT pltu_ipp_kpng1, pltu_ipp_kpng2 FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT pltd_cogindo FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result2 = mysqli_query($conn, $sql2);
$sql3 = "SELECT pltmg_kpng FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result3 = mysqli_query($conn, $sql3);
$sql4 = "SELECT plts_ipp_kpng FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result4 = mysqli_query($conn, $sql4);
$sql5 = "SELECT plts_ipp_atmb FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result5 = mysqli_query($conn, $sql5);
$sql6 = "SELECT ulpl_kpng_ngt FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result6 = mysqli_query($conn, $sql6);
$sql7 = "SELECT ulpl_kpng_mak FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result7 = mysqli_query($conn, $sql7);
$sql8 = "SELECT ulpl_atmb_cat2 FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result8 = mysqli_query($conn, $sql8);
$sql9 = "SELECT ulpl_atmb_mwm FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result9 = mysqli_query($conn, $sql9);
$sql10 = "SELECT ulpl_atmb_swd FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result10 = mysqli_query($conn, $sql10);
$sql11 = "SELECT 	pltu_timor1, 	pltu_timor2 FROM beban_kit WHERE DATE(tanggal) = '$date'";
$result11 = mysqli_query($conn, $sql11);

$pltu_bolok = array();
while ($row = mysqli_fetch_assoc($result)) {
  $pltu_bolok[] = round($row['pltu_blk1'] + $row['pltu_blk2'], 2);
}
$pltu_ipp_kupang = array();
while ($row = mysqli_fetch_assoc($result1)) {
  $pltu_ipp_kupang[] = round($row['pltu_ipp_kpng1'] + $row['pltu_ipp_kpng2'], 2);
}
$data_pembangkit_pltd_cogindo = 0;
while ($row = mysqli_fetch_assoc($result2)) {
  $data_pembangkit_pltd_cogindo += round($row['pltd_cogindo'], 2);
}
$data_pembangkit_pltmg_kupang = 0;
while ($row = mysqli_fetch_assoc($result3)) {
  $data_pembangkit_pltmg_kupang += round($row['pltmg_kpng'], 2);
}
$data_pembangkit_plts_ipp_kpng = 0;
while ($row = mysqli_fetch_assoc($result4)) {
  $data_pembangkit_plts_ipp_kpng += round($row['plts_ipp_kpng'], 2);
}
$data_pembangkit_plts_ipp_atmb = 0;
while ($row = mysqli_fetch_assoc($result5)) {
  $data_pembangkit_plts_ipp_atmb += round($row['plts_ipp_atmb'], 2);
}
$data_pembangkit_ulpl_kpng_ngt = 0;
while ($row = mysqli_fetch_assoc($result6)) {
  $data_pembangkit_ulpl_kpng_ngt += round($row['ulpl_kpng_ngt'], 2);
}
$data_pembangkit_ulpl_kpng_mak = 0;
while ($row = mysqli_fetch_assoc($result7)) {
  $data_pembangkit_ulpl_kpng_mak += round($row['ulpl_kpng_mak'], 2);
}
$data_pembangkit_ulpl_atmb_cat2 = 0;
while ($row = mysqli_fetch_assoc($result8)) {
  $data_pembangkit_ulpl_atmb_cat2 += round($row['ulpl_atmb_cat2'], 2);
}
$data_pembangkit_ulpl_atmb_mwm = 0;
while ($row = mysqli_fetch_assoc($result9)) {
  $data_pembangkit_ulpl_atmb_mwm += round($row['ulpl_atmb_mwm'], 2);
}
$data_pembangkit_ulpl_atmb_swd = 0;
while ($row = mysqli_fetch_assoc($result10)) {
  $data_pembangkit_ulpl_atmb_swd += round($row['ulpl_atmb_swd'], 2);
}
$pltu_timor = array();
while ($row = mysqli_fetch_assoc($result11)) {
  $pltu_timor[] = round($row['pltu_timor1'] + $row['pltu_timor2'], 2);
}

$dmn_pltu_bolok = 30.00;
$dmn_pltu_ipp_kpg_baru = 30.00;
$dmn_pltd_cogindo = 40.00;
$dmn_pltmg_kpg = 47.45;
$dmn_plts_ipp_kpg = 5.00;
$dmn_plts_ipp_atm = 1.00;
$dmn_ulpl_kpg_ngt = 3.00;
$dmn_ulpl_kpg_mak = 3.00;
$dmn_ulpl_atmb_cat2 = 3.50;
$dmn_ulpl_atmb_mwm = 0.52;
$dmn_ulpl_atmb_swd = 0.55;
$dmn_pltu_timor = 100.00;

$total_a = 0;
$total_b = 0;
for ($x = 0; $x < count($pltu_bolok); $x++) {
    $total_a += $pltu_bolok[$x];
}
for ($y = 0; $y < count($pltu_ipp_kupang); $y++) {
    $total_b += $pltu_ipp_kupang[$y];
}
$a = $total_a / 2;
$b = $total_b / 2;
$c = $data_pembangkit_pltd_cogindo / 2;
$d = $data_pembangkit_pltmg_kupang / 2;
$e = $data_pembangkit_plts_ipp_kpng / 2;
$f = $data_pembangkit_plts_ipp_atmb / 2;
$g = $data_pembangkit_ulpl_kpng_ngt / 2;
$h = $data_pembangkit_ulpl_kpng_mak / 2;
$i = $data_pembangkit_ulpl_atmb_cat2 / 2;
$j = $data_pembangkit_ulpl_atmb_mwm / 2;
$k = $data_pembangkit_ulpl_atmb_swd / 2;
$l = 0;

for ($z = 0; $z < count($pltu_timor); $z++) {
    $l += $pltu_timor[$z];
}

$total_energi_pembangkit = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j + $k + $l;

$cf_pltu_bolok =  ($a / ($dmn_pltu_bolok * 24)) * 100;
$cf_pltu_ipp_kpg_baru =  ($b /($dmn_pltu_ipp_kpg_baru * 24)) * 100;
$cf_pltd_cogindo = ($c /($dmn_pltd_cogindo * 24)) * 100;
$cf_pltmg_kpg = ($d /($dmn_pltmg_kpg * 24)) * 100;
$cf_plts_ipp_kpg = ($e /($dmn_plts_ipp_kpg * 24)) * 100;
$cf_plts_ipp_atm = ($f /($dmn_plts_ipp_atm * 24)) * 100;
$cf_ulpl_kpg_ngt = ($g /($dmn_ulpl_kpg_ngt * 24)) * 100;
$cf_ulpl_kpg_mak = ($h /($dmn_ulpl_kpg_mak * 24)) * 100;
$cf_ulpl_atmb_cat2 = ($i /($dmn_ulpl_atmb_cat2 * 24)) * 100;
$cf_ulpl_atmb_mwm = ($j /($dmn_ulpl_atmb_mwm * 24)) * 100;
$cf_ulpl_atmb_swd = ($k /($dmn_ulpl_atmb_swd * 24)) * 100;
$cf_pltu_timor =  ($l /($dmn_pltu_timor * 24)) * 100;

$persentase_pltu_bolok =  ($a / $total_energi_pembangkit) * 100;
$persentase_pltu_ipp_kpg_baru =  ($b / $total_energi_pembangkit) * 100;
$persentase_pltd_cogindo = ($c / $total_energi_pembangkit) * 100;
$persentase_pltmg_kpg = ($d / $total_energi_pembangkit) * 100;
$persentase_plts_ipp_kpg = ($e / $total_energi_pembangkit) * 100;
$persentase_plts_ipp_atm = ($f / $total_energi_pembangkit) * 100;
$persentase_ulpl_kpg_ngt = ($g / $total_energi_pembangkit) * 100;
$persentase_ulpl_kpg_mak = ($h / $total_energi_pembangkit) * 100;
$persentase_ulpl_atmb_cat2 = ($i / $total_energi_pembangkit) * 100;
$persentase_ulpl_atmb_mwm = ($j / $total_energi_pembangkit) * 100;
$persentase_ulpl_atmb_swd = ($k / $total_energi_pembangkit) * 100;
$persentase_pltu_timor =  ($l / $total_energi_pembangkit) * 100;


// Query untuk mengambil data total_beban dari tabel beban_kit
// Membuat variabel untuk menampung output
$output1 = '';
$output2 = '';
$output3 = '';
$output4 = '';
$output5 = '';
$output6 = '';
$output7 = '';
$output8 = '';
$output9 = '';
$output10 = '';
$output11 = '';
$output12 = '';

$output1 .= '<td>PLTU BOLOK (PLANT)</td>';
$output1 .= '<td>'.round($dmn_pltu_bolok, 2).'</td>';
$output1 .= '<td>'.round($a, 2).'</td>';
$output1 .= '<td>'.round($cf_pltu_bolok, 2).'</td>';
$output1 .= '<td>Batubara</td>';
$output1 .= '<td>'.round($persentase_pltu_bolok, 2).'</td>';

$output2 .= '<td>PLTU IPP KUPANG BARU (PLANT)</td>';
$output2 .= '<td>'.round($dmn_pltu_ipp_kpg_baru, 2).'</td>';
$output2 .= '<td>'.round($b, 2).'</td>';
$output2 .= '<td>'.round($cf_pltu_ipp_kpg_baru, 2).'</td>';
$output2 .= '<td>Batubara</td>';
$output2 .= '<td>'.round($persentase_pltu_ipp_kpg_baru, 2).'</td>';

$output3 .= '<td>PLTD COGINDO (PLANT)</td>';
$output3 .= '<td>'.round($dmn_pltd_cogindo, 2).'</td>';
$output3 .= '<td>'.round($c, 2).'</td>';
$output3 .= '<td>'.round($cf_pltd_cogindo, 2).'</td>';
$output3 .= '<td>MFO</td>';
$output3 .= '<td>'.round($persentase_pltd_cogindo, 2).'</td>';

$output4 .= '<td>PLTMG KUPANG PEAKER (PLANT)</td>';
$output4 .= '<td>'.round($dmn_pltmg_kpg, 2).'</td>';
$output4 .= '<td>'.round($d, 2).'</td>';
$output4 .= '<td>'.round($cf_pltmg_kpg, 2).'</td>';
$output4 .= '<td>B30</td>';
$output4 .= '<td>'.round($persentase_pltmg_kpg, 2).'</td>';

$output5 .= '<td>PLTS IPP KUPANG</td>';
$output5 .= '<td>'.round($dmn_plts_ipp_kpg, 2).'</td>';
$output5 .= '<td>'.round($e, 2).'</td>';
$output5 .= '<td>'.round($cf_plts_ipp_kpg, 2).'</td>';
$output5 .= '<td>Surya</td>';
$output5 .= '<td>'.round($persentase_plts_ipp_kpg, 2).'</td>';

$output6 .= '<td>PLTS IPP ATAMBUA</td>';
$output6 .= '<td>'.round($dmn_plts_ipp_atm, 2).'</td>';
$output6 .= '<td>'.round($f, 2).'</td>';
$output6 .= '<td>'.round($cf_plts_ipp_atm, 2).'</td>';
$output6 .= '<td>Surya</td>';
$output6 .= '<td>'.round($persentase_plts_ipp_atm, 2).'</td>';

$output7 .= '<td>ULPL KUPANG NIGATA (PLANT)</td>';
$output7 .= '<td>'.round($dmn_ulpl_kpg_ngt, 2).'</td>';
$output7 .= '<td>'.round($g, 2).'</td>';
$output7 .= '<td>'.round($cf_ulpl_kpg_ngt, 2).'</td>';
$output7 .= '<td>B30</td>';
$output7 .= '<td>'.round($persentase_ulpl_kpg_ngt, 2).'</td>';

$output8 .= '<td>ULPL KUPANG MAK (PLANT)</td>';
$output8 .= '<td>'.round($dmn_ulpl_kpg_mak, 2).'</td>';
$output8 .= '<td>'.round($h, 2).'</td>';
$output8 .= '<td>'.round($cf_ulpl_kpg_mak, 2).'</td>';
$output8 .= '<td>B30</td>';
$output8 .= '<td>'.round($persentase_ulpl_kpg_mak, 2).'</td>';

$output9 .= '<td>ULPL ATAMBUA CAT 2</td>';
$output9 .= '<td>'.round($dmn_ulpl_atmb_cat2, 2).'</td>';
$output9 .= '<td>'.round($i, 2).'</td>';
$output9 .= '<td>'.round($cf_ulpl_atmb_cat2, 2).'</td>';
$output9 .= '<td>B30</td>';
$output9 .= '<td>'.round($persentase_ulpl_atmb_cat2, 2).'</td>';

$output10 .= '<td>ULPL ATAMBUA MWM</td>';
$output10 .= '<td>'.round($dmn_ulpl_atmb_mwm, 2).'</td>';
$output10 .= '<td>'.round($j, 2).'</td>';
$output10 .= '<td>'.round($cf_ulpl_atmb_mwm, 2).'</td>';
$output10 .= '<td>B30</td>';
$output10 .= '<td>'.round($persentase_ulpl_atmb_mwm, 2).'</td>';

$output11 .= '<td>ULPL ATAMBUA SWD (PLANT)</td>';
$output11 .= '<td>'.round($dmn_ulpl_atmb_swd, 2).'</td>';
$output11 .= '<td>'.round($k, 2).'</td>';
$output11 .= '<td>'.round($cf_ulpl_atmb_swd, 2).'</td>';
$output11 .= '<td>B30</td>';
$output11 .= '<td>'.round($persentase_ulpl_atmb_swd, 2).'</td>';

$output12 .= '<td>PLTU TIMOR-1 (PLANT)</td>';
$output12 .= '<td>'.round($dmn_pltu_timor, 2).'</td>';
$output12 .= '<td>'.round($l, 2).'</td>';
$output12 .= '<td>'.round($cf_pltu_timor, 2).'</td>';
$output12 .= '<td>Batubara</td>';
$output12 .= '<td>'.round($persentase_pltu_timor, 2).'</td>';

// Menampilkan output
echo '<tr>'.$output1.'</tr>';
echo '<tr>'.$output2.'</tr>';
echo '<tr>'.$output3.'</tr>';
echo '<tr>'.$output4.'</tr>';
echo '<tr>'.$output5.'</tr>';
echo '<tr>'.$output6.'</tr>';
echo '<tr>'.$output7.'</tr>';
echo '<tr>'.$output8.'</tr>';
echo '<tr>'.$output9.'</tr>';
echo '<tr>'.$output10.'</tr>';
echo '<tr>'.$output11.'</tr>';
echo '<tr>'.$output12.'</tr>';

mysqli_close($conn);
