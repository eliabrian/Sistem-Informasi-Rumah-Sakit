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
    <title>Pasien - Tambah Wali</title>
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
                            <a href="../pasien/pasien.php" class="nav-link active">
                                <i class="fas fa-user-injured mr-1"></i>
                                &nbsp;Pasien
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="wali.php" class="nav-link">
                                <i class="fas fa-user-shield mr-1"></i>
                                Wali
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4" role="main">
                <div class="d-flex justify content between flex-wrap flex-md-nowrap align-item-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Tambah Wali</h1>
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
                <ul class="nav nav-pills" id="tabWali" role="tablist">
                    <li class="nav-item">
                        <a href="#ada" class="nav-link active" id="ada-tab" data-toggle="pill" role="tab" aria-controls="ada" aria-selected="true">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a href="#daftar" class="nav-link" id="daftar-tab" data-toggle="pill" role="tab" aria-controls="daftar" aria-selected="false">Baru</a>
                    </li>
                </ul>
                <form action="insert-wali.php" method="post">
                    <div class="tab-content" id="waliTabContent">
                        <div class="tab-pane fade show active" id="ada" role="tabpanel" aria-labelledby="ada-tab">
                            <div class="clearfix">
                                <h4 class="mt-3 float-left">Tabel Wali</h4>
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
                                        $queryReadWali = "SELECT * FROM wali ORDER BY created_at";
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
                        <div class="tab-pane fade" id="daftar" role="tabpanel" aria-labeledby="daftar-tab">
                            <h4 class="mt-3">Informasi Wali</h4>
                            
                                <div class="mb-3 form-row d-none">
                                    <div class="col-md-6 p-0">
                                        <label for="wali">Kode Wali</label>
                                        <input type="text" class="form-control" id="wali" name="kd_wali" value="<?php echo $kode?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pasien">Kode Pasien</label>
                                        <input type="text" class="form-control" id="pasien" name="kd_pasien" value="<?php echo $id?>">
                                    </div>
                                </div>
                                <div class="my-3">
                                    <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                                    <input type="text" class="form-control" name="nik" id="nik" >
                                </div>
                                <div class="my-3">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama_wali" id="nama" >
                                </div>
                                <div class="my-3 form-row m-0">
                                    <div class="col-md-6 p-0">
                                        <label for="tempat">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="tempat_lahir" id="tempat" >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal">Tanggal Lahir</label>
                                        <input type="text" class="form-control" name="tgl_lahir" id="tanggal" placeholder="tttt/bb/hh" >
                                    </div>
                                </div>
                                <div class="my-3 form-row m-0">
                                    <div class="col-md-6 p-0">
                                        <label for="telepon">Nomor Telepon</label>
                                        <input type="text" class="form-control" name="no_telp" id="telepon" > 
                                    </div>
                                    <div class="col-md-6">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" id="alamat" > 
                                    </div>
                                </div>
                                <div class="my-3 form-row m-0">
                                    <div class="col-md-6 p-0">
                                        <label for="kelamin">Jenis Kelamin</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="laki" class="custom-control-input" name="jk" value="Laki-Laki"  checked>
                                            <label for="laki" class="custom-control-label">Laki-Laki</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="perempuan" class="custom-control-input" name="jk" value="Perempuan" >
                                            <label for="perempuan" class="custom-control-label">Perempuan</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="agama">Agama</label>
                                        <select name="agama" id="agama" class="custom-select">
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
                                        <label for="kewarganegaraan">Kewarganegaraan</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="kewarganegaraan" value="WNI" id="wni"  checked>
                                            <label for="wni" class="custom-control-label">WNI</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="kewarganegaraan" value="WNA" id="wna" >
                                            <label for="wna" class="custom-control-label">WNA</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-0">
                                        <label for="status">Status Perkawinan</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="sts_perkawinan" value="Belum Kawin" id="belum-kawin"  checked>
                                            <label for="belum-kawin" class="custom-control-label">Belum Kawin</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="sts_perkawinan" value="Kawin" id="kawin" >
                                            <label for="kawin" class="custom-control-label">Kawin</label>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-4">
                        </div>
                        <button type="submit" class="btn btn-dark mb-3">Masukan</button>
                        <a href="../pasien/pasien.php" class="btn btn-light mb-3 mr-3">Batal</a>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <!--Main Container-->
    <script>
        $(document).ready(function(){
            $('#daftar-tab').click(function(){
                $('input[name="cek_kode"]').prop('checked', false);
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>