<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
include 'config/conn.php';
?>

<head>
  <meta charset="UTF-8">
  <title>SIMONKELOR</title>
  <link rel="icon" href="assets/img/logo.png" type="image/png">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/forum.css">
  <link rel="stylesheet" href="assets/css/realtime.css">
  <link rel="stylesheet" href="assets/css/documentation.css">
  <link rel="stylesheet" href="assets/css/user.css">
  <link rel="stylesheet" href="assets/css/forecasting.css">
  <link rel="stylesheet" href="assets/css/data_operasi.css">

  <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://d3js.org/d3.v6.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Boxiocns CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="sidebar" id="sidebar">
    <?php
    if (isset($_SESSION['role'])) {
      if ($_SESSION['role'] == 'Super Admin') {
        include_once 'sidebar_navlink/superadmin.php';
      } elseif ($_SESSION['role'] == 'Admin Dispacher') {
        include_once 'sidebar_navlink/dispacher.php';
      } elseif ($_SESSION['role'] == 'Admin Pembangkit') {
        include_once 'sidebar_navlink/pembangkit.php';
      } elseif ($_SESSION['role'] == 'Pegawai') {
        include_once 'sidebar_navlink/pegawai.php';
      }
    } else {
      include_once 'sidebar_navlink/guest.php';
    }
    ?>
  </div>

  <div class="nav_responsive">
    <a href="javascript:void(0);" class="icon" onclick="sidebar_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
  <div class="main">

    <?php
    if (@$_GET['p'] == "") {
      include 'realtime.php';
    } elseif (@$_GET['p'] == "realtime") {
      include_once 'realtime.php';
    }


    //user
    elseif (@$_GET['p'] == "user_aktif") {
      include_once 'admin/super_admin/data_user_aktif.php';
    } elseif (@$_GET['p'] == "add_user") {
      include_once 'admin/super_admin/form_add_user.php';
    } elseif (@$_GET['p'] == "update_user") {
      $query = mysqli_query($koneksi, "SELECT * FROM users WHERE user_id ='" . $_GET['id'] . "'");
      while ($data = mysqli_fetch_assoc($query)) {
        include_once 'admin/super_admin/form_update_user.php';
      }
    } elseif (@$_GET['p'] == "delete_user") {
      $query = mysqli_query($koneksi, "SELECT * FROM users WHERE user_id ='" . $_GET['id'] . "'");
      $data_user = mysqli_fetch_array($query);

      if ($data_user['gambar'] == "default_profil.png") {
        $query = mysqli_query($koneksi, "DELETE FROM users WHERE user_id ='" . $_GET['id'] . "'");
      } else {
        unlink($data_user['path']);
        $query = mysqli_query($koneksi, "DELETE FROM users WHERE user_id ='" . $_GET['id'] . "'");
      }

      if ($query) {
        echo "<script>alert('Data telah dihapus')</script>";
        echo "<script>location='index.php?p=user_aktif'</script>";
      } else {
        echo "<script>alert('erorr')</script>";
      }
    } elseif (@$_GET['p'] == "aktifkan_user_non_aktif") {
      $query = mysqli_query($koneksi, "SELECT * FROM user_registrasis WHERE id ='" . $_GET['id'] . "'");
      $data_user = mysqli_fetch_assoc($query);

      $nama = $data_user['nama_user'];
      $nip = $data_user['nip'];
      $instansi = $data_user['instansi'];
      $role = $data_user['role'];
      $email = $data_user['email'];
      $password = md5($data_user['password']);
      $photo = $data_user['gambar'];
      $path = $data_user['path'];

      $query_add =  "INSERT INTO users 
    VALUES(NULL, '$nama' , '$nip' , '$instansi' , '$role' , '$email' , '$password' , '$photo', '$path', NULL, NULL)";

      $query_delete = "DELETE FROM user_registrasis WHERE id ='" . $_GET['id'] . "'";

      $result = mysqli_query($koneksi, $query_add);

      if ($result) {

        $result_delete = mysqli_query($koneksi, $query_delete);

        if ($result_delete) {
          echo "<script>alert('Data berhasil diaktifkan')</script>";
          echo "<script>location='index.php?p=user_aktif'</script>";
        } else {
          echo "<script>alert('erorr')</script>";
        }
      }
    } elseif (@$_GET['p'] == "user_nonaktif") {
      include_once 'admin/super_admin/data_user_nonaktif.php';
    } elseif (@$_GET['p'] == "data_pembangkit") {
      include_once 'pembangkit.php';
    } elseif (@$_GET['p'] == "data_tegangan") {
      include_once 'tegangan.php';
      
    } elseif (@$_GET['p'] == "forcasting") {
      include_once 'admin/dispacher/forcasting.php';
    } elseif (@$_GET['p'] == "delete_result_forecast") {
      $query = mysqli_query($koneksi, "DELETE FROM load_forcasting WHERE DATE(tanggal) = '" . $_GET['date'] . "'");

      if ($query) {
        echo "<script>alert('Data telah dihapus')</script>";
        echo '<script>window.location.href = "index.php?p=forcasting";</script>';
      } else {
        echo "<script>alert('erorr')</script>";
      }
      
    } elseif (@$_GET['p'] == "delete_forecast") {
      $query = mysqli_query($koneksi, "DELETE FROM load_forcasting");

      if ($query) {
        echo "<script>alert('Data telah dihapus')</script>";
        echo '<script>window.location.href = "index.php?p=forcasting";</script>';
      } else {
        echo "<script>alert('erorr')</script>";
      }
      
    } elseif (@$_GET['p'] == "data_operasi") {
      include_once 'admin/data_operasi.php';
    }

    //profile
    elseif (@$_GET['p'] == "profile") {
      include_once 'admin/profile.php';
    } elseif (@$_GET['p'] == "update_foto_profile") {
      include_once 'admin/update_foto_profile.php';
    } elseif (@$_GET['p'] == "delete_foto_profil") {
      $query = mysqli_query($koneksi, "SELECT * FROM users WHERE user_id ='" . $_GET['id'] . "'");
      $data_lama = mysqli_fetch_array($query);
      $gambar = $data_lama['gambar'];
      $path = $data_lama['path'];

      if ($gambar == "default_profil.png") {
        echo "<script>alert('Anda belum mengunggah foto profil')</script>";
        echo '<script>window.location.href ="index.php?p=update_foto_profile";</script>';
      } else {

        $query = "UPDATE users SET 
      gambar = 'default_profil.png',
      path = ''
      WHERE user_id ='" . $data_lama['user_id'] . "'";

        $result = mysqli_query($koneksi, $query);

        if (!$result) {
          die("Query gagal dijalankan: " . mysqli_error($koneksi) .
            " - " . mysqli_error($koneksi));
        } else {
          unlink($data_lama['path']);

          echo "<script>alert('Foto profil berhasil dihapus')</script>";
          echo '<script>window.location.href ="index.php?p=profile";</script>';
          exit();
        }
      }
    } elseif (@$_GET['p'] == "update_data_profile") {
      include_once 'admin/update_data_profile.php';
    } elseif (@$_GET['p'] == "update_password_profile") {
      include_once 'admin/update_password_profile.php';
    }

    //dokumentation 
    elseif (@$_GET['p'] == "documentation") {
      include_once 'admin/documentation.php';
    } elseif (@$_GET['p'] == "form_add_documentation") {
      include_once 'admin/form_add_documnetation.php';
    } elseif (@$_GET['p'] == "form_update_documentation") {
      $query = mysqli_query($koneksi, "SELECT * FROM documentations WHERE id_dokumen ='" . $_GET['id'] . "'");
      while ($data = mysqli_fetch_assoc($query)) {
        include_once 'admin/form_update_documentation.php';
      }
    } elseif (@$_GET['p'] == "documentation_delete") {
      $query = mysqli_query($koneksi, "SELECT * FROM documentations WHERE id_dokumen ='" . $_GET['id'] . "'");
      $data_lama = mysqli_fetch_array($query);
      $path = $data_lama['path'];
      $page = $data_lama['jenis_dokumen'];

      $query = mysqli_query($koneksi, "DELETE FROM documentations WHERE id_dokumen ='" . $_GET['id'] . "'");

      if ($query) {
        unlink($path);
        echo "<script>alert('Data telah dihapus')</script>";
        echo '<script>window.location.href ="index.php?p=' . $page . '";</script>';
      } else {
        echo "<script>alert('erorr')</script>";
      }
    } elseif (@$_GET['p'] == "perencanaan") {
      include_once 'admin/documentation/perencanaan.php';
    } elseif (@$_GET['p'] == "evaluasi") {
      include_once 'admin/documentation/evaluasi.php';
    } elseif (@$_GET['p'] == "profil_kelistrikan") {
      include_once 'admin/documentation/profil_kelistrikan.php';
    } elseif (@$_GET['p'] == "sop_pengoperasian") {
      include_once 'admin/documentation/pengoperasian.php';
    } elseif (@$_GET['p'] == "singel_line_diagram") {
      include_once 'admin/documentation/singel_line_diagram.php';
    }

    // forum
    elseif (@$_GET['p'] == "forum") {
      include_once 'admin/forum.php';
    } elseif (@$_GET['p'] == "forum_add") {
      include_once 'admin/super_admin/form_add_forum.php';
    } elseif (@$_GET['p'] == "forum_update") {
      $query = mysqli_query($koneksi, "SELECT * FROM forums WHERE id_pesan ='" . $_GET['id'] . "'");
      while ($data = mysqli_fetch_assoc($query)) {
        include_once 'admin/super_admin/form_update_forum.php';
      }
    } elseif (@$_GET['p'] == "forum_delete") {
      if ($_SESSION['role'] == "Super Admin") {
        $query = mysqli_query($koneksi, "SELECT * FROM forums WHERE id_pesan ='" . $_GET['id'] . "'");
        $foto_lama = mysqli_fetch_array($query);
        $query_komentar = mysqli_query($koneksi, "SELECT * FROM komentars WHERE id_forum = '" . $_GET['id'] . "'");
        $cek_data = mysqli_num_rows($query_komentar);

        if ($cek_data > 0) {
          while ($data = mysqli_fetch_assoc($query_komentar)) {

            if ($data['path'] == NULL) {
            } else {
              unlink($data['path']);
            }

          }

          $query_hapus_komentar = mysqli_query($koneksi, "DELETE FROM komentars WHERE id_forum = '" . $_GET['id'] . "'");

          if ($query_hapus_komentar) {

            if ($foto_lama['gambar'] == "default.png") {
              $query_hapus = mysqli_query($koneksi, "DELETE FROM forums WHERE id_pesan ='" . $_GET['id'] . "'");
            } else {
              unlink('assets/img/img_forum/' . $foto_lama['gambar']);
              $query_hapus = mysqli_query($koneksi, "DELETE FROM forums WHERE id_pesan ='" . $_GET['id'] . "'");
            }
  
            if ($query_hapus) {
              echo "<script>alert('Data telah dihapus')</script>";
              echo "<script>location='index.php?p=forum'</script>";
            } else {
              echo "<script>alert('erorr')</script>";
            }
          }
        } else {

          if ($foto_lama['gambar'] == "default.png") {
            $query_hapus = mysqli_query($koneksi, "DELETE FROM forums WHERE id_pesan ='" . $_GET['id'] . "'");
          } else {
            unlink('assets/img/img_forum/' . $foto_lama['gambar']);
            $query_hapus = mysqli_query($koneksi, "DELETE FROM forums WHERE id_pesan ='" . $_GET['id'] . "'");
          }

          if ($query_hapus) {
            echo "<script>alert('Data telah dihapus')</script>";
            echo "<script>location='index.php?p=forum'</script>";
          } else {
            echo "<script>alert('erorr')</script>";
          }
        }
      } else {
        echo "<script>alert('Mohon maaf hanya Super Admin yang berhak menghapus data ini')</script>";
        echo "<script>location='index.php?p=forum'</script>";
      }
    } elseif (@$_GET['p'] == "forum_komentar") {
      include_once 'admin/forum_komentar.php';
    } elseif (@$_GET['p'] == "delete_komentar") {
      $sql = mysqli_query($koneksi, "SELECT * FROM komentars WHERE id_komentar ='" . $_GET['id'] . "'");
      $data_komentar = mysqli_fetch_array($sql);
      $id_forum = $data_komentar['id_forum'];
      $file = $data_komentar['file'];
      $path = $data_komentar['path'];

      if ($file == NULL) {

        $query = mysqli_query($koneksi, "DELETE FROM komentars WHERE id_komentar='" . $_GET['id'] . "'");

        if ($query) {
          echo "<script>alert('Pesan telah dihapus')</script>";
          echo '<script>window.location.href = "index.php?p=forum_komentar&id=' . $id_forum . '";</script>';
        } else {
          echo "<script>alert('erorr')</script>";
        }
      } else {
        unlink($path);
        $query = mysqli_query($koneksi, "DELETE FROM komentars WHERE id_komentar='" . $_GET['id'] . "'");

        if ($query) {
          echo "<script>alert('Pesan telah dihapus')</script>";
          echo '<script>window.location.href = "index.php?p=forum_komentar&id=' . $id_forum . '";</script>';
        } else {
          echo "<script>alert('erorr')</script>";
        }
      }
    }

    //download file
    elseif (@$_GET['p'] == "dowload_file_komentar") {
      $data = mysqli_query($koneksi, "SELECT * FROM komentars WHERE
            id_komentar =" . $_REQUEST['id']);

      if ($row = mysqli_fetch_assoc($data)) {
        $file = $row['path'];
      }

      // Mengecek apakah file ada
      if (file_exists($file)) {
        // Mengatur header untuk tipe konten file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

        // Membaca file dan menuliskannya ke output buffer
        ob_clean();
        flush();
        readfile($file);
        exit;
      } else {
        // File tidak ditemukan
        echo "<script>alert('File tidak ditemukan.')</script>";
      }
    } elseif (@$_GET['p'] == "dowload_file_documentation") {
      $data = mysqli_query($koneksi, "SELECT * FROM documentations WHERE
            id_dokumen =" . $_REQUEST['id']);

      if ($row = mysqli_fetch_assoc($data)) {
        $file = $row['path'];
      }

      // Mengecek apakah file ada
      if (file_exists($file)) {
        // Mengatur header untuk tipe konten file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

        // Membaca file dan menuliskannya ke output buffer
        ob_clean();
        flush();
        readfile($file);
        exit;
      } else {
        // File tidak ditemukan
        echo "<script>alert('File tidak ditemukan.')</script>";
      }
    }
    ?>
  </div>

</body>

</html>
<!-- <script src="assets/js/chart-pie.js"></script> -->
<script src="assets/js/index.js"></script>