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
                        </a>
                    </span>

                </div>
            </div>

            <div class="content-box-profile">

                <div class="content-left-profile">

                    <div class="box-foto-profil">
                        <div class="underline">
                            <div class="name-page-update">
                                <span>Ubah Data Profile</span>
                            </div>
                        </div>
                    </div>

                    <div class="box-info-profil">
                        <div class="cover-edit-data">
                            <div class="card-update-data">
                                <form class="form" method="POST" enctype="multipart/form-data">
                                    <div class="group-form">
                                        <label for="">Nama User</label>
                                        <input type="text" name="nama" value="<?php echo $data['nama_user']; ?>" required>
                                    </div>
                                    <div class="group-form">
                                        <label for="">NIP</label>
                                        <input type="text" name="nip" value="<?php echo $data['nip']; ?>" required>
                                    </div>
                                    <div class="group-form">
                                        <label for="">Instansi</label>
                                        <input type="text" name="instansi" value="<?php echo $data['instansi']; ?>" required>
                                    </div>
                                    <div class="group-form">
                                        <label for="">Email</label>
                                        <input type="email" name="email" value="<?php echo $data['email']; ?>" required>
                                    </div>
                                    <input name="Submit" type="submit" value="Ubah data">
                                </form>

                                <?php

                                include('config/conn.php');

                                if (isset($_POST['Submit'])) {

                                    $nama = $_POST['nama'];
                                    $nip = $_POST['nip'];
                                    $instansi = $_POST['instansi'];
                                    $email = $_POST['email'];

                                    //query

                                    if (
                                        $data['nama_user'] == $nama &&
                                        $data['nip'] == $nip &&
                                        $data['instansi'] == $instansi &&
                                        $data['email'] == $email
                                    ) {
                                        echo '<script>alert("Anda tidak melakukan pengubahan data")</script>';
                                        echo '<script>window.location.href = "index.php?p=profile";</script>';
                                        exit();
                                    } else {

                                        if ($data['email'] == $email) {

                                            $query = "UPDATE users SET 
                                            nama_user='$nama',
                                            nip ='$nip',
                                            instansi ='$instansi',
                                            email ='$email'
                                            WHERE user_id ='" . $data['user_id'] . "'";

                                            $result = mysqli_query($koneksi, $query);

                                            if (!$result) {
                                                die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                                                    " - " . mysqli_error($koneksi));
                                            } else {
                                                echo '<script>alert("Data profile berhasil diubah")</script>';
                                                echo '<script>window.location.href = "index.php?p=profile";</script>';
                                                exit();
                                            }
                                        } else {

                                            $query = "UPDATE users SET 
                                            nama_user='$nama',
                                            nip ='$nip',
                                            instansi ='$instansi',
                                            email ='$email'
                                            WHERE user_id ='" . $data['user_id'] . "'";

                                            $result = mysqli_query($koneksi, $query);

                                            if (!$result) {
                                                die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                                                    " - " . mysqli_error($koneksi));
                                            } else {
                                                echo '<script>alert("Data profile berhasil diubah, Silahkan login kembali dengan email baru karena sistem membaca bahwa Anda baru saja mengubah email")</script>';
                                                echo '<script>window.location.href = "logout.php";</script>';
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