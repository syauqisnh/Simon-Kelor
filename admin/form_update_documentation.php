<?php
if (
    $_SESSION['role'] == 'Super Admin' or
    $_SESSION['role'] == 'Admin Dispacher' or
    $_SESSION['role'] == 'Admin Pembangkit'
) {
?>
    <div class="header header-documentation">
        <a href="index.php?p=documentation">Documentation > Form Update</a>
    </div>

    <div class="box-forum box-documentation">

        <div class="content-forum-add">

            <form class="form" method="POST" enctype="multipart/form-data">

                <div class="group-form">

                    <div class="nama-file-dokumen">
                        <div class="box-logo-file-dokumen">
                            <img src="assets/img/icon_dokumen.png" alt="">
                        </div>
                        <span class="me"><?php echo $data['nama_dokumen'] ?></span>
                    </div>
                    <label for="">Pilih Dokumen Baru</label>
                    <p class="keterangan-form">* .doc .docx .xlx .xlsx .csv .ppt .pptx .pdf</p>
                    <input type="file" name="file">
                </div>
                <div class="group-form">
                    <label for="">Jenis Dokumen</label>
                    <select name="jenis" type="text" required>
                        <option value="<?php echo $data['jenis_dokumen']; ?>" <?php if ($data['jenis_dokumen'] == $data['jenis_dokumen']) echo 'selected="selected"'; ?>>
                            Dokumen <?php echo $data['jenis_dokumen']; ?>
                        </option>
                        <option value="perencanaan">Dokumen Perencanaan</option>
                        <option value="evaluasi">Dokumen Evaluasi Operasi</option>
                        <option value="profil_kelistrikan">Dokumen Profil Kelistrikan</option>
                        <option value="sop_pengoperasian">Dokumen SOP Pengoperasian</option>
                        <option value="singel_line_diagram">Dokumen Single Line Diagram</option>
                    </select>
                </div>
                <input name="Submit" type="submit" value="Ubah data">
            </form>
            <?php

            include('config/conn.php');

            if (isset($_POST['Submit'])) {
                $file = $_FILES['file']['name'];
                $filesize = $_FILES['file']['size'];
                $tmp = $_FILES['file']['tmp_name'];
                $path = "assets/file/documentation/" . $file;
                $path_doc_lama = $data['path'];
                $id_user = $_SESSION['user_id'];
                $jenis = $_POST['jenis'];

                //query
                if (empty($file)) {
                    // echo '<script>alert("Tidak ada dokumen baru ditambahkan")</script>';
                    if (
                        $data['jenis_dokumen'] == $jenis
                    ) {
                        echo '<script>alert("Anda tidak melakukan pengubahan data")</script>';
                        echo '<script>window.location.href ="index.php?p=' . $jenis . '";</script>';
                        exit();
                    } else {

                        $query = "UPDATE documentations SET 
        id_user='$id_user',
        jenis_dokumen='$jenis'
        WHERE id_dokumen ='" . $data['id_dokumen'] . "'";

                        $result = mysqli_query($koneksi, $query);

                        if (!$result) {
                            die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                                " - " . mysqli_error($koneksi));
                        } else {
                            echo '<script>alert("Data berhasil diubah")</script>';
                            echo '<script>window.location.href ="index.php?p=' . $jenis . '";</script>';
                            exit();
                        }
                    }
                } else {
                    // echo '<script>alert("Dokumen baru ditambahkan")</script>';
                    // echo '<script>alert("'.$path.'")</script>';

                    $query = "UPDATE documentations SET 
    id_user='$id_user',
    nama_dokumen ='$file',
    jenis_dokumen='$jenis',
    size_dokumen='$filesize',
    path='$path'
    WHERE id_dokumen ='" . $data['id_dokumen'] . "'";

                    $result = mysqli_query($koneksi, $query);

                    if (!$result) {
                        die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                            " - " . mysqli_error($koneksi));
                    } else {
                        unlink($path_doc_lama);
                        move_uploaded_file($tmp, $path);
                        echo '<script>alert("Data berhasil diubah")</script>';
                        echo '<script>window.location.href ="index.php?p=' . $jenis . '";</script>';
                        exit();
                    }
                }
            }

            mysqli_close($koneksi);
            ?>

        </div>

    </div>

<?php
} else {
    echo '<script>alert("Mohon maaf halaman ini hanya dapat dilihat oleh Admin")</script>';
    echo '<script>window.location.href = "Login.php";</script>';
}
?>