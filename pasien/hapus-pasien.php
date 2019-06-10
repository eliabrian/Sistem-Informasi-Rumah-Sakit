<?php
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location:../auth/login.php");
        exit;
    }
    require '../function.php';
    $id = $_GET["kode"];
    $sqlDeletePasien = "UPDATE pasien SET flag_active = 'n' WHERE kd_pasien = '$id'";
    mysqli_query($conn, $sqlDeletePasien);
    header('Location:pasien.php');
?>