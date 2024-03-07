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
                            <div class="card-profile foto-page-profil">
                                <img src="assets/img/foto_profil/<?php echo $data['gambar'] ?>" alt="">
                            </div>
                            <div class="name-page-profil">
                                <span><?php echo $data['nama_user'] ?></span>
                            </div>
                        </div>

                    </div>

                    <div class="box-info-profil">
                        <div class="cover">
                            <ul class="start">
                                <li>
                                    <span>NIP</span>
                                </li>
                                <li>
                                    <span>Instansi</span>
                                </li>
                                <li>
                                    <span>Email</span>
                                </li>
                                <li>
                                    <span>Role</span>
                                </li>
                            </ul>
                            <ul class="center">
                                <li>
                                    <span>:</span>
                                </li>
                                <li>
                                    <span>:</span>
                                </li>
                                <li>
                                    <span>:</span>
                                </li>
                                <li>
                                    <span>:</span>
                                </li>
                            </ul>
                            <ul class="end">
                                <li>
                                    <span><?php echo $data['nip'] ?></span>
                                </li>
                                <li>
                                    <span><?php echo $data['instansi'] ?></span>
                                </li>
                                <li>
                                    <span><?php echo $data['email'] ?></span>
                                </li>
                                <li>
                                    <span><?php echo $data['role'] ?></span>
                                </li>
                            </ul>
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