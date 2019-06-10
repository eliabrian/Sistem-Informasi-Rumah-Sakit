<?php
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location:../auth/login.php");
        exit;
    }
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
    <title>Pasien - Tambah Pasien</title>
</head>
<body>
    <!--Navbar-->
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a href="../index.php" class="navbar-brand col-sm-3 col-md-2 mr-0">SI Rumah Sakit</a>
        <input type="text" class="form-control form-control-dark w-100" hidden>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <!--TODO: GANTI HREFNYA! JANGAN LUPA-->
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
                        <h1 class="h2">Tambah Pasien</h1>
                    </div>
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
                    <h4 class="mb-3">Informasi Pasien</h4>
                    <!--TODO: NAME = kd_pasien nik nama_pasien tempat_lahir tgl_lahir no_telp alamat jk agama kewarganegaraan sts_perkawinan pembayaran-->
                    <form action="insert-pasien.php" method="post">
                        <div class="mb-3 d-none">
                            <label for="kode">Kode Pasien</label>
                            <input type="text" class="form-control" id="kode" name="kd_pasien" value="<?php echo $kode?>">
                        </div>
                        <div class="my-3">
                            <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" class="form-control" name="nik" id="nik" required>
                            <div class="invalid-feedback">Masukan Nomor Induk Kependudukan (NIK).</div>
                        </div>
                        <div class="my-3">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_pasien" id="nama" required>
                            <div class="invalid-feedback">Masukan nama lengkap.</div>
                        </div>
                        <div class="my-3 form-row m-0 ">
                            <div class="col-md-6 p-0">
                                <label for="tempat">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat" required>
                                <div class="invalid-feedback">Masukan tempat lahir.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal">Tanggal Lahir</label>
                                <input type="text" class="form-control" name="tgl_lahir" id="tanggal" placeholder="tttt/bb/hh" required>
                                <div class="invalid-feedback">Masukan tempat lahir.</div>
                            </div>
                        </div>
                        <!--TODO: BIKIN NO.TELP SAMA ALAMAT!-->
                        <div class="my-3 form-row m-0 ">
                            <div class="col-md-6 p-0">
                                <label for="telepon">Nomor Telepon</label>
                                <input type="text" class="form-control" name="no_telp" id="telepon" required>
                            </div>
                            <div class="col-md-6">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" required>
                            </div>
                        </div>
                        <div class="my-3 form-row m-0">
                            <div class="col-md-6 p-0">
                                <label for="kelamin">Jenis Kelamin</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="laki" class="custom-control-input" name="jk" value="Laki-Laki" required checked>
                                    <label for="laki" class="custom-control-label">Laki-Laki</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="perempuan" class="custom-control-input" name="jk" value="Perempuan" required>
                                    <label for="perempuan" class="custom-control-label">Perempuan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="agama">Agama</label>
                                <select name="agama" id="agama" class="custom-select">
                                    <option value="NULL">Masukkan agama</option>
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
                                <label for="kewarganegaraan">Kewarganegaraan</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="wni" class="custom-control-input" name="kewarganegaraan" value="WNI" required checked>
                                    <label for="wni" class="custom-control-label">Warga Negara Indonesia (WNI)</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="wna" class="custom-control-input" name="kewarganegaraan" value="WNA" required>
                                    <label for="wna" class="custom-control-label">Warga Negara Asing (WNA)</label>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <label for="status">Status Perkawinan</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="belum-kawin" class="custom-control-input" name="sts_perkawinan" value="Belum Kawin" required checked>
                                    <label for="belum-kawin" class="custom-control-label">Belum Kawin</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="kawin" class="custom-control-input" name="sts_perkawinan" value="Kawin" required>
                                    <label for="kawin" class="custom-control-label">Kawin</label>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <h4 class="mb-3">Pembayaran</h4>
                        <div class="my-3">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="bpjs" class="custom-control-input" name="pembayaran" value="BPJS" required checked>
                                <label for="bpjs" class="custom-control-label">BPJS</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="asuransi" class="custom-control-input" name="pembayaran" value="Asuransi" required>
                                <label for="asuransi" class="custom-control-label">Asuransi</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="personal" class="custom-control-input" name="pembayaran" value="Personal" required>
                                <label for="personal" class="custom-control-label">Personal</label>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <div class="float-left">
                            <button type="submit" class="btn btn-dark mb-3">Masukan</button>
                            <a href="pasien.php" class="btn btn-light mb-3 mr-3">Batal</a>
                        </div>
                    </form>
                    <script>

                    </script>
                </main>
            </div>
        </div>
    <!--Main Container-->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>