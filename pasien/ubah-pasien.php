<?php
    require('../function.php');
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location:../auth/login.php");
        exit;
    }

    $id = $_GET['q'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <title>Pasien - Ubah Pasien</title>
</head>
<body>
    <!--Navbar-->
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a href="../index.php" class="navbar-brand col-sm-3 col-md-2 mr-0">SI Rumah Sakit</a>
        <input type="text" class="form-control form-control-dark w-100" hidden>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a href="../auth/logout.php" class="nav-link">Keluar</a>
            </li>
        </ul>
    </nav>
    <!--Navbar-->

    <!--Main Container-->
    <div class="container-fluid">
        <div class="row">
            <nav class="sidebar col-md-2 d-none d-md-block bg-light">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link">
                                <i class="fas fa-tachometer-alt mr-1"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pasien.php" class="nav-link active">
                                <i class="fas fa-user-injured mr-1"></i>
                                &nbsp;Pasien
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../wali/wali.php" class="nav-link">
                                <i class="fas fa-user-shield mr-1"></i>
                                Wali
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4" role="main">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-item-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Ubah Pasien</h1>
                </div>
                <h4 class="mb-3">Informasi Pasien</h4>
                <?php
                    $queryRead = "SELECT * FROM pasien WHERE kd_pasien = '$id'";
                    $resultRead = mysqli_query($conn, $queryRead);
                    $rowRead = mysqli_fetch_assoc($resultRead);
                    if($rowRead['kd_wali'] == '' || $rowRead['kd_wali'] == 'NULL'){?>
                    <form action="update-pasien.php" method="post">
                    <div class="mb-3 d-none">
                        <label for="kode">Kode Pasien</label>
                        <input type="text" class="form-control" id="kode" name="kd_pasien" value="<?php echo $rowRead['kd_pasien'];?>">
                    </div>
                    <div class="my-3">
                        <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $rowRead['nik'];?>" required>
                    </div>
                    <div class="my-3">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama_pasien" value="<?php echo $rowRead['nama_pasien']?>" required>
                    </div>
                    <div class="my-3 form-row m-0">
                        <div class="col-md-6 p-0">
                            <label for="tempat">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat" value="<?php echo $rowRead['tempat_lahir'];?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal">Tanggal Lahir</label>
                            <input type="text" class="form-control" id="tanggal" name="tgl_lahir" placeholder="tttt/bb/hh" value="<?php echo $rowRead['tgl_lahir'];?>" required>
                        </div>
                    </div>
                    <div class="my-3 form-row m-0">
                        <div class="col-md-6 p-0">
                            <label for="telepon">Nomor Telepon</label>
                            <input type="text" class="form-control" name="no_telp" id="telepon" value="<?php echo $rowRead['no_telp']?>">
                        </div>
                        <div class="col-md-6">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $rowRead['alamat']?>">
                        </div>
                    </div>
                    <div class="my-3 form-row m-0">
                        <div class="col-md-6 p-0">
                            <label for="kelamin">Jenis Kelamin</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="laki" name="jk" value="Laki-Laki" <?php if($rowRead['jk'] === 'Laki-Laki'){echo 'checked';}?> required>
                                <label for="laki" class="custom-control-label">Laki-Laki</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="jk" id="perempuan" value="Perempuan" <?php if($rowRead['jk'] === 'Perempuan'){echo 'checked';}?> required>
                                <label for="perempuan" class="custom-control-label">Perempuan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama" class="custom-select">
                                <option value="Islam" <?php if($rowRead['agama'] === 'Islam'){echo 'selected';}?> >Islam</option>
                                <option value="Kristen" <?php if($rowRead['agama'] === 'Kristen'){echo 'selected';}?> >Kristen</option>
                                <option value="Katholik" <?php if($rowRead['agama'] === 'Katholik'){echo 'selected';}?> >Katholik</option>
                                <option value="Hindu" <?php if($rowRead['agama'] === 'Hindu'){echo 'selected';}?> >Hindu</option>
                                <option value="Budha" <?php if($rowRead['agama'] === 'Budha'){echo 'selected';}?> >Budha</option>
                                <option value="Lainnya" <?php if($rowRead['agama'] === 'Lainnya'){echo 'selected';}?> >Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="my-3 form-row m-0">
                        <div class="col-md-6 p-0">
                            <label for="kewarganegaraan">Kewarganegaraan</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="wni" class="custom-control-input" name="kewarganegaraan" value="WNI" <?if($rowRead['kewarganegaraan'] === 'WNI'){echo 'checked';}?> required>
                                <label for="wni" class="custom-control-label">Warga Negara Indonesia (WNI)</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="wna" class="custom-control-input" name="kewarganegaraan" value="WNA" <?php if($rowRead['kewarganegaraan'] === 'WNA'){echo 'checked';} ?> required>
                                <label for="wna" class="custom-control-label">Warga Negara Asing (WNA)</label>
                            </div>
                        </div>
                        <div class="col-md-6 p-0">
                            <label for="status">Status Perkawinan</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="belum-kawin" class="custom-control-input" name="sts_perkawinan" value="Belum Kawin" <?php if($rowRead['sts_perkawinan'] === 'Belum Kawin'){echo 'checked';}?> required>
                                <label for="belum-kawin" class="custom-control-label">Belum Kawin</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="kawin" class="custom-control-input" name="sts_perkawinan" value="Kawin" <?php if($rowRead['sts_perkawinan'] === 'Kawin'){echo 'checked';}?> required>
                                <label for="kawin" class="custom-control-label">Kawin</label>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Pembayaran</h4>
                    <div class="my-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="bpjs" class="custom-control-input" name="pembayaran" value="BPJS" <?php if($rowRead['pembayaran'] === 'BPJS'){echo 'checked';}?> required>
                            <label for="bpjs" class="custom-control-label">BPJS</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="asuransi" class="custom-control-input" name="pembayaran" value="Asuransi" <?php if($rowRead['pembayaran'] === 'Asuransi'){echo 'checked';}?> required>
                            <label for="asuransi" class="custom-control-label">Asuransi</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="personal" class="custom-control-input" name="pembayaran" value="Personal" <?php if($rowRead['pembayaran'] === 'Personal'){echo 'checked';}?> required>
                            <label for="personal" class="custom-control-label">Personal</label>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="float-left">
                        <button type="submit" class="btn btn-dark mb-3">Masukan</button>
                        <a href="pasien.php" class="btn btn-light mb-3 mr-3">Batal</a>
                    </div>
                </form>
                <?php }else {?>
                <form action="update-pasien.php" method="post">
                    <div class="mb-3 d-none">
                        <label for="kode">Kode Pasien</label>
                        <input type="text" class="form-control" id="kode" name="kd_pasien" value="<?php echo $rowRead['kd_pasien'];?>">
                    </div>
                    <div class="my-3">
                        <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $rowRead['nik'];?>" required>
                    </div>
                    <div class="my-3">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama_pasien" value="<?php echo $rowRead['nama_pasien']?>" required>
                    </div>
                    <div class="my-3 form-row m-0">
                        <div class="col-md-6 p-0">
                            <label for="tempat">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat" value="<?php echo $rowRead['tempat_lahir'];?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal">Tanggal Lahir</label>
                            <input type="text" class="form-control" id="tanggal" name="tgl_lahir" placeholder="tttt/bb/hh" value="<?php echo $rowRead['tgl_lahir'];?>" required>
                        </div>
                    </div>
                    <div class="my-3 form-row m-0">
                        <div class="col-md-6 p-0">
                            <label for="telepon">Nomor Telepon</label>
                            <input type="text" class="form-control" name="no_telp" id="telepon" value="<?php echo $rowRead['no_telp']?>">
                        </div>
                        <div class="col-md-6">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $rowRead['alamat']?>">
                        </div>
                    </div>
                    <div class="my-3 form-row m-0">
                        <div class="col-md-6 p-0">
                            <label for="kelamin">Jenis Kelamin</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="laki" name="jk" value="Laki-Laki" <?php if($rowRead['jk'] === 'Laki-Laki'){echo 'checked';}?> required>
                                <label for="laki" class="custom-control-label">Laki-Laki</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="jk" id="perempuan" value="Perempuan" <?php if($rowRead['jk'] === 'Perempuan'){echo 'checked';}?> required>
                                <label for="perempuan" class="custom-control-label">Perempuan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama" class="custom-select">
                                <option value="Islam" <?php if($rowRead['agama'] === 'Islam'){echo 'selected';}?> >Islam</option>
                                <option value="Kristen" <?php if($rowRead['agama'] === 'Kristen'){echo 'selected';}?> >Kristen</option>
                                <option value="Katholik" <?php if($rowRead['agama'] === 'Katholik'){echo 'selected';}?> >Katholik</option>
                                <option value="Hindu" <?php if($rowRead['agama'] === 'Hindu'){echo 'selected';}?> >Hindu</option>
                                <option value="Budha" <?php if($rowRead['agama'] === 'Budha'){echo 'selected';}?> >Budha</option>
                                <option value="Lainnya" <?php if($rowRead['agama'] === 'Lainnya'){echo 'selected';}?> >Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="my-3 form-row m-0">
                        <div class="col-md-6 p-0">
                            <label for="kewarganegaraan">Kewarganegaraan</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="wni" class="custom-control-input" name="kewarganegaraan" value="WNI" <?php if($rowRead['kewarganegaraan'] === 'WNI'){echo 'checked';}?> required>
                                <label for="wni" class="custom-control-label">Warga Negara Indonesia (WNI)</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="wna" class="custom-control-input" name="kewarganegaraan" value="WNA" <?php if($rowRead['kewarganegaraan'] === 'WNA'){echo 'checked';} ?> required>
                                <label for="wna" class="custom-control-label">Warga Negara Asing (WNA)</label>
                            </div>
                        </div>
                        <div class="col-md-6 p-0">
                            <label for="status">Status Perkawinan</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="belum-kawin" class="custom-control-input" name="sts_perkawinan" value="Belum Kawin" <?php if($rowRead['sts_perkawinan'] === 'Belum Kawin'){echo 'checked';}?> required>
                                <label for="belum-kawin" class="custom-control-label">Belum Kawin</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="kawin" class="custom-control-input" name="sts_perkawinan" value="Kawin" <?php if($rowRead['sts_perkawinan'] === 'Kawin'){echo 'checked';}?> required>
                                <label for="kawin" class="custom-control-label">Kawin</label>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Pembayaran</h4>
                    <div class="my-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="bpjs" class="custom-control-input" name="pembayaran" value="BPJS" <?php if($rowRead['pembayaran'] === 'BPJS'){echo 'checked';}?> required>
                            <label for="bpjs" class="custom-control-label">BPJS</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="asuransi" class="custom-control-input" name="pembayaran" value="Asuransi" <?php if($rowRead['pembayaran'] === 'Asuransi'){echo 'checked';}?> required>
                            <label for="asuransi" class="custom-control-label">Asuransi</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="personal" class="custom-control-input" name="pembayaran" value="Personal" <?php if($rowRead['pembayaran'] === 'Personal'){echo 'checked';}?> required>
                            <label for="personal" class="custom-control-label">Personal</label>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <?php
                        if(isset($id)){
                            $sqlReadWali = "SELECT * FROM wali WHERE kd_wali = (SELECT kd_wali FROM pasien WHERE pasien.kd_pasien = '$id')";
                            $resultReadWali = mysqli_query($conn, $sqlReadWali);
                            $rowReadWali = mysqli_fetch_assoc($resultReadWali);
                        }
                    ?>
                    <!--Ubah Wali-->
                    <h4 class="mb-3">Informasi Wali</h4>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="pills-ada-tab" data-toggle="pill" href="#pills-ada" role="tab" aria-controls="pills-ada" aria-selected="true">Ubah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-daftar-tab" data-toggle="pill" href="#pills-daftar" role="tab" aria-controls="pills-daftar" aria-selected="false">Daftar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-baru-tab" data-toggle="pill" href="#pills-baru" role="tab" aria-controls="pills-baru" aria-selected="false">Baru</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade" id="pills-ada" role="tabpanel" aria-labelledby="pills-ada-tab">
                            <div class="mb-3 form-row d-none">
                                <div class="col-md-6 p-0">
                                    <label for="wali">Kode Wali</label>
                                    <input type="text" class="form-control" id="wali" name="kd_wali" value="<?php echo $rowReadWali['kd_wali']?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="pasien">Kode Pasien</label>
                                    <input type="text" class="form-control" id="pasien" name="kd_pasien" value="<?php echo $id?>">
                                </div>
                            </div>
                            <div class="my-3">
                                <label for="nikWali">Nomor Induk Kependudukan (NIK)</label>
                                <input type="text" class="form-control" id="nikWali" name="nik_wali" value="<?php echo $rowReadWali['nik'];?>" required>
                            </div>
                            <div class="my-3">
                                <label for="namaWali">Nama Lengkap</label>
                                <input type="text" class="form-control" id="namaWali" name="nama_wali" value="<?php echo $rowReadWali['nama_wali']?>">
                            </div>
                            <div class="my-3 form-row m-0">
                                <div class="col-md-6 p-0">
                                    <label for="tempatWali">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir_wali" id="tempatWali" value="<?php echo $rowReadWali['tempat_lahir']?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggalWali">Tanggal Lahir</label>
                                    <input type="text" class="form-control" name="tgl_lahir_wali" id="tanggalWali" value="<?php echo $rowReadWali['tgl_lahir'];?>">
                                </div>
                            </div>
                            <div class="my-3 form-row m-0">
                                <div class="col-md-6 p-0">
                                    <label for="teleponWali">Nomor Telepon</label>
                                    <input type="text" class="form-control" name="no_telp_wali" id="teleponWali" value="<?php echo $rowReadWali['no_telp'];?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="alamatWali">Alamat</label>
                                    <input type="text" class="form-control" name="alamat_wali" id="alamatWali" value="<?php echo $rowReadWali['alamat'];?>">
                                </div>
                            </div>
                            <div class="my-3 form-row m-0">
                                <div class="col-md-6 p-0">
                                    <label for="kelaminWali">Jenis Kelamin</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="lakiWali" name="jk_wali" value="Laki-Laki" <?php if($rowReadWali['jk'] === 'Laki-Laki'){echo 'checked';}?> required>
                                        <label for="lakiWali" class="custom-control-label">Laki-Laki</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="perempuanWali" name="jk_wali" value="Perempuan" <?php if($rowReadWali['jk'] === 'Perempuan'){echo 'checked';}?> required>
                                        <label for="perempuanWali" class="custom-control-label">Perempuan</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="agamaWali">Agama</label>
                                    <select name="agama_wali" id="agama" class="custom-select">
                                        <option value="Islam" <?php if($rowReadWali['agama'] === 'Islam'){echo 'selected';}?>>Islam</option>
                                        <option value="Kristen" <?php if($rowReadWali['agama'] === 'Kristen'){echo 'selected';}?>>Kristen</option>
                                        <option value="Katholik" <?php if($rowReadWali['agama'] === 'Katholik'){echo 'selected';}?>>Katholik</option>
                                        <option value="Hindu" <?php if($rowReadWali['agama'] === 'Hindu'){echo 'selected';}?>>Hindu</option>
                                        <option value="Budha" <?php if($rowReadWali['agama'] === 'Budha'){echo 'selected';}?>>Budha</option>
                                        <option value="Lainnya" <?php if($rowReadWali['agama'] === 'Lainnya'){echo 'selected';}?>>Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="my-3 form-row m-0">
                                <div class="col-md-6 p-0">
                                    <label for="kewarganegaraanWali">Kewarganegaraan</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="wniWali" class="custom-control-input" name="kewarganegaraan_wali" value="WNI" <?php if($rowReadWali['kewarganegaraan'] === 'WNI'){echo 'checked';} ?> required>
                                        <label for="wniWali" class="custom-control-label">Warga Negara Indonesia (WNI)</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="wnaWali" class="custom-control-input" name="kewarganegaraan_wali" value="WNA" <?php if($rowReadWali['kewarganegaraan'] === 'WNA'){echo 'checked';}?> required>
                                        <label for="wnaWali" class="custom-control-label">Warga Negara Asing (WNA)</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="statusWali">Status Perkawinan</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="belumKawinWali" name="sts_perkawinan_wali" value="Belum Kawin" <?php if($rowRead['sts_perkawinan'] === 'Belum Kawin'){echo 'checked';}?> required>
                                        <label for="belumKawinWali" class="custom-control-label">Belum Kawin</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="kawinWali" name="sts_perkawinan_wali" value="Kawin" <?php if($rowRead['sts_perkawinan'] === 'Kawin'){echo 'checked';}?> required>
                                        <label for="kawinWali" class="custom-control-label">Kawin</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-daftar" role="tabpanel" aria-labelledby="pills-daftar-tab">
                            <!--TABLE WALI DI BARU-->
                            <div class="clearfix">
                                <input class="form-control float-right w-25 mt-3" type="text" placeholder="Cari disini..." aria-label="Search" id="inputSearch">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm mt-2 table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">NIK</th>
                                            <th scope="col">No. Telp</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $dataKode = $rowRead['kd_pasien'];
                                        $queryReadWali = "SELECT * FROM wali WHERE NOT kd_wali IN (SELECT kd_wali FROM pasien WHERE pasien.kd_pasien = '$id')";
                                        $resultReadWali = mysqli_query($conn, $queryReadWali);
                                        
                                    ?>
                                    <tbody id="tableWali">
                                        <?php if(mysqli_num_rows($resultReadWali)>0){?>
                                            <?php while($rowReadWali = mysqli_fetch_assoc($resultReadWali)):?>
                                               <tr>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" name="cek_kode" value="<?php echo $rowReadWali['kd_wali']?>" id="<?php echo $rowReadWali['kd_wali']?>" >
                                                            <label for="<?php echo $rowReadWali['kd_wali']?>" class=" custom-control-label">&zwnj;</label>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $rowReadWali['kd_wali']?></td>
                                                    <td><?php echo $rowReadWali['nama_wali']?></td>
                                                    <td><?php echo $rowReadWali['nik']?></td>
                                                    <td><?php echo $rowReadWali['no_telp']?></td>
                                               </tr>
                                            <?php endwhile;?>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $("#inputSearch").on("keyup", function() {
                                    let value = $(this).val().toLowerCase();
                                    $("#tableWali tr").filter(function() {
                                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                    });
                                });
                            });
                        </script>
                        <!--BARU TAB-->
                        <?php
                            function acakHuruf($panjang){
                            $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $string = '';
                            for($i = 0; $i < $panjang; $i++){
                                $position = rand(0, strlen($karakter)-1);
                                $string .= $karakter{$position};
                            }
                            return $string;
                            }

                            function acakAngka($panjang){
                                $angka = '0123456789';
                                $string = '';
                                for($i = 0; $i < $panjang; $i++){
                                    $position = rand(0, strlen($angka)-1);
                                    $string .= $angka{$position};
                                }
                                return $string;
                            }

                            $huruf = acakHuruf(3);
                            $angka = acakAngka(3);
                            $kode = $huruf.$angka;
                        ?>
                        <div class="tab-pane fade" id="pills-baru" role="tabpanel" arialabelledby="pills-baru-tab">
                            <div class="my-3 form-row m-0 d-none">
                                <div class="col-md-6 p-0">
                                    <label for="cekBaru">Cek</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="cekBaru" class="custom-control-input" name="cek" value="cek">
                                        <label for="cekBaru" class="custom-control-label">&zwnj;</label>
                                    </div>
                                </div>
                                <div class="col-md-6 p-0">
                                    <label for="kodeBaru">Kode Wali</label>
                                    <input type="text" class="form-control" id="wali_baru" name="kd_wali_baru" value="<?php echo $kode?>">
                                </div>
                            </div>
                            <div class="my-3">
                                <label for="nikWaliBaru">Nomor Induk Kependudukan (NIK)</label>
                                <input type="text" class="form-control" name="nik_wali_baru" id="nikWaliBaru" >
                            </div>
                            <div class="my-3">
                                <label for="namaWaliBaru">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_wali_baru" id="namaWaliBaru" >
                            </div>
                            <div class="my-3 form-row m-0">
                                <div class="col-md-6 p-0">
                                    <label for="tempatWaliBaru">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir_wali_baru" id="tempatWaliBaru" >
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggalWaliBaru">Tanggal Lahir</label>
                                    <input type="text" class="form-control" name="tanggal_lahir_wali_baru" id="tempatWaliBaru" placeholder="tttt/bb/hh">
                                </div>
                            </div>
                            <div class="my-3 form-row m-0">
                                <div class="col-md-6 p-0">
                                    <label for="teleponWaliBaru">Nomor Telepon</label>
                                    <input type="text" class="form-control" name="no_telp_wali_baru" id="teleponWaliBaru"> 
                                </div>
                                <div class="col-md-6">
                                    <label for="alamatWaliBaru">Alamat</label>
                                    <input type="text" class="form-control" name="alamat_wali_baru" id="alamatWaliBaru">
                                </div>
                            </div>
                            <div class="my-3 form-row m-0">
                                <div class="col-md-6 p-0">
                                    <label for="kelaminWaliBaru">Jenis Kelamin</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="lakiWaliBaru" class="custom-control-input" name="jk_wali_baru" value="Laki-Laki" checked>
                                        <label for="lakiWaliBaru" class="custom-control-label">Laki-Laki</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="perempuanWaliBaru" class="custom-control-input" name="jk_wali_baru" value="Perempuan">
                                        <label for="perempuanWaliBaru" class="custom-control-label">Perempuan</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="agamaWaliBaru">Agama</label>
                                    <select name="agama_wali_baru" id="agamaWaliBaru" class="custom-select">
                                        <option value="NULL">Masukan agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katholik">Katholik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="my-3 form-row m-0">
                                <div class="col-md-6 p-0">
                                    <label for="kewarganegaraanWaliBaru">Kewarganegaraan</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="kewarganegaraan_wali_baru" value="WNI" id="wniWaliBaru" checked>
                                        <label for="wniWaliBaru" class="custom-control-label">Warga Negara Indonesia (WNI)</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="kewarganegaraan_wali_baru" value="WNA" id="wnaWaliBaru">
                                        <label for="wnaWaliBaru" class="custom-control-label">Warga Negara Asing (WNA)</label>
                                    </div>
                                </div>
                                <div class="col-md-6 m-0">
                                    <label for="statusWaliBaru">Status Perkawinan</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="sts_perkawinan_wali_baru" value="Belum Kawin" id="belumKawinWaliBaru" checked>
                                        <label for="belumKawinWaliBaru" class="custom-control-label">Belum Kawin</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="sts_perkawinan_wali_baru" value="Kawin" id="kawinWaliBaru">
                                        <label for="kawinWaliBaru" class="custom-control-label">Kawin</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="float-left">
                        <button type="submit" class="btn btn-dark mb-3">Masukan</button>
                        <a href="pasien.php" class="btn btn-light mb-3 mr-3">Batal</a>
                    </div>
                </form>
                <?php }?>
            </main>
        </div>
    </div>
    <!--Main Container-->
    <script>
        $(document).ready(function(){
            $('#pills-ada-tab').click(function(){
                $('input[name="cek_kode"]').prop('checked', false);
            });
        });

        $(document).ready(function(){
            $('#pills-baru-tab').click(function(){
                $('input[name="cek_kode"]').prop('checked', false);
                $('input[name="cek"]').prop('checked', true);
            });
        });

        $(document).ready(function(){
            $('#pills-ada-tab').click(function(){
                $('input[name="cek"]').prop('checked', false);
            });
        });

        $(document).ready(function(){
            $('#pills-daftar-tab').click(function(){
                $('input[name="cek"]').prop('checked', false);
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>