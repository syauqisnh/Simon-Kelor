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
                <input type="text" name="judul" value="<?php echo $data['judul_forum']; ?>">
            </div>
            <div class="group-form">
                <label for="">Keterangan Forum</label>
                <textarea id="myTextarea" name="keterangan" cols="30" rows="10"><?php echo $data['pesan']; ?></textarea>
                <!-- <script>
                    document.getElementById("myTextarea").value = "<?php echo $data['pesan']; ?>";
                </script> -->
            </div>
            <div class="group-form">
                <label for="">Sampul yang digunakan</label>
                <div class="sampul-update">
                    <img src="assets/img/img_forum/<?php echo $data['gambar']; ?>" alt="">
                </div>
                <label for="">Pilih sampul baru untuk diubah</label>
                <p class="keterangan-form">* .jpg, .png, .jpeg</p>
                <input type="file" name="photo" placeholder="Judul Forum">
            </div>
            <input name="Submit" type="submit" value="Ubah data">
        </form>
        <?php

        include('config/conn.php');

        if (isset($_POST['Submit'])) {

            if ($_SESSION['role'] == "Super Admin") {

                $judul = $_POST['judul'];
                $keterangan = $_POST['keterangan'];
                $photo = $_FILES['photo']['name'];
                $tmp = $_FILES['photo']['tmp_name'];
                $path = "assets/img/img_forum/" . $photo;

                //query
                if (empty($photo)) {

                    if ($data['judul_forum'] == $judul && $data['pesan'] == $keterangan) {
                        echo '<script>alert("Anda tidak melakukan pengubahan data")</script>';
                        echo '<script>window.location.href = "index.php?p=forum";</script>';
                        exit();
                    }

                    $query = "UPDATE forums SET 
    judul_forum='$judul',
    pesan ='$keterangan'
    WHERE id_pesan ='" . $data['id_pesan'] . "'";

                    $result = mysqli_query($koneksi, $query);

                    if (!$result) {
                        die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                            " - " . mysqli_error($koneksi));
                    } else {
                        echo '<script>alert("Forum berhasil diubah")</script>';
                        echo '<script>window.location.href = "index.php?p=forum";</script>';
                        exit();
                    }
                } else {
                    if ($data['gambar'] == "default.png") {

                        move_uploaded_file($tmp, $path);

                        $query = "UPDATE forums SET 
    judul_forum='$judul',
    pesan='$keterangan',
    gambar='$photo'
    WHERE id_pesan='" . $data['id_pesan'] . "'";

                        $result = mysqli_query($koneksi, $query);

                        if (!$result) {
                            die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                                " - " . mysqli_error($koneksi));
                        } else {
                            echo '<script>alert("Forum berhasil diubah")</script>';
                            echo '<script>window.location.href = "index.php?p=forum";</script>';
                            exit();
                        }
                    } else {

                        unlink('assets/img/img_forum/' . $data['gambar']);

                        move_uploaded_file($tmp, $path);

                        $query = "UPDATE forums SET 
    judul_forum='$judul',
    pesan='$keterangan',
    gambar='$photo'
    WHERE id_pesan='" . $data['id_pesan'] . "'";

                        $result = mysqli_query($koneksi, $query);

                        if (!$result) {
                            die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                                " - " . mysqli_error($koneksi));
                        } else {
                            echo '<script>alert("Forum berhasil diubah")</script>';
                            echo '<script>window.location.href = "index.php?p=forum";</script>';
                            exit();
                        }
                    }
                }
            } else {
                echo '<script>alert("Mohon maaf hanya Super Admin yang berhak mengubah data ini")</script>';
                echo '<script>window.location.href = "index.php?p=forum";</script>';
            }
        }

        mysqli_close($koneksi);

        ?>

    </div>

</div>