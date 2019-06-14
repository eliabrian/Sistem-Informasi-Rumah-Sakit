<?php
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location:../auth/login.php");
        exit;
    }

    require '../function.php';
    $id = $_GET["kodeWali"];
    $sqlDeleteWali = "UPDATE pasien SET kd_wali = '' WHERE kd_pasien = '$id'";
    mysqli_query($conn, $sqlDeleteWali) or mysqli_errno($sqlDeleteWali);
    echo 1;
    header('Location:pasien.php');

?>