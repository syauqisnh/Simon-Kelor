<?php
if (isset($_SESSION['nama'])) {
?>
    <div class="header header-documentation">
        <a href="index.php?p=documentation">Documentation > Dokumen Profil Kelistrikan</a>
    </div>

    <div class="page-dokumen">

        <?php
        if ($_SESSION['role'] == 'Pegawai') {
        ?>
        <?php
        } else {
        ?>
            <div class="header-dokumen">
                <a href="index.php?p=form_add_documentation" class="button-add"><i class='bx bx-plus'></i> Baru</a>
            </div>
        <?php
        }
        ?>
        <div class="content-dokumen">
            <table class="table-dokumen">
                <thead>
                    <tr>
                        <th></th>
                        <th>Pengolah data</th>
                        <th>Nama Dokumen</th>
                        <th>Ukuran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT documentations.*, nama_user FROM documentations
                JOIN users ON documentations.id_user = users.user_id
                WHERE documentations.jenis_dokumen = 'profil_kelistrikan'
                ORDER BY documentations.id_dokumen DESC
                ");
                    $cek_data = mysqli_num_rows($query);

                    if ($cek_data > 0) {

                        while ($data = mysqli_fetch_assoc($query)) {
                    ?>

                            <tr>
                                <td>
                                    <div class="box-logo-file-user">
                                        <img src="assets/img/icon_dokumen.png" alt="">
                                    </div>
                                </td>
                                <td><?php echo $data['nama_user'] ?></td>
                                <td><?php echo $data['nama_dokumen'] ?></td>
                                <td><?php echo $data['size_dokumen'] ?>kb</td>
                                <?php
                                if ($_SESSION['role'] == 'Pegawai') {
                                ?>
                                    <td>
                                        <a class="btn-action btn-unduh" href="index.php?p=dowload_file_documentation&id=<?php echo $data['id_dokumen'] ?>"> <i class='bx bxs-download'></i><span> Download </span></a>
                                    </td>
                                <?php
                                } else {
                                ?>
                                    <td>
                                        <a class="btn-action btn-edit" href="index.php?p=form_update_documentation&id=<?php echo $data['id_dokumen'] ?>"> <i class='bx bx-edit-alt'></i><span> Edit </span></a>
                                        <a class="btn-action btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" href="index.php?p=documentation_delete&id=<?php echo $data['id_dokumen'] ?>"> <i class='bx bx-trash'></i><span> Delete </span></a>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Tidak ada data</td>
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
    echo '<script>alert("Mohon maaf untuk membuka halaman ini Anda harus login dahulu")</script>';
    echo '<script>window.location.href = "Login.php";</script>';
}
?>