<!--TODO: NAME = kd_pasien nik nama_pasien tempat_lahir tgl_lahir no_telp alamat jk agama kewarganegaraan sts_perkawinan pembayaran-->
<?php
    require '../function.php';

    $kd_pasien = mysqli_real_escape_string($conn, $_REQUEST['kd_pasien']);
    $nik = mysqli_real_escape_string($conn, $_REQUEST['nik']);
    $nama_pasien = mysqli_real_escape_string($conn, $_REQUEST['nama_pasien']);
    $tempat_lahir = mysqli_real_escape_string($conn, $_REQUEST['tempat_lahir']);
    $tgl_lahir = mysqli_real_escape_string($conn, $_REQUEST['tgl_lahir']);
    $no_telp = mysqli_real_escape_string($conn, $_REQUEST['no_telp']);
    $alamat = mysqli_real_escape_string($conn, $_REQUEST['alamat']);
    $jk = mysqli_real_escape_string($conn, $_REQUEST['jk']);
    $agama = mysqli_real_escape_string($conn, $_REQUEST['agama']);
    $kewarganegaraan = mysqli_real_escape_string($conn, $_REQUEST['kewarganegaraan']);
    $sts_perkawinan = mysqli_real_escape_string($conn, $_REQUEST['sts_perkawinan']);
    $pembayaran = mysqli_real_escape_string($conn, $_REQUEST['pembayaran']);

    $queryInsert = "INSERT INTO pasien(kd_pasien, nama_pasien, jk, nik, tempat_lahir, tgl_lahir, alamat, agama, sts_perkawinan, kewarganegaraan, no_telp, pembayaran) VALUES ('$kd_pasien', '$nama_pasien', '$jk', '$nik', '$tempat_lahir', '$tgl_lahir','$alamat','$agama','$sts_perkawinan','$kewarganegaraan','$no_telp','$pembayaran')" or die(mysqli_error());

    mysqli_query($conn, $queryInsert);
    header('Location: pasien.php');
?>