<?php
require '../function.php';
if(isset($_POST["kode"])){
    $kode = $_POST["kode"];
    $output = '';
    $query = "SELECT * FROM pasien WHERE kd_pasien = '$kode'";
    $result = mysqli_query($conn, $query);
    $queryWali = "SELECT * FROM wali WHERE kd_wali = (SELECT kd_wali FROM pasien WHERE pasien.kd_pasien = '$kode')";
    $resultWali = mysqli_query($conn, $queryWali);
    $rowWali = mysqli_fetch_assoc($resultWali);
    $output .= '
        <div class="table-responsive">
            <table class="table table-bordered">
    ';
    while($row = mysqli_fetch_assoc($result)){
        $output .= '
            <tr>
                <th width="30%"><label>Kode</label></th>
                <td width="70%">'.$row["kd_pasien"].'</td>
            </tr>
            <tr>
                <th width="30%"><label>NIK</label></th>
                <td width="70%">'.$row["nik"].'</td>
            </tr>
            <tr>
                <th width="30%"><label>Nama</label></th>
                <td width="70%">'.$row["nama_pasien"].'</td>
            </tr>
            <tr>
                <th width="30%"><label>TTL</label></th>
                <td width="70%">'.$row["tempat_lahir"]." / ".$row["tgl_lahir"].'</td>
            </tr>
            <tr>
                <th width="30%"><label>Kelamin</label></th>
                <td width="70%">'.$row["jk"].'</td>
            </tr>
            <tr>
                <th width="30%"><label>Alamat</label></th>
                <td width="70%">'.$row["alamat"].'</td>
            </tr>
            <tr>
                <th width="30%"><label>Telepon</label></th>
                <td width="70%">'.$row["no_telp"].'</td>
            </tr>
            <tr>
                <th width="30%"><label>Agama</label></th>
                <td width="70%">'.$row["agama"].'</td>
            </tr>
            <tr>
                <th width="30%"><label>Status Perkawinan</label></th>
                <td width="70%">'.$row["sts_perkawinan"].'</td>
            </tr>
            <tr>
                <th width="30%"><label>Kewarganegaraan</label></th>
                <td width="70%">'.$row["kewarganegaraan"].'</td>
            </tr>
            <tr>
                <th width="30%"><label>Pembayaran</label></th>
                <td width="70%">'.$row["pembayaran"].'</td>
            </tr>
            <tr>
                <th width="30%"><label>Dibuat</label></th>
                <td width="70%">'.$row["created_at"].'</td>
            </tr>
            <tr>
                <th width="30%"><label>Wali</label></th>
                <td width="70%">'.$rowWali["kd_wali"].' - '.$rowWali["nama_wali"].'</td>
            </tr>
        ';
    }
    $output .= "</table></div>";
    echo $output;
}
?>