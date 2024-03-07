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
parameter = 'Beban Pembangkit' OR 
parameter = 'Frequency' OR
parameter = 'Losses' OR 
parameter ='Fuelmix'
";
$sql2 = "SELECT * FROM monitoring_realtimes WHERE 
parameter LIKE '%PLTU BOLOK%' OR
parameter LIKE '%PLTU IPP%'
";
$sql3 = "SELECT * FROM monitoring_realtimes WHERE 
parameter LIKE '%PLTS%' 
";
$sql4 = "SELECT * FROM monitoring_realtimes WHERE 
parameter LIKE '%PLANT%' 
";

$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);
$result4 = mysqli_query($conn, $sql4);

// Membuat variabel untuk menampung output
$output1 = '';
$output2 = '';
$output3 = '';
$output4 = '';

while ($row = mysqli_fetch_assoc($result)) {
  if ($row['value'] == 0) {
    $output1 .= '<div class="card-left card-off">';
    $output1 .= '<span class="card-name">' . $row['parameter'] . '</span>';
    $output1 .= '<span class="card-value">' . $row['value'] . '</span>';
    $output1 .= '</div>';
  }else{
    $output1 .= '<div class="card-left card-hijau">';
    $output1 .= '<span class="card-name">' . $row['parameter'] . '</span>';
    $output1 .= '<span class="card-value">' . $row['value'] . '</span>';
    $output1 .= '</div>';
  }
}
while ($row = mysqli_fetch_assoc($result2)) {
  if ($row['value'] == 0) {
    $output2 .= '<div class="card-left card-off">';
    $output2 .= '<span class="card-name">' . $row['parameter'] . '</span>';
    $output2 .= '<span class="card-value">' . $row['value'] . '</span>';
    $output2 .= '</div>';
  }else{
    $output2 .= '<div class="card-left card-biru">';
    $output2 .= '<span class="card-name">' . $row['parameter'] . '</span>';
    $output2 .= '<span class="card-value">' . $row['value'] . '</span>';
    $output2 .= '</div>';
  }
}
while ($row = mysqli_fetch_assoc($result3)) {
  if ($row['value'] == 0) {
    $output3 .= '<div class="card-left card-off">';
    $output3 .= '<span class="card-name">' . $row['parameter'] . '</span>';
    $output3 .= '<span class="card-value">' . $row['value'] . '</span>';
    $output3 .= '</div>';
  }else{
    $output3 .= '<div class="card-left card-orange">';
    $output3 .= '<span class="card-name">' . $row['parameter'] . '</span>';
    $output3 .= '<span class="card-value">' . $row['value'] . '</span>';
    $output3 .= '</div>';
  }
}
while ($row = mysqli_fetch_assoc($result4)) {
  if ($row['value'] == 0) {
    $output4 .= '<div class="card-left card-off">';
    $output4 .= '<span class="card-name">' . $row['parameter'] . '</span>';
    $output4 .= '<span class="card-value">' . $row['value'] . '</span>';
    $output4 .= '</div>';
  }else{
    $output4 .= '<div class="card-left card-kuning">';
    $output4 .= '<span class="card-name">' . $row['parameter'] . '</span>';
    $output4 .= '<span class="card-value">' . $row['value'] . '</span>';
    $output4 .= '</div>';
  }
}

// Menampilkan output
echo '<div class="box-card">'.$output1.'</div>';
echo '<div class="box-card">'.$output2.'</div>';
echo '<div class="box-card">'.$output3.'</div>';
echo '<div class="box-card">'.$output4.'</div>';

mysqli_close($conn);
