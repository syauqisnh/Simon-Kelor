<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include 'config/conn.php';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" href="assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="assets/css/login.css">
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
</head>

<body>

    <div class="main-login">
        <div class="content-login">
            <div class="box-img1">
                <div class="header-login">
                    <img src="assets/img/logo.png" alt="">
                    <h3>PT PLN UPK TIMOR</h3>
                </div>
                <img src="assets/img/login.svg" alt="">
            </div>

            <div class="box-form">
                <div class="header-box-form">
                    <b class="welcome">Welcome Back!!</b>
                    <b class="desc">Please enter your email and password</b>
                </div>
                <form method="POST" class="form" enctype="multipart/form-data">
                    <div class="group-form">
                        <label class="label-email-login" for="">Username</label>
                        <input class="input-email-login" type="email" name="email" placeholder="Username" required>
                    </div>
                    <div class="group-form">
                        <label class="label-email-login" for="">Password</label>
                        <input class="input-email-login" type="password" name="password" placeholder="************" required>
                    </div>
                    <div class="group-form-footer">
                        <input class="button-login" type="submit" name="login" value="Sign In">
                        <b>Don’t have an account? <span><a class="span" href="registrasi.php">Sign Up</a></span></b>
                    </div>
                </form>

                <?php
                if (isset($_POST["login"])) {

                    $email = $_POST["email"];
                    $pass = mysqli_real_escape_string($koneksi, md5($_POST['password']));

                    $sql_aktif = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
                    $sql_nonaktif = mysqli_query($koneksi, "SELECT * FROM user_registrasis WHERE email='$email'");
                    $cek_akun_aktif = mysqli_num_rows($sql_aktif);
                    $cek_akun_nonaktif = mysqli_num_rows($sql_nonaktif);
                    $data_akun = mysqli_fetch_assoc($sql_aktif);
                    $password = $data_akun['password'];

                    if ($cek_akun_nonaktif > 0 or $cek_akun_aktif > 0) {
                        if ($cek_akun_aktif > 0) {
                            if ($pass == $password) {
                                $_SESSION['email'] = $email;
                                $_SESSION['nama'] = $data_akun['nama_user'];
                                $_SESSION['role'] = $data_akun['role'];
                                $_SESSION['user_id'] = $data_akun['user_id'];
                                $_SESSION['foto_profil'] = $data_akun['gambar'];

                                echo '<script>window.location.href = "index.php";</script>';
                            } else {
                                echo "<script>
                    alert('password Anda salah');
                </script>";
                            }
                        } else {
                            echo '<script>alert("Akun Anda belum diaktifkan")</script>';
                            echo '<script>window.location.href = "Login.php";</script>';
                        }
                    } else {
                        echo '<script>alert("Akun Anda tidak terdaftar, lakukan registrasi dahulu")</script>';
                        echo '<script>window.location.href = "Registrasi.php";</script>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>