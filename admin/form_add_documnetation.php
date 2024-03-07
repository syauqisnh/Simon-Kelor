<?php
if (
    $_SESSION['role'] == 'Super Admin' or
    $_SESSION['role'] == 'Admin Dispacher' or
    $_SESSION['role'] == 'Admin Pembangkit'
) {
?>
    <div class="header header-documentation">
        <a href="index.php?p=documentation">Documentation > Form Tambah</a>
    </div>

    <div class="box-forum box-documentation-add">

        <div class="content-forum-add">

            <form class="form" method="POST" enctype="multipart/form-data">

                <div class="group-form">
                    <label for="">Pilih Dokumen</label>
                    <p class="keterangan-form">* .doc .docx .xlx .xlsx .csv .ppt .pptx .pdf</p>
                    <input type="file" name="file" required>
                </div>
                <div class="group-form">
                    <label for="">Jenis Dokumen</label>
                    <select name="jenis" type="text" required>
                        <option>--- Pilih Jenis ---</option>
                        <option value="perencanaan">Dokumen Perencanaan</option>
                        <option value="evaluasi">Dokumen Evaluasi Operasi</option>
                        <option value="profil_kelistrikan">Dokumen Profil Kelistrikan</option>
                        <option value="sop_pengoperasian">Dokumen SOP Pengoperasian</option>
                        <option value="singel_line_diagram">Dokumen Single Line Diagram</option>
                    </select>
                </div>
                <input name="Submit" type="submit" value="Tambahkan">
            </form>
            <?php

            include('config/conn.php');

            if (isset($_POST['Submit'])) {
                $file = $_FILES['file']['name'];
                $filesize = $_FILES['file']['size'];
                $tmp = $_FILES['file']['tmp_name'];
                $path = "assets/file/documentation/" . $file;
                $id_user = $_SESSION['user_id'];
                $jenis = $_POST['jenis'];

                //query
                if (isset($file)) {
                    $query =  "INSERT INTO documentations 
    VALUES(NULL, '$id_user' , '$file' , '$jenis' , '$filesize' , '$path')";

                    $result = mysqli_query($koneksi, $query);

                    if (!$result) {
                        die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                            " - " . mysqli_error($koneksi));
                    } else {
                        move_uploaded_file($tmp, $path);
                        echo '<script>alert("Data berhasil ditambahkan")</script>';
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