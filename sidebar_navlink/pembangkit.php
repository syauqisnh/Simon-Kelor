<ul class="nav-links">
  <a href="index.php?p=profile">
    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE user_id =" . $_SESSION['user_id']);
    while ($data = mysqli_fetch_assoc($query)) {
    ?>
      <div class="box-profile">
        <img src="assets/img/foto_profil/<?php echo $data['gambar'] ?>" alt="">
        <h3><?php echo $data['role'] ?></h3>
        <p><?php echo $data['nama_user'] ?></p>
      </div>
    <?php
    }
    ?>
  </a>
  <li>
    <a href="index.php?p=realtime">
      <i class='bx bx-line-chart'></i>
      <span class="link_name">Realtime</span>
    </a>
  </li>
  <li>
    <a href="index.php?p=data_operasi">
      <i class='bx bx-collection'></i>
      <span class="link_name">Data Operasi</span>
    </a>
  </li>
  <li>
    <a href="index.php?p=documentation">
      <i class='bx bx-collection'></i>
      <span class="link_name">Documentation</span>
    </a>
  </li>
  <li>
    <a href="index.php?p=forum">
      <i class='bx bx-conversation'></i>
      <span class="link_name">Forum</span>
    </a>
  </li>
  <hr>
  <li>
    <a href="logout.php">
      <i class='bx bx-log-out'></i>
      <span class="link_name">Logout</span>
    </a>
  </li>
</ul>