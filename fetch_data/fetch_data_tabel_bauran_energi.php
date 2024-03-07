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

while ($row = mysqli_fetch_assoc($result2)) {
  if (strpos($row['parameter'], 'PLTU') !== false) {
    $output1 .= '<tr>';
    $output1 .= '<td>' . $row['parameter']. '</td>';
    $output1 .= '<td>Batubara</td>';
    $output1 .= '<td>' . $row['value']. '</td>';
    $output1 .= '<td>' . round($row['value'] / $total_seluruh_beban * 100, 2). '</td>';
    $output1 .= '</tr>';
  }elseif (strpos($row['parameter'], 'PLTD') !== false) {
    $output1 .= '<tr>';
    $output1 .= '<td>' . $row['parameter'] . '</td>';
    $output1 .= '<td>MFO</td>';
    $output1 .= '<td>' . $row['value']. '</td>';
    $output1 .= '<td>' . round($row['value'] / $total_seluruh_beban * 100, 2). '</td>';
    $output1 .= '</tr>';
  }elseif (strpos($row['parameter'], 'PLTS') !== false) {
    $output1 .= '<tr>';
    $output1 .= '<td>' . $row['parameter'] . '</td>';
    $output1 .= '<td>Surya</td>';
    $output1 .= '<td>' . $row['value']. '</td>';
    $output1 .= '<td>' . round($row['value'] / $total_seluruh_beban * 100, 2). '</td>';
    $output1 .= '</tr>';
  }else{
    $output1 .= '<tr>';
    $output1 .= '<td>' . $row['parameter'] . '</td>';
    $output1 .= '<td>B30</td>';
    $output1 .= '<td>' . $row['value']. '</td>';
    $output1 .= '<td>' . round($row['value'] / $total_seluruh_beban * 100, 2). '</td>';
    $output1 .= '</tr>';
  }
}


// Menampilkan output
echo $output1;

// echo '<div class="box-card">'.$output2.'</div>';
// echo '<div class="box-card">'.$output3.'</div>';

mysqli_close($conn);
