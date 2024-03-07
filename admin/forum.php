<?php
include 'config/conn.php';
if (isset($_SESSION['nama'])) {
?>
    <div class="header-forum">
        <a>Forum</a>
    </div>
    <div class="box-forum">
        <div class="header-forum-content">

            <div class="search-forum">
                <form class="form-search" method="POST" enctype="multipart/form-data">
                    <input class="input-search" name="cari" placeholder="Search..." autofocus required />
                    <button class="submit-search" type="submit" name="simpan"><i class='bx bx-search'></i></button>
                </form>
            </div>

            <div class="header-search-wrapper">
                <span class="search-main">
                    <i class='bx bx-search'></i>
                </span>
                <div class="search-form-main clearfix">
                    <div class="search clearfix">
                        <form class="form-search" method="POST" enctype="multipart/form-data">
                            <input class="input-search" name="cari" placeholder="Search..." autofocus required />
                            <button class="submit-search" type="submit" name="simpan"><i class='bx bx-search'></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $('.header-search-wrapper .search-main').click(function() {
                    $('.search-form-main').toggleClass('active-search');
                    $('.search').toggleClass('mobile');
                    $('.search-form-main .search-field').focus();
                });
            </script>
            <?php
            if (isset($_POST['simpan'])) {
                $cari = $_POST['cari'];
            }
            ?>
            <a href="index.php?p=forum_add" class="button-add">Tambah Forum</a>
        </div>

        <div class="content-forum">
            <?php
            if (isset($_POST['simpan'])) {
                $cari = $_POST['cari'];
                $query = mysqli_query($koneksi, "SELECT * FROM forums 
                    WHERE 
                    nama_user like '%" . $cari . "%' OR judul_forum like '%" . $cari . "%' OR pesan like '%" . $cari . "%'");
            } else {
                $query = mysqli_query($koneksi, "SELECT * FROM forums ORDER BY id_pesan DESC");
            }
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="box-pesan">
                    <div class="sampul-pesan">
                        <img src="assets/img/img_forum/<?php echo $row['gambar']; ?>" alt="">
                    </div>
                    <script>
                        function toggleMenuList(button) {
                            var parentDiv = button.closest('.box-pesan');
                            var menuList = parentDiv.querySelector('.menu-list');
                            menuList.classList.toggle('show');
                        }
                    </script>

                    <div class="description">
                        <div class="box-info-upload">
                            <div class="info-upload">
                                <p class="name-upload">Upload by <span><?php echo $row['nama_user']; ?></span></p>
                                <p class="date-upload">Created <span><?php echo $row['updated_at']; ?></span></p>
                            </div>

                            <div class="overlay">
                                <button class="menu-button" title="Action" onclick="toggleMenuList(this)"><i class='bx bx-dots-vertical-rounded'></i></button>

                                <ul id="menu-list" class="menu-list">
                                    <li><a onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" href="index.php?p=forum_delete&id=<?php echo $row['id_pesan'] ?>"> <span><i class='bx bx-trash'></i></span> Delete</a></li>
                                    <li><a href="index.php?p=forum_update&id=<?php echo $row['id_pesan'] ?>"> <span><i class='bx bx-edit-alt'></i></span> Ubah Data</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="title-forum"><?php echo $row['judul_forum']; ?></h3>
                        <p class="message-forum"><?php echo $row['pesan']; ?></p>
                    </div>
                    <?php
                    $id_forum = $row['id_pesan'];
                    $sql = mysqli_query($koneksi, "SELECT * FROM komentars WHERE id_forum='$id_forum'");
                    $jumlah = mysqli_num_rows($sql);
                    ?>
                    <a href="index.php?p=forum_komentar&id=<?php echo $row['id_pesan'] ?>" class="button-komentar">Ruang Diskusi <span>(<?php echo $jumlah ?> Percakapan)</span> </a>
                </div>
            <?php
            }
            ?>

        </div>

    </div>
<?php
} else {
    echo '<script>alert("Mohon maaf untuk membuka halaman ini Anda harus login dahulu")</script>';
    echo '<script>window.location.href = "Login.php";</script>';
}
?>