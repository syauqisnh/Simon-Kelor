<?php
// Koneksi ke database
$servername = "localhost";
$username  = "root";
$password = "";
$dbname = "db_simonkelor_native";

$koneksi = mysqli_connect($servername, $username, $password, $dbname);

if (!$koneksi) {
    die("Connection Failed". mysqli_connect_error());
}


$output1 = '';

$id = $_GET['id']; 
$user = $_GET['nama_user'];

$query = mysqli_query($koneksi, "SELECT komentars.*, nama_user, id_user, role FROM komentars
            JOIN users ON komentars.id_user = users.user_id
            WHERE komentars.id_forum = '" . $id. "'
            ORDER BY komentars.created_at DESC
            ");

$cek_komentar = mysqli_num_rows($query);
$allowTypesfoto = array('jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG');
$allowTypesdok = array('doc', 'docx', 'xlx', 'xlsx', 'csv', 'ppt', 'pptx', 'pdf', 'DOC', 'DOCX', 'XLX', 'XLSX', 'CSV', 'PPT', 'PPTX', 'PDF');
if ($cek_komentar > 0) {

    $output1 .= '<div class="page-message">';


    while ($data = mysqli_fetch_assoc($query)) {
        if ($data['nama_user'] == $user) {
            $class_box = "komentar-me";
        } else {
            $class_box = "komentar";
        }


        $output1 .= '<div class=' . $class_box . '>';

        if ($data['nama_user'] == $user) {

            $output1 .= '<div class="box-me">';
            $output1 .= '<div class="box-delete">';
            $output1 .= "<a onclick=\"return confirm('Apakah Anda yakin ingin menghapus pesan ini?')\" href=\"index.php?p=delete_komentar&id=" . $data['id_komentar'] . "\"><i class='bx bx-trash'></i></a>";
            $output1 .= '</div>';

            $output1 .= '<div class="box-massage">';
            $output1 .= '<div class="content-komentar">';

            if (in_array($data['type'], $allowTypesdok)) {

                $output1 .= '<div class="box-file">';
                $output1 .= '<div class="nama-file">';
                $output1 .= '<div class="box-logo-file">';
                $output1 .= '<img src="assets/img/icon_dokumen.png" alt="">';
                $output1 .= '</div>';
                $output1 .= '<span class="me">' . $data['file'] . '</span>';
                $output1 .= '</div>';
                $output1 .= '<div class="box-download-me">';
                $output1 .= "<a href=\"index.php?p=dowload_file_komentar&id=" . $data['id_komentar'] . "\"><i class='bx bxs-download'></i></a>";
                $output1 .= '</div>';
                $output1 .= '</div>';
            } elseif (in_array($data['type'], $allowTypesfoto)) {

                $output1 .= '<div class="box-foto">';
                $output1 .= '<img src="assets/img/foto_komentar/' . $data['file'] . '" alt="">';
                $output1 .= '</div>';
            }

            $output1 .= '<p class="me">';
            $output1 .= $data['komentar'];
            $output1 .= '</p>';
            $output1 .= '</div>';
            $output1 .= '<div class="footer-komentar-me">';
            $output1 .= '<span>' . $data['created_at'] . '</span>';
            $output1 .= '</div>';
            $output1 .= '</div>';
            $output1 .= '</div>';
        } else {

            $output1 .= '<div class="header-komentar">';
            $output1 .= '<span class="user-name random-color">' . $data['nama_user'] . '</span>';
            $output1 .= '<span class="user-role">' . $data['role'] . '</span>';
            $output1 .= '</div>';
            $output1 .= '<div class="content-komentar">';


            if (in_array($data['type'], $allowTypesdok)) {

                $output1 .= '<div class="box-file">';
                $output1 .= '<div class="nama-file">';
                $output1 .= '<div class="box-logo-file">';
                $output1 .= '<img src="assets/img/icon_dokumen.png" alt="">';
                $output1 .= '</div>';
                $output1 .= '<span class="me">' . $data['file'] . '</span>';
                $output1 .= '</div>';
                $output1 .= '<div class="box-download-me">';
                $output1 .= "<a href=\"index.php?p=dowload_file_komentar&id=" . $data['id_komentar'] . "\"><i class='bx bxs-download'></i></a>";
                $output1 .= '</div>';
                $output1 .= '</div>';
            } elseif (in_array($data['type'], $allowTypesfoto)) {

                $output1 .= '<div class="box-foto">';
                $output1 .= '<img src="assets/img/foto_komentar/' . $data['file'] . '" alt="">';
                $output1 .= '</div>';
            }

            $output1 .= '<p>';
            $output1 .= $data['komentar'];
            $output1 .= '</p>';
            $output1 .= '</div>';
            $output1 .= '<div class="footer-komentar">';
            $output1 .= '<span>' . $data['created_at'] . '</span>';
            $output1 .= '</div>';
        }
        $output1 .= '</div>';
    }
    $output1 .= '</div>';
} else {
    $output1 .= '<div class="page-message">';
    $output1 .= '<div class="no-komentar">';
    $output1 .= '<div class="content-komentar">';
    $output1 .= '<p>';
    $output1 .= 'Belum Ada Komentar';
    $output1 .= '</p>';
    $output1 .= '</div>';
    $output1 .= '</div>';
    $output1 .= '</div>';
}


echo $output1;

mysqli_close($koneksi);
