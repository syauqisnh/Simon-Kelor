<?php
if (isset($_SESSION['nama'])) {
?>
    <div class="box-forum-komentar">

        <div class="header-forum-komentar">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM forums WHERE id_pesan ='" . $_GET['id'] . "'");
            while ($r = mysqli_fetch_assoc($query)) {
            ?>
                <div class="box-name">
                    <div class="img">
                        <img src="assets/img/img_forum/<?php echo $r['gambar']; ?>" alt="" width="10px">
                    </div>
                    <div class="judul-diskusi">
                        <span class="name">Ruang Diskusi</span>
                        <span class="type">(<?php echo $r['judul_forum']; ?>)</span>
                    </div>
                </div>
            <?php
            }
            ?>

            <div class="search-forum">
                <form class="form-search" method="POST" enctype="multipart/form-data">
                    <input class="input-search" name="cari" placeholder="Search..." required />
                    <button class="submit-search" type="submit" name="simpan"><i class='bx bx-search'></i></button>
                </form>
            </div>

        </div>

        <div class="content-forum-komentar">
            <?php
            if (isset($_POST['simpan'])) {
                $cari = $_POST['cari'];
                $query = mysqli_query($koneksi, "SELECT komentars.*, nama_user, id_user, role FROM komentars
            JOIN users ON komentars.id_user = users.user_id
            WHERE 
            komentars.id_forum = '" . $_GET['id'] . "' AND
            users.nama_user like '%" . $cari . "%' OR 
            komentars.id_forum = '" . $_GET['id'] . "' AND
            komentars.komentar like '%" . $cari . "%'OR 
            komentars.id_forum = '" . $_GET['id'] . "' AND
            komentars.file like '%" . $cari . "%'  
            ");
            } else {
                $query = mysqli_query($koneksi, "SELECT komentars.*, nama_user, id_user, role FROM komentars
            JOIN users ON komentars.id_user = users.user_id
            WHERE komentars.id_forum = '" . $_GET['id'] . "'
            ORDER BY komentars.created_at DESC
            ");
            }

            $cek_komentar = mysqli_num_rows($query);
            $allowTypesfoto = array('jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG');
            $allowTypesdok = array('doc', 'docx', 'xlx', 'xlsx', 'csv', 'ppt', 'pptx', 'pdf', 'DOC', 'DOCX', 'XLX', 'XLSX', 'CSV', 'PPT', 'PPTX', 'PDF');
            if ($cek_komentar > 0) {
            ?>
                <div class="page-message">

                    <?php
                    while ($data = mysqli_fetch_assoc($query)) {
                        if ($data['nama_user'] == $_SESSION['nama']) {
                            $class_box = "komentar-me";
                        } else {
                            $class_box = "komentar";
                        }
                    ?>

                        <div class=<?php echo $class_box ?>>
                            <?php
                            if ($data['nama_user'] == $_SESSION['nama']) {
                            ?>
                                <div class="box-me">
                                    <div class="box-delete">
                                        <a onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')" href="index.php?p=delete_komentar&id=<?php echo $data['id_komentar'] ?>"><i class='bx bx-trash'></i></a>
                                    </div>

                                    <div class="box-massage">
                                        <div class="content-komentar">
                                            <?php
                                            if (in_array($data['type'], $allowTypesdok)) {
                                            ?>
                                                <div class="box-file">
                                                    <div class="nama-file">
                                                        <div class="box-logo-file">
                                                            <img src="assets/img/icon_dokumen.png" alt="">
                                                        </div>
                                                        <span class="me"><?php echo $data['file'] ?></span>
                                                    </div>
                                                    <div class="box-download-me">
                                                        <a href="index.php?p=dowload_file_komentar&id=<?php echo $data['id_komentar'] ?>"><i class='bx bxs-download'></i></a>
                                                    </div>
                                                </div>
                                            <?php
                                            } elseif (in_array($data['type'], $allowTypesfoto)) {
                                            ?>
                                                <div class="box-foto">
                                                    <img src="assets/img/foto_komentar/<?php echo $data['file'] ?>" alt="">
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <p class="me">
                                                <?php echo $data['komentar'] ?>
                                            </p>
                                        </div>
                                        <div class="footer-komentar-me">
                                            <span><?php echo $data['created_at'] ?></span>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            } else {
                            ?>
                                <div class="header-komentar">
                                    <span class="user-name random-color"><?php echo $data['nama_user'] ?></span>
                                    <span class="user-role"><?php echo $data['role'] ?></span>
                                </div>
                                <div class="content-komentar">

                                    <?php
                                    if (in_array($data['type'], $allowTypesdok)) {
                                    ?>
                                        <div class="box-file">
                                            <div class="nama-file">
                                                <div class="box-logo-file">
                                                    <img src="assets/img/icon_dokumen.png" alt="">
                                                </div>
                                                <span class="me"><?php echo $data['file'] ?></span>
                                            </div>
                                            <div class="box-download-me">
                                                <a href="index.php?p=dowload_file_komentar&id=<?php echo $data['id_komentar'] ?>"><i class='bx bxs-download'></i></a>
                                            </div>
                                        </div>
                                    <?php
                                    } elseif (in_array($data['type'], $allowTypesfoto)) {
                                    ?>
                                        <div class="box-foto">
                                            <img src="assets/img/foto_komentar/<?php echo $data['file'] ?>" alt="">
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <p>
                                        <?php echo $data['komentar'] ?>
                                    </p>
                                </div>
                                <div class="footer-komentar">
                                    <span><?php echo $data['created_at'] ?></span>
                                </div>
                            <?php
                            }
                            ?>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            <?php
            } else {
            ?>
                <div class="page-message">
                    <div class="no-komentar">
                        <div class="content-komentar">
                            <p>
                                Belum Ada Komentar
                            </p>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>

        <div class="box-form">
            <form class="form-send" method="POST" enctype="multipart/form-data">
                <div class="box-form-select-file">
                    <span class="file-name-label"></span>
                    <button class="cancel-file-button" type="button" onclick="cancelFileSelection()"><i class='bx bx-x'></i></button>
                </div>
                <div class="box-form-item">
                    <div class="icon-file">
                        <input id="send-file" name="file" class="visually-hidden" type="file">
                        <label for="send-file" class="file-input-label">
                            <i class='bx bxs-file-plus'></i>
                        </label>
                    </div>
                    <div class="group-form-komentar">
                        <input type="text" name="komentar" placeholder="Tulis Pesan" autofocus required>
                    </div>
                    <div>
                        <label for="send-komentar" class="file-input-label">
                            <i class="bx bx-send"></i>
                        </label>
                    </div>
                    <input id="send-komentar" class="send-komentar" name="Submit" type="submit">
                </div>
            </form>
        </div>
    </div>


    <?php
    include('config/conn.php');

    if (isset($_POST['Submit'])) {
        // echo '<script>alert("disubmit")</script>';

        $id_forum = $_GET['id'];
        $id_user = $_SESSION['user_id'];
        $komentar = $_POST['komentar'];
        $file = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $tmp = $_FILES['file']['tmp_name'];
        $pathfoto = "assets/img/foto_komentar/" . $file;
        $pathdoc = "assets/file/file_komentar/" . $file;
        $fileTypefoto = pathinfo($pathfoto, PATHINFO_EXTENSION);
        $fileTypedoc = pathinfo($pathdoc, PATHINFO_EXTENSION);

        //query
        if (empty($file)) {
            $query =  "INSERT INTO komentars (id_forum, id_user, komentar) 
    VALUES('$id_forum' , '$id_user' , '$komentar')";

            $result = mysqli_query($koneksi, $query);

            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                    " - " . mysqli_error($koneksi));
            } else {
                echo '<script>window.location.href = "index.php?p=forum_komentar&id=' . $id_forum . '";</script>';

                exit();
            }
        } else {
            if (in_array($fileTypefoto, $allowTypesfoto)) {
                $query =  "INSERT INTO komentars (id_forum, id_user, komentar, file, type, path, size) 
VALUES('$id_forum' , '$id_user' , '$komentar', '$file', '$fileTypefoto', '$pathfoto', '$size')";

                $result = mysqli_query($koneksi, $query);

                if (!$result) {
                    die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                        " - " . mysqli_error($koneksi));
                } else {
                    move_uploaded_file($tmp, $pathfoto);
                    echo '<script>window.location.href = "index.php?p=forum_komentar&id=' . $id_forum . '";</script>';
                    exit();
                }
            } elseif (in_array($fileTypedoc, $allowTypesdok)) {
                $query =  "INSERT INTO komentars (id_forum, id_user, komentar, file, type, path, size) 
    VALUES('$id_forum' , '$id_user' , '$komentar', '$file', '$fileTypedoc', '$pathdoc', '$size')";

                $result = mysqli_query($koneksi, $query);

                if (!$result) {
                    die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                        " - " . mysqli_error($koneksi));
                } else {
                    move_uploaded_file($tmp, $pathdoc);
                    echo '<script>window.location.href = "index.php?p=forum_komentar&id=' . $id_forum . '";</script>';
                    exit();
                }
            }
        }
    }

    mysqli_close($koneksi);
    ?>
    <!-- </div>

</div> -->





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#send-file').change(function() {
                var fullPath = $(this).val();
                var fileName = fullPath.split('\\').pop();
                $('.file-name-label').text(fileName).show();
                $('.cancel-file-button').show();
                // $('.file-name-label-select').text(fileName).show();
            });
        });

        function cancelFileSelection() {
            $('#send-file').val(''); // Mengatur kembali nilai input file menjadi kosong
            $('.file-name-label').text('').hide(); // Mengosongkan dan menyembunyikan label nama file
            $('.cancel-file-button').hide(); // Menyembunyikan tombol "Batal" kembali
        }
        document.addEventListener("DOMContentLoaded", function() {
            var elements = document.getElementsByClassName("random-color");
            for (var i = 0; i < elements.length; i++) {
                var randomColor = getRandomColor();
                elements[i].style.color = randomColor;
            }
        });

        function getRandomColor() {
            var letters = "0123456789ABCDEF";
            var color = "#";
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        $(document).ready(function() {
            $('#send-file').change(function() {
                var fullPath = $(this).val();
                var fileName = fullPath.split('\\').pop().split('/').pop();
                $('.file-name-label').text(fileName).show();
            });
        });
    </script>

<?php
} else {
    echo '<script>alert("Mohon maaf untuk membuka halaman ini Anda harus login dahulu")</script>';
    echo '<script>window.location.href = "Login.php";</script>';
}
?>