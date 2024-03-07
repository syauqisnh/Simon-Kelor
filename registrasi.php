<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Page</title>
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
                <img src="assets/img/register.svg" alt="">
            </div>

            <div class="box-form">
                <div class="header-box-form-regis">
                    <b class="welcome">Sign Up</b>
                    <b class="desc">Create your account</b>
                </div>
                <form method="POST" class="form" enctype="multipart/form-data">
                    <div class="group-form">
                        <label class="label-email-regis" for="">Full Name</label>
                        <input class="input-email-regis" type="text" name="nama" placeholder="Full Name" required>
                    </div>
                    <div class="group-form">
                        <label class="label-email-regis" for="">NIP</label>
                        <input class="input-email-regis" type="text" name="nip" placeholder="NIP" required>
                    </div>
                    <div class="group-form">
                        <label class="label-email-regis" for="">Instansi</label>
                        <input class="input-email-regis" type="text" name="instansi" placeholder="Instansi" required>
                    </div>
                    <div class="group-form">
                        <label class="label-email-regis" for="">User Role</label>
                        <select name="role" type="text" required>
                            <option>--- Pilih Role ---</option>
                            <option value="Admin Dispacher">Admin Dispatcher</option>
                            <option value="Admin Pembangkit">Admin Pembangkit</option>
                            <option value="Pegawai">Pegawai</option>
                        </select>
                    </div>
                    <div class="group-form">
                        <label class="label-email-regis" for="">Email</label>
                        <input class="input-email-regis" type="email" name="email" placeholder="Username" required>
                    </div>
                    <div class="group-form">
                        <label class="label-email-regis" for="">Foto Profil</label>
                        <input class="input-email-regis" type="file" name="photo" placeholder="Username">
                    </div>
                    <div class="group-form">
                        <label class="label-email-regis" for="">Password</label>
                        <input class="input-email-regis" type="password" name="password" placeholder="************" required>
                    </div>
                    <div class="group-form">
                        <label class="label-email-regis" for="">Confirmasi Password</label>
                        <input class="input-email-regis" type="password" name="confirmpassword" placeholder="************" required>
                    </div>
                    <div class="group-form-footer-regis">
                        <input class="button-login" type="submit" name="Submit" value="Sign Up">
                        <b>Already have an account? <span><a class="span" href="login.php">Sign In</a></span></b>
                    </div>
                </form>
                <?php

                include('config/conn.php');

                if (isset($_POST['Submit'])) {

                    $nama = $_POST['nama'];
                    $nip = $_POST['nip'];
                    $instansi = $_POST['instansi'];
                    $role = $_POST['role'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $passwordConfirm = $_POST['confirmpassword'];
                    $photo = $_FILES['photo']['name'];
                    $tmp = $_FILES['photo']['tmp_name'];
                    $path = "assets/img/foto_profil/" . $photo;

                    //query
                    if (empty($photo)) {
                        if ($password == $passwordConfirm) {
                            $query =  "INSERT INTO user_registrasis 
        VALUES(NULL, '$nama' , '$nip' , '$instansi' , '$role' , '$email' , '$password' , 'default_profil.png', '', NULL, NULL)";

                            $result = mysqli_query($koneksi, $query);

                            if (!$result) {
                                die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                                    " - " . mysqli_error($koneksi));
                            } else {
                                echo '<script>alert("Registrasi Berhasil")</script>';
                                echo '<script>window.location.href ="login.php";</script>';
                                exit();
                            }
                        } else {
                            echo '<script>alert("Registrasi gagal, Pastikan Anda memasukkan konfirmasi password yang sama")</script>';
                        }
                    } else {
                        if ($password == $passwordConfirm) {
                            if (move_uploaded_file($tmp, $path)) {
                                $query =  "INSERT INTO user_registrasis 
        VALUES(NULL, '$nama' , '$nip' , '$instansi' , '$role' , '$email' , '$password' , '$photo', '$path', NULL, NULL)";

                                $result = mysqli_query($koneksi, $query);

                                if (!$result) {
                                    die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                                        " - " . mysqli_error($koneksi));
                                } else {
                                    echo '<script>alert("Registrasi Berhasil")</script>';
                                    echo '<script>window.location.href = "login.php";</script>';
                                    exit();
                                }
                            }
                        } else {
                            echo '<script>alert("Registrasi gagal, Pastikan Anda memasukkan konfirmasi password yang sama")</script>';
                        }
                    }
                }

                mysqli_close($koneksi);
                ?>

            </div>
        </div>
    </div>

</body>

</html>