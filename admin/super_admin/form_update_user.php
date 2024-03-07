<?php
if ($_SESSION['role'] == 'Super Admin') {
?>
    <div class="header sub-header-user">
        <a href="index.php?p=user_aktif">User Account Aktif > Form Tambah</a>
    </div>

    <div class="box-forum">

        <div class="content-forum-add">

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
                    <label for="">Role</label>
                    <select name="role" type="text" required>
                        <option value="<?php echo $data['role']; ?>" <?php if ($data['role'] == $data['role']) echo 'selected="selected"'; ?>>
                            <?php echo $data['role']; ?>"
                        </option>
                        <option value="Super Admin">Super Admin</option>
                        <option value="Admin Dispacher">Admin Dispatcher</option>
                        <option value="Admin Pembangkit">Admin Pembangkit</option>
                        <option value="Pegawai">Pegawai</option>
                    </select>
                </div>
                <div class="group-form">
                    <label for="">Email</label>
                    <input type="email" name="email" value="<?php echo $data['email']; ?>" required>
                </div>
                <div class="group-form">
                    <label for="">ubah Foto Profil</label>
                    <div class="sampul-update">
                        <img src="assets/img/foto_profil/<?php echo $data['gambar']; ?>" alt="">
                    </div>
                    <p class="keterangan-form">* .jpg, .png, .jpeg</p>
                    <input type="file" name="photo" placeholder="Judul Forum">
                </div>
                <input name="Submit" type="submit" value="Ubah">
            </form>
            <?php

            include('config/conn.php');

            if (isset($_POST['Submit'])) {

                $nama = $_POST['nama'];
                $nip = $_POST['nip'];
                $instansi = $_POST['instansi'];
                $role = $_POST['role'];
                $email = $_POST['email'];
                $password = md5($_POST['password']);
                $photo = $_FILES['photo']['name'];
                $tmp = $_FILES['photo']['tmp_name'];
                $path = "assets/img/foto_profil/" . $photo;

                //query
                if (empty($photo)) {

                    if (
                        $data['nama_user'] == $nama &&
                        $data['nip'] == $nip &&
                        $data['instansi'] == $instansi &&
                        $data['role'] == $role &&
                        $data['email'] == $email
                    ) {
                        echo '<script>alert("Anda tidak melakukan pengubahan data")</script>';
                        echo '<script>window.location.href = "index.php?p=user_aktif";</script>';
                        exit();
                    }

                    $query = "UPDATE users SET 
        nama_user='$nama',
        nip ='$nip',
        instansi ='$instansi',
        role ='$role',
        email ='$email'
        WHERE user_id ='" . $data['user_id'] . "'";

                    $result = mysqli_query($koneksi, $query);

                    if (!$result) {
                        die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                            " - " . mysqli_error($koneksi));
                    } else {
                        echo '<script>alert("Data User berhasil diubah")</script>';
                        echo '<script>window.location.href = "index.php?p=user_aktif";</script>';
                        exit();
                    }
                } else {
                    if ($data['gambar'] == 'default_profil.png') {
                        move_uploaded_file($tmp, $path);

                        $query = "UPDATE users SET 
        nama_user='$nama',
        nip ='$nip',
        instansi ='$instansi',
        role ='$role',
        email ='$email',
        gambar = '$photo',
        path = '$path'
        WHERE user_id ='" . $data['user_id'] . "'";

                        $result = mysqli_query($koneksi, $query);

                        if (!$result) {
                            die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                                " - " . mysqli_error($koneksi));
                        } else {
                            echo '<script>alert("Dara berhasil diubah")</script>';
                            echo '<script>window.location.href = "index.php?p=user_aktif";</script>';
                            exit();
                        }
                    } else {
                        unlink($data['path']);
                        move_uploaded_file($tmp, $path);

                        $query = "UPDATE users SET 
        nama_user='$nama',
        nip ='$nip',
        instansi ='$instansi',
        role ='$role',
        email ='$email',
        gambar = '$photo',
        path = '$path'
        WHERE user_id ='" . $data['user_id'] . "'";

                        $result = mysqli_query($koneksi, $query);

                        if (!$result) {
                            die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                                " - " . mysqli_error($koneksi));
                        } else {
                            echo '<script>alert("Dara berhasil diubah")</script>';
                            echo '<script>window.location.href = "index.php?p=user_aktif";</script>';
                            exit();
                        }
                    }
                }
            }

            mysqli_close($koneksi);
            ?>

        </div>

    </div>

<?php
} else {
    echo '<script>alert("Mohon maaf halaman ini hanya dapat dilihat oleh Super Admin")</script>';
    echo '<script>window.location.href = "Login.php";</script>';
}
?>