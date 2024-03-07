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
                    <input type="text" name="nama" placeholder="Nama User" required>
                </div>
                <div class="group-form">
                    <label for="">NIP</label>
                    <input type="text" name="nip" placeholder="NIP" required>
                </div>
                <div class="group-form">
                    <label for="">Instansi</label>
                    <input type="text" name="instansi" placeholder="Instansi" required>
                </div>
                <div class="group-form">
                    <label for="">Role</label>
                    <select name="role" type="text" required>
                        <option>--- Pilih Role ---</option>
                        <option value="Super Admin">Super Admin</option>
                        <option value="Admin Dispacher">Admin Dispatcher</option>
                        <option value="Admin Pembangkit">Admin Pembangkit</option>
                        <option value="Pegawai">Pegawai</option>
                    </select>
                </div>
                <div class="group-form">
                    <label for="">Email</label>
                    <input type="email" name="email" placeholder="example@gmail.com" required>
                </div>
                <div class="group-form">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="********" required>
                </div>
                <div class="group-form">
                    <label for="">Pilih Foto Profil</label>
                    <p class="keterangan-form">* .jpg, .png, .jpeg</p>
                    <input type="file" name="photo" placeholder="Judul Forum">
                </div>
                <input name="Submit" type="submit" value="Tambahkan">
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
                $path = "assets/img/" . $photo;

                //query
                if (empty($photo)) {
                    $query =  "INSERT INTO users 
    VALUES(NULL, '$nama' , '$nip' , '$instansi' , '$role' , '$email' , '$password' , 'default_profil.png', NULL, NULL, NULL)";

                    $result = mysqli_query($koneksi, $query);

                    if (!$result) {
                        die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                            " - " . mysqli_error($koneksi));
                    } else {
                        echo '<script>alert("Data berhasil ditambahkan")</script>';
                        echo '<script>window.location.href ="index.php?p=user_aktif";</script>';
                        exit();
                    }
                } else {
                    if (move_uploaded_file($tmp, $path)) {
                        $query =  "INSERT INTO forums(nama_user , judul_forum, pesan, gambar) VALUES('$nama' , '$judul' , '$keterangan' , '$photo')";

                        $result = mysqli_query($koneksi, $query);

                        if (!$result) {
                            die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                                " - " . mysqli_error($koneksi));
                        } else {
                            echo '<script>alert("Forum ditambahkan")</script>';
                            echo '<script>window.location.href = "index.php?p=forum_superadmin";</script>';
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