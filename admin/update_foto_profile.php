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
                                <span>Ubah Foto Profile</span>
                            </div>
                        </div>
                    </div>

                    <div class="box-info-profil">
                        <div class="cover-edit-foto">

                            <div class="card-update-foto">
                                <div class="foto-profile">
                                    <img src="assets/img/foto_profil/<?php echo $data['gambar'] ?>" alt="">
                                </div>
                                <a class="btn-delete" href="index.php?p=delete_foto_profil&id=<?php echo $data['user_id'] ?>">Hapus foto profil</a>
                                <form class="form" method="POST" enctype="multipart/form-data">

                                    <div class="group-form">
                                        <label for="">Pilih Foto Baru</label>
                                        <p class="keterangan-form">* .jpg .png .jpeg</p>
                                        <input type="file" name="photo">
                                    </div>
                                    <input name="Submit" type="submit" value="Ubah foto">
                                </form>

                                <?php

                                include('config/conn.php');

                                if (isset($_POST['Submit'])) {

                                    $photo = $_FILES['photo']['name'];
                                    $tmp = $_FILES['photo']['tmp_name'];
                                    $path = "assets/img/foto_profil/" . $photo;


                                    if (empty($photo)) {
                                        echo '<script>alert("Anda tidak melakukan pengubahan data")</script>';
                                    } else {
                                        if ($data['gambar'] == "default_profil.png") {
                                            move_uploaded_file($tmp, $path);

                                            $query = "UPDATE users SET 
            gambar = '$photo',
            path = '$path'
            WHERE user_id ='" . $data['user_id'] . "'";

                                            $result = mysqli_query($koneksi, $query);

                                            if (!$result) {
                                                die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                                                    " - " . mysqli_error($koneksi));
                                            } else {
                                                echo '<script>alert("Foto profil diubah")</script>';
                                                echo '<script>window.location.href = "index.php?p=profile";</script>';
                                                exit();
                                            }
                                        } else {
                                            unlink($data['path']);
                                            move_uploaded_file($tmp, $path);

                                            $query = "UPDATE users SET 
            gambar = '$photo',
            path = '$path'
            WHERE user_id ='" . $data['user_id'] . "'";

                                            $result = mysqli_query($koneksi, $query);

                                            if (!$result) {
                                                die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                                                    " - " . mysqli_error($koneksi));
                                            } else {
                                                echo '<script>alert("Foto profil diubah")</script>';
                                                echo '<script>window.location.href = "index.php?p=profile";</script>';
                                                exit();
                                            }
                                        }
                                    }
                                }

                                mysqli_close($koneksi);
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