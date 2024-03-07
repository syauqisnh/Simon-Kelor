<?php
if ($_SESSION['role'] == 'Super Admin') {
?>
    <div class="header">
        <a>User Account Aktif</a>
    </div>

    <div class="page-user">
        <div class="header-user">
            <a href="index.php?p=add_user" class="button-add"><i class='bx bx-plus'></i> Baru</a>
        </div>
        <div class="header-user-title">
            <a>User Account Admin</a>
        </div>
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
                    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE role LIKE '%Admin%' ORDER BY user_id DESC");
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
                                <a class="btn-action btn-edit" href="index.php?p=update_user&id=<?php echo $r['user_id'] ?>"> <span><i class='bx bx-edit-alt'></i></span> Edit</a>
                                <a class="btn-action btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" href="index.php?p=delete_user&id=<?php echo $r['user_id'] ?>"> <span><i class='bx bx-trash'></i></span> Delete</a>
                            </td>
                        <?php
                    }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="page-user">
        <div class="header-user-title">
            <a>User Account Pegawai</a>
        </div>
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
                    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE role LIKE '%Pegawai%' ORDER BY user_id DESC");
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
                                    <a class="btn-action btn-edit" href="index.php?p=update_user&id=<?php echo $r['user_id'] ?>"> <span><i class='bx bx-edit-alt'></i></span> Edit</a>
                                    <a class="btn-action btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" href="index.php?p=delete_user&id=<?php echo $r['user_id'] ?>"> <span><i class='bx bx-trash'></i></span> Delete</a>
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