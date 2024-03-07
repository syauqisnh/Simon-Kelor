<?php
if ($_SESSION['role'] == 'Super Admin') {
?>
    <div class="header">
        <a>User Account Non Aktif</a>
    </div>

    <div class="page-user">
        <div class="content-user">
            <table class="table-user">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>NIP</th>
                        <th>Instansi</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Foto Profil</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM user_registrasis ORDER BY id DESC");
                    $cek_data = mysqli_num_rows($query);

                    if ($cek_data > 0) {
                        while ($r = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $r['nama_user']; ?></td>
                                <td><?php echo $r['nip']; ?></td>
                                <td><?php echo $r['instansi']; ?></td>
                                <td><?php echo $r['email']; ?></td>
                                <td><?php echo $r['role']; ?></td>
                                <td><img src="assets/img/foto_profil/<?php echo $r['gambar']; ?>" alt="" width="100px"></td>
                                <td>
                                    <a class="btn-action btn-aktifkan" href="index.php?p=aktifkan_user_non_aktif&id=<?php echo $r['id'] ?>">Aktifkan</a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Tidak ada data</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
} else {
    echo '<script>alert("Mohon maaf halaman ini hanya dapat dilihat oleh Super Admin")</script>';
    echo '<script>window.location.href = "Login.php";</script>';
}
?>