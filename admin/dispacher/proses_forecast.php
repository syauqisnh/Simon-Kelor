<?php
include '../../config/conn.php';

if (isset($_POST['Submit'])) {
    $a = $_POST['pilihan'];

    if (empty($a)) {
        echo "<script>alert('Pilih data dahulu sebelum melakukan forecasting')</script>";
        echo '<script>window.location.href = "../../index.php?p=forcasting";</script>';
    }

    if (count($a) > 1) {
        echo "<script>alert('Mohon untuk memilih 1 tanggal saja yang ingin Anda prediksi')</script>";
        echo '<script>window.location.href = "../../index.php?p=forcasting";</script>';
    }

    // Mengubah array tanggal menjadi string yang dapat digunakan dalam query SQL
    $tanggal_str = implode("', '", $a);

    //cek data
    $query_cek_data = mysqli_query($koneksi, "SELECT * FROM load_forcasting WHERE DATE(tanggal) = '$tanggal_str'");
    $cek_data = mysqli_num_rows($query_cek_data);

    if ($cek_data > 0) {
        echo "<script>alert('Hasil prediksi yang sesuai dengan tanggal pilihan Anda sudah tersedia, Anda dapat melihatnya pada Tabel Forecasting')</script>";
        echo '<script>window.location.href = "../../index.php?p=forcasting";</script>';
    }else{

    $tanggalHariIni = date("$tanggal_str");
    $valuecurrentDate = strtotime($tanggalHariIni);

    $date_select = array();
    for ($i = 1; $i <= 28; $i++) {
        $valuecurrentDate = strtotime('-1 day', $valuecurrentDate);
        $date = date("Y-m-d", $valuecurrentDate);
        $date_select[] = $date;
    }

    $date_select_str = "'" . implode("', '", $date_select) . "'";

    $data_beban = array(); // Array data beban
    $energi_harian = array();
    $energi_mingguan = array();
    $energi_mingguan2 = array();

    $query = mysqli_query($koneksi, "SELECT * FROM beban_kit WHERE DATE(tanggal) IN ($date_select_str)");

    // Menampilkan hasil query
    while ($row = mysqli_fetch_assoc($query)) {
        $data_beban[] = rtrim($row['total_beban'], 0);
    }

    if (count($data_beban) < 1344) {
        echo "<script>alert('Data untuk prediksi tidak lengkap, Kemungkinan ada beberapa data tidak terdaftar')</script>";
        echo '<script>window.location.href = "../../index.php?p=forcasting";</script>';
    }else{

    // Jumlah data per penjumlahan
    $data_per_jumlah_harian = 48;
    $data_per_jumlah_mingguan = 7;

    // Inisialisasi variabel
    $no = 1;
    for ($i = 0; $i < count($data_beban); $i++) {
        ${"beban" . $no} = $data_beban[$i];
        $no++;
    }
    for ($i = 1; $i <= 28; $i++) {
        ${"energi_d" . $i} = 0;
    }
    for ($i = 1; $i <= 4; $i++) {
        ${"energi_m" . $i} = 0;
        ${"energi_m2" . $i} = 0;
    }
    for ($m = 1; $m <= 4; $m++) {
        for ($d = 1; $d <= 7; $d++) {
            ${"koef_d" . $d . "_m" . $m} = 0;
        }
    }
    for ($m = 1; $m <= 28; $m++) {
        for ($d = 1; $d <= 48; $d++) {
            ${"koef_j" . $d . "_d" . $m} = 0;
        }
    }
    for ($i = 1; $i <= 7; $i++) {
        ${"total_koef_d" . $i} = 0;
        ${"totalrata_koef_d" . $i} = 0;
        ${"rata_koef_d" . $i} = 0;
        ${"predic_energi_d" . $i} = 0;
        for ($a = 1; $a <= 48; $a++) {
            ${"total_koef_d" . $i . "_j" . $a} = 0;
            ${"rata_koef_d" . $i . "_j" . $a} = 0;
            ${"d" . $i . "predicbeban_j" . $a} = 0;
        }
    }

    // Proses penjumlahan energi harian
    for ($i = 0; $i < count($data_beban); $i++) {
        // Menambahkan nilai data_beban ke variabel penjumlahan yang sesuai
        $index = ceil(($i + 1) / $data_per_jumlah_harian); // Menghitung indeks variabel penjumlahan
        ${"energi_d" . $index} += $data_beban[$i];
    }
    for ($i = 1; $i <= 28; $i++) {
        // Menambahkan nilai data_beban ke variabel penjumlahan yang sesuai
        ${"energi_d" . $i} /= 2;
        // ${"energi_d" . $i} = round(${"energi_d" . $i}, 2);
        $energi_harian[] = ${"energi_d" . $i};
    }


    // Proses penjumlahan energi mingguan
    for ($i = 0; $i < count($energi_harian); $i++) {
        // Menambahkan nilai data_beban ke variabel penjumlahan yang sesuai
        $index = ceil(($i + 1) / $data_per_jumlah_mingguan); // Menghitung indeks variabel penjumlahan
        ${"energi_m" . $index} += $energi_harian[$i];
        ${"energi_m2" . $index} += $energi_harian[$i];
    }
    for ($i = 1; $i <= 4; $i++) {
        $energi_mingguan[] = round(${"energi_m" . $i}, 2);
        $energi_mingguan2[] = ${"energi_m2" . $i};
        // $energi_mingguan[] = ${"energi_m" . $i};
    }

    //function forecasting

    function forecast($x, $known_y, $known_x)
    {
        $n = count($known_y);
        $mean_y = array_sum($known_y) / $n;
        $mean_x = array_sum($known_x) / $n;

        $diff_y = [];
        $diff_x = [];
        $diff_xy = [];

        for ($i = 0; $i < $n; $i++) {
            $diff_y[] = $known_y[$i] - $mean_y;
            $diff_x[] = $known_x[$i] - $mean_x;
            $diff_xy[] = $diff_y[$i] * $diff_x[$i];
        }

        $sum_xy = array_sum($diff_xy);
        $sum_xx = array_sum(array_map(function ($x) {
            return $x * $x;
        }, $diff_x));

        $slope = $sum_xy / $sum_xx;
        $intercept = $mean_y - $slope * $mean_x;
        $forecast = $intercept + $slope * $x;

        return $forecast;
    }

    $rentan_historis = $energi_mingguan;
    $rentan_waktu = [1, 2, 3, 4];
    $nilai_x = 5;

    $hasil_prediksi = forecast($nilai_x, $rentan_historis, $rentan_waktu);


    //menghitung koef harian per minggu
    $hari = 1;
    for ($i = 0; $i < count($energi_harian); $i++) {
        if ($hari == 8) {
            $hari = 1;
        }
        $index = ceil(($i + 1) / $data_per_jumlah_mingguan);
        ${"koef_d" . $hari . "_m" . $index} = round($energi_harian[$i] / ${"energi_m2" . $index}, 6);
        // ${"koef_d".$hari."_m".$index} = $energi_harian[$i] / ${"energi_m" . $index};
        $hari++;
    }

    //rata - rata koef per hari
    for ($d = 1; $d <= $data_per_jumlah_mingguan; $d++) {
        for ($i = 1; $i <= 4; $i++) {
            ${"total_koef_d" . $d} += ${"koef_d" . $d . "_m" . $i};
        }
    }
    for ($i = 1; $i <= 7; $i++) {
        ${"rata_koef_d" . $i} =  round(${"total_koef_d" . $i} / 4, 9);
    }

    //prediksi total energi per hari
    $total_koef_harian = 0;
    for ($i = 1; $i <= 7; $i++) {
        $total_koef_harian += ${"rata_koef_d" . $i};
    }

    for ($i = 1; $i <= 7; $i++) {
        // ${"predic_energi_d".$i} = round($hasil_prediksi * (${"rata_koef_d".$i} / $total_koef_harian), 2);
        ${"predic_energi_d" . $i} = $hasil_prediksi * (${"rata_koef_d" . $i} / $total_koef_harian);
    }

    //menghitung koef harian per 30 mmenit
    $x = 1;
    for ($i = 0; $i < count($data_beban); $i++) {
        if ($x == 49) {
            $x = 1;
        }
        $index = ceil(($i + 1) / $data_per_jumlah_harian);
        ${"koef_j" . $x . "_d" . $index} = $data_beban[$i] / ${"energi_d" . $index};
        $x++;
    }

    //rata - rata koef per 30 menit
    $a = 1;
    $x = 1;
    for ($a = 1; $a <= 7; $a++) {
        for ($d = 1; $d <= $data_per_jumlah_harian; $d++) {
            for ($i = $x; $i <= 28; $i += 7) {
                ${"total_koef_d" . $a . "_j" . $d} += ${"koef_j" . $d . "_d" . $i};
                // echo 'no '.$d.' '.  round(${"koef_j".$d."_d".$i},3);
            }
        }
        $x++;
    }
    for ($i = 1; $i <= 7; $i++) {
        for ($a = 1; $a <= 48; $a++) {
            ${"rata_koef_d" . $i . "_j" . $a} = ${"total_koef_d" . $i . "_j" . $a} / 4;
        }
    }

    //prediksi total energi per 30 menit
    for ($i = 1; $i <= 7; $i++) {
        for ($a = 1; $a <= 48; $a++) {
            ${"totalrata_koef_d" . $i} += ${"rata_koef_d" . $i . "_j" . $a};
        }
    }
    for ($i = 1; $i <= 7; $i++) {
        for ($a = 1; $a <= 48; $a++) {
            ${"d" . $i . "predicbeban_j" . $a} = (${"predic_energi_d" . $i} * (${"rata_koef_d" . $i . "_j" . $a} / ${"totalrata_koef_d" . $i})) * 2;
        }
    }

    // $tanggalHariIni = date("Y-m-d");
    $tanggal_hasil_forecast = strtotime($tanggalHariIni);
    // $valuecurrentDate = strtotime('+1 day', $valuecurrentDate);

    for ($i = 1; $i <= 7; $i++) {
        for ($a = 1; $a <= 48; $a++) {
            $date = date("Y-m-d", $tanggal_hasil_forecast);
            $beban = round(${"d" . $i . "predicbeban_j" . $a}, 2);
            $query =  "INSERT INTO load_forcasting 
        VALUES(NULL, '$date', '$beban')";

            $result = mysqli_query($koneksi, $query);

            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_error($koneksi) .
                    " - " . mysqli_error($koneksi));
            } else {
                echo "<script>alert('Hasil forecast baru didapat')</script>";
                echo '<script>window.location.href = "../../index.php?p=forcasting";</script>';
            }
        }
        $tanggal_hasil_forecast = strtotime('+1 day', $tanggal_hasil_forecast);
    }
}
    }
}
