<?php
    require '../function.php';

    $kd_wali = mysqli_real_escape_string($conn, $_REQUEST['kd_wali']);
    $kd_pasien = mysqli_real_escape_string($conn, $_REQUEST['kd_pasien']);
    $nik = mysqli_real_escape_string($conn, $_REQUEST['nik']);
    $nama_wali = mysqli_real_escape_string($conn, $_REQUEST['nama_wali']);
    $tempat_lahir = mysqli_real_escape_string($conn, $_REQUEST['tempat_lahir']);
    $tgl_lahir = mysqli_real_escape_string($conn, $_REQUEST['tgl_lahir']);
    $no_telp = mysqli_real_escape_string($conn, $_REQUEST['no_telp']);
    $alamat = mysqli_real_escape_string($conn, $_REQUEST['alamat']);
    $jk = mysqli_real_escape_string($conn, $_REQUEST['jk']);
    $agama = mysqli_real_escape_string($conn, $_REQUEST['agama']);
    $kewarganegaraan = mysqli_real_escape_string($conn, $_REQUEST['kewarganegaraan']);
    $sts_perkawinan = mysqli_real_escape_string($conn, $_REQUEST['sts_perkawinan']);
   
    if(isset($_POST['cek_kode'])){
        $cek = mysqli_real_escape_string($conn, $_REQUEST['cek_kode']);
        var_dump($cek);
        $queryCek = "SELECT * FROM wali WHERE kd_wali = '$cek'";
        $resultCek = mysqli_query($conn, $queryCek);
        $rowCek = mysqli_fetch_assoc($resultCek);
        $kd_wali = $rowCek['kd_wali'];
        $kd_pasien = mysqli_real_escape_string($conn, $_REQUEST['kd_pasien']);

        $queryUpdatePasien = "UPDATE pasien SET kd_wali = '$kd_wali' WHERE kd_pasien = '$kd_pasien'";
        mysqli_query($conn, $queryUpdatePasien) or mysqli_errno();
    }else{
        $queryInsert = "INSERT INTO wali(kd_wali, nama_wali, jk, nik, tempat_lahir, tgl_lahir, alamat, agama, sts_perkawinan, kewarganegaraan, no_telp) VALUES ('$kd_wali', '$nama_wali', '$jk', '$nik', '$tempat_lahir', '$tgl_lahir','$alamat','$agama','$sts_perkawinan','$kewarganegaraan','$no_telp')" or die(mysqli_error());
        $queryUpdate = "UPDATE pasien SET kd_wali = '$kd_wali' WHERE kd_pasien = '$kd_pasien'";

        mysqli_query($conn, $queryInsert);
        mysqli_query($conn, $queryUpdate);
    }

    

    header('Location: ../pasien/pasien.php');
?>