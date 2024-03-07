<div class="header">
    <a>Forum</a>
</div>
<div class="box-forum">
    <div class="header-forum">

        <h2>Form Tambah Forum</h2>
    </div>

    <div class="content-forum-add">

        <form class="form" method="POST" enctype="multipart/form-data">
            <div class="group-form">
                <label for="">Judul Forum</label>
                <input type="text" name="judul" placeholder="Judul Forum" required>
            </div>
            <div class="group-form">
                <label for="">Keterangan Forum</label>
                <textarea type="text" name="keterangan" cols="30" rows="10"></textarea>
            </div>
            <div class="group-form">
                <label for="">Pilih Sampul</label>
                <p class="keterangan-form">* .jpg, .png, .jpeg</p>
                <input type="file" name="photo" placeholder="Judul Forum">
            </div>
            <input name="Submit" type="submit" value="Tambahkan">
        </form>
        <?php

        include('config/conn.php');

        if (isset($_POST['Submit'])) {

            if ($_SESSION['role'] == 'Super Admin') {

                $nama = $_SESSION['nama'];
                $judul = $_POST['judul'];
                $keterangan = $_POST['keterangan'];
                $photo = $_FILES['photo']['name'];
                $tmp = $_FILES['photo']['tmp_name'];
                $path = "assets/img/img_forum/" . $photo;

                //query
                if (empty($photo)) {
                    $query =  "INSERT INTO forums (nama_user , judul_forum, pesan, gambar) VALUES('$nama' , '$judul' , '$keterangan' , 'default.png')";

                    $result = mysqli_query($koneksi, $query);

                    if (!$result) {
                        die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                            " - " . mysqli_error($koneksi));
                    } else {
                        echo '<script>alert("Forum ditambahkan")</script>';
                        echo '<script>window.location.href = "index.php?p=forum";</script>';
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
                            echo '<script>window.location.href = "index.php?p=forum";</script>';
                            exit();
                        }
                    }
                }
            } else {
                echo '<script>alert("Mohon maaf hanya Super Admin yang berhak menambah data ini")</script>';
                echo '<script>window.location.href = "index.php?p=forum";</script>';
            }
        }

        mysqli_close($koneksi);
        ?>

    </div>

</div>