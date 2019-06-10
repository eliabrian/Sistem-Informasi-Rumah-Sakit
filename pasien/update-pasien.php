<?php
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location:../auth/login.php");
        exit;
    }


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

    $queryReadPasien = "SELECT * FROM pasien WHERE kd_pasien ='$kd_pasien'";
    $resultReadPasien = mysqli_query($conn, $queryReadPasien);
    $rowReadPasien = mysqli_fetch_assoc($resultReadPasien);

        
    if($rowReadPasien['kd_wali'] == '' || $rowReadPasien['kd_wali'] == 'NULL'){
         $queryUpdate = "UPDATE pasien SET nik = '$nik', nama_pasien = '$nama_pasien', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', no_telp = '$no_telp', alamat = '$alamat', jk = '$jk', agama = '$agama', kewarganegaraan = '$kewarganegaraan', sts_perkawinan = '$sts_perkawinan', pembayaran = '$pembayaran' WHERE kd_pasien = '$kd_pasien' ";
         mysqli_query($conn, $queryUpdate);
    }
        //Ini buat yang daftar
        if(isset($_POST['cek_kode'])){
            $cek = mysqli_real_escape_string($conn, $_REQUEST['cek_kode']);
            var_dump($cek);
            $queryCek = "SELECT * FROM wali WHERE kd_wali = '$cek'";
            $resultCek = mysqli_query($conn, $queryCek);
            $rowCek = mysqli_fetch_assoc($resultCek);

            $kd_pasien = mysqli_real_escape_string($conn, $_REQUEST['kd_pasien']);
            $kd_wali = $rowCek['kd_wali'];
            

            $queryUpdatePasien = "UPDATE pasien SET kd_wali = '$kd_wali' WHERE kd_pasien = '$kd_pasien'";
            mysqli_query($conn, $queryUpdatePasien) or mysqli_errno();
        }else{
            //Ini artinya buat yang ubah!
            $kd_wali = mysqli_real_escape_string($conn, $_REQUEST['kd_wali']);
            $nik_wali = mysqli_real_escape_string($conn, $_REQUEST['nik_wali']);
            $nama_wali = mysqli_real_escape_string($conn, $_REQUEST['nama_wali']);
            $tempat_lahir_wali = mysqli_real_escape_string($conn, $_REQUEST['tempat_lahir_wali']);
            $tgl_lahir_wali = mysqli_real_escape_string($conn, $_REQUEST['tgl_lahir_wali']);
            $no_telp_wali = mysqli_real_escape_string($conn, $_REQUEST['no_telp_wali']);
            $alamat_wali = mysqli_real_escape_string($conn, $_REQUEST['alamat_wali']);
            $jk_wali = mysqli_real_escape_string($conn, $_REQUEST['jk_wali']);
            $agama_wali = mysqli_real_escape_string($conn, $_REQUEST['agama_wali']);
            $kewarganegaraan_wali = mysqli_real_escape_string($conn, $_REQUEST['kewarganegaraan_wali']);
            $sts_perkawinan_wali = mysqli_real_escape_string($conn, $_REQUEST['sts_perkawinan_wali']);

            $queryUpdatePasien = "UPDATE pasien SET nik = '$nik', nama_pasien = '$nama_pasien', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', no_telp = '$no_telp', alamat = '$alamat', jk = '$jk', agama = '$agama', kewarganegaraan = '$kewarganegaraan', sts_perkawinan = '$sts_perkawinan', pembayaran = '$pembayaran' WHERE kd_pasien = '$kd_pasien' ";
            $queryUpdateWali = "UPDATE wali SET nik = '$nik_wali', nama_wali = '$nama_wali', tempat_lahir = '$tempat_lahir_wali', tgl_lahir = '$tgl_lahir_wali', no_telp = '$no_telp_wali', alamat = '$alamat_wali', jk = '$jk_wali', agama = '$agama_wali', kewarganegaraan = '$kewarganegaraan_wali', sts_perkawinan = '$sts_perkawinan_wali' WHERE kd_wali = '$kd_wali'";
            mysqli_query($conn, $queryUpdatePasien);
            mysqli_query($conn, $queryUpdateWali);
        }
        //Ini artinya buat yang baru!
        if(isset($_POST['cek'])){
            $cek = mysqli_real_escape_string($conn, $_REQUEST['cek']);
            var_dump($cek);
            $kd_wali = mysqli_real_escape_string($conn, $_REQUEST['kd_wali_baru']);
            $nik_wali = mysqli_real_escape_string($conn, $_REQUEST['nik_wali_baru']);
            $nama_wali = mysqli_real_escape_string($conn, $_REQUEST['nama_wali_baru']);
            $tempat_lahir_wali = mysqli_real_escape_string($conn, $_REQUEST['tempat_lahir_wali_baru']);
            $tgl_lahir_wali = mysqli_real_escape_string($conn, $_REQUEST['tgl_lahir_wali_baru']);
            $no_telp_wali = mysqli_real_escape_string($conn, $_REQUEST['no_telp_wali_baru']);
            $alamat_wali = mysqli_real_escape_string($conn, $_REQUEST['alamat_wali_baru']);
            $jk_wali = mysqli_real_escape_string($conn, $_REQUEST['jk_wali_baru']);
            $agama_wali = mysqli_real_escape_string($conn, $_REQUEST['agama_wali_baru']);
            $kewarganegaraan_wali = mysqli_real_escape_string($conn, $_REQUEST['kewarganegaraan_wali_baru']);
            $sts_perkawinan_wali = mysqli_real_escape_string($conn, $_REQUEST['sts_perkawinan_wali_baru']);

            $queryUpdatePasien = "UPDATE pasien SET nik = '$nik', nama_pasien = '$nama_pasien', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', no_telp = '$no_telp', alamat = '$alamat', jk = '$jk', agama = '$agama', kewarganegaraan = '$kewarganegaraan', sts_perkawinan = '$sts_perkawinan', pembayaran = '$pembayaran' WHERE kd_pasien = '$kd_pasien' ";
            $queryUpdatePasien = "UPDATE pasien SET kd_wali = '$kd_wali' WHERE kd_pasien = '$kd_pasien'";
            $queryInsertWali = "INSERT INTO wali(kd_wali, nama_wali, jk, nik, tempat_lahir, tgl_lahir, alamat, agama, sts_perkawinan, kewarganegaraan, no_telp) VALUES ('$kd_wali', '$nama_wali', '$jk', '$nik', '$tempat_lahir', '$tgl_lahir','$alamat','$agama','$sts_perkawinan','$kewarganegaraan','$no_telp')" or die(mysqli_error());
            mysqli_query($conn, $queryUpdatePasien);
            mysqli_query($conn, $queryInsertWali);
            }
        
    

    header('Location:pasien.php');
?>