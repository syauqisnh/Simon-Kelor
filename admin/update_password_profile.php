<?php
if (isset($_SESSION['nama'])) {
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE user_id =" . $_SESSION['user_id']);
    while ($data = mysqli_fetch_assoc($query)) {
?>
        <div class="box-page-profile">

            <div class="header-box-profile">
                <div class="judul-header">
                    <span class="name">
                        <a class="a" href="index.php?p=profile">
                            My Pofile
                        </a></span>
                </div>
            </div>

            <div class="content-box-profile">

                <div class="content-left-profile">

                    <div class="box-foto-profil">
                        <div class="underline">
                            <div class="name-page-update">
                                <span>Ubah Password</span>
                            </div>
                        </div>
                    </div>

                    <div class="box-info-profil">
                        <div class="cover-edit-pass">
                            <div class="card-update-pass">
                                <form class="form" method="POST" enctype="multipart/form-data">
                                    <div class="group-form">
                                        <label for="">Password</label>
                                        <input type="password" name="passwordlama" placeholder="********" required>
                                    </div>
                                    <div class="group-form">
                                        <label for="">Password Baru</label>
                                        <input type="password" name="passwordbaru" placeholder="********" required>
                                    </div>
                                    <div class="group-form">
                                        <label for="">Konfirmasi Password Baru</label>
                                        <input type="password" name="confirmpasswordbaru" placeholder="********" required>
                                    </div>
                                    <input name="Submit" type="submit" value="Ubah Password">
                                </form>

                                <?php
                                if (isset($_POST["Submit"])) {

                                    $pass = mysqli_real_escape_string($koneksi, md5($_POST['passwordlama']));
                                    $password = $data['password'];
                                    $passwordbaru = $_POST['passwordbaru'];
                                    $confirmpasswordbaru = $_POST['confirmpasswordbaru'];

                                    if ($pass == $password) {
                                        if ($passwordbaru == $confirmpasswordbaru) {
                                            $updatepassword = md5($passwordbaru);

                                            $query = "UPDATE users SET 
            password ='$updatepassword'
            WHERE user_id ='" . $data['user_id'] . "'";

                                            $result = mysqli_query($koneksi, $query);

                                            if (!$result) {
                                                die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                                                    " - " . mysqli_error($koneksi));
                                            } else {
                                                echo '<script>alert("Password berhasil diubah")</script>';
                                                echo '<script>window.location.href = "index.php?p=profile";</script>';
                                                exit();
                                            }
                                        } else {
                                            echo '<script>alert("Konfirmasi password Anda salah, pastikan memasukkan konfirmasi password yang sama dengan password baru Anda")</script>';
                                        }
                                    } else {
                                        echo '<script>alert("Password Anda salah")</script>';
                                        echo '<script>window.location.href = "index.php?p=update_password_profile";</script>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-right-profile">
                    <div class="content-right">
                        <ul>
                            <li>
                                <a href="index.php?p=update_foto_profile">Ubah foto profil</a>
                            </li>
                            <li>
                                <a href="index.php?p=update_data_profile">Ubah data profil</a>
                            </li>
                            <li>
                                <a href="index.php?p=update_password_profile">Ubah password</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
<?php
    }
} else {
    echo '<script>alert("Mohon maaf untuk membuka halaman ini Anda harus login dahulu")</script>';
    echo '<script>window.location.href = "Login.php";</script>';
}
?>