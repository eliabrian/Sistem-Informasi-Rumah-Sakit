<?php
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location:../auth/login.php");
        exit;
    }
    require '../function.php';
    $page = (isset($_GET['page']))? $_GET['page'] : 1;
    $limit = 10;
    $limit_start = ($page - 1 ) * $limit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Pasien</title>
</head>
<body>
    <!--Navbar-->
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.php">SI Rumah Sakit</a>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search" hidden>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <!--TODO: GANTI HREF NYA! JANGAN LUPA-->
                <a class="nav-link" href="../auth/logout.php">Keluar</a>
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
                    <h1 class="h2">Pasien</h1>
                </div>
                <!--TODO: INSERT 3/4 CHART BUAT PASIEN-->
                <!--TODO: JANGAN LUPA GANTI QUERY PAKE FLAG ACTIVE-->
                <?php
                    //Kewarganegaraan
                    $sqlWNI = "SELECT COUNT(*) 'count' FROM pasien WHERE kewarganegaraan = 'WNI' AND flag_active = 'y'";
                    $sqlWNA = "SELECT COUNT(*) 'count' FROM pasien WHERE kewarganegaraan = 'WNA'  AND flag_active = 'y'";

                    $resultWNI = mysqli_query($conn, $sqlWNI);
                    $resultWNA = mysqli_query($conn, $sqlWNA);

                    $rowWNI = mysqli_fetch_assoc($resultWNI);
                    $rowWNA = mysqli_fetch_assoc($resultWNA);

                    $dataCountry = array($rowWNI["count"],$rowWNA["count"]);

                    //Jenis Kelamin
                    $sqlLaki = "SELECT COUNT(*) 'count' FROM pasien WHERE jk = 'Laki-Laki' AND flag_active = 'y'";
                    $sqlPerempuan = "SELECT COUNT(*) 'count' FROM pasien WHERE jk = 'Perempuan' AND flag_active = 'y'";

                    $resultLaki = mysqli_query($conn, $sqlLaki);
                    $resultPerempuan = mysqli_query($conn, $sqlPerempuan);

                    $rowLaki = mysqli_fetch_assoc($resultLaki);
                    $rowPerempuan = mysqli_fetch_assoc($resultPerempuan);

                    $dataGender = array($rowLaki["count"], $rowPerempuan["count"]);

                    //Jenis Pembayaran
                    $sqlBPJS = "SELECT COUNT(*) 'count' FROM pasien WHERE pembayaran = 'BPJS' AND flag_active = 'y'";
                    $sqlPersonal = "SELECT COUNT(*) 'count' FROM pasien WHERE pembayaran = 'Personal' AND flag_active = 'y'";
                    $sqlAsuransi = "SELECT COUNT(*) 'count' FROM pasien WHERE pembayaran = 'Asuransi' AND flag_active = 'y'";

                    $resultBPJS = mysqli_query($conn, $sqlBPJS);
                    $resultPersonal = mysqli_query($conn, $sqlPersonal);
                    $resultAsuransi = mysqli_query($conn, $sqlAsuransi);

                    $rowBPJS = mysqli_fetch_assoc($resultBPJS);
                    $rowPersonal = mysqli_fetch_assoc($resultPersonal);
                    $rowAsuransi = mysqli_fetch_assoc($resultAsuransi);

                    $dataPayment = array($rowBPJS["count"], $rowPersonal["count"], $rowAsuransi["count"]);
                            ?>

                <div class="row my-4">
                    <div class="col-md-4 col-sm-4">
                        <div class="layer border bg-white p-2">
                            <div class="layer mb-2 w-100 text-center border-bottom"><h2 class="h6" style="color:#777">Kewarganegaraan</h2></div>
                            <canvas id="chartContainerSatu" class="w-100" style="height:246px; display:block;"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="layer border bg-white p-2">
                            <div class="layer mb-2 w-100 text-center border-bottom"><h2 class="h6" style="color:#777">Jenis Kelamin</h2></div>
                            <canvas id="chartContainerDua" class="w-100" style="height:246px; display:block;"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="layer border bg-white p-2">
                            <div class="layer mb-2 w-100 text-center border-bottom"><h2 class="h6" style="color:#777">Jenis Pembayaran</h2></div>
                            <canvas id="chartContainerTiga" class="w-100" style="height:246px; display:block;"></canvas>
                        </div>
                    </div>
                </div>

                <script>
                    let chartSatu = document.getElementById('chartContainerSatu').getContext('2d');
                    let displayChartSatu = new Chart(chartSatu, {
                        type:'doughnut',
                        data:{
                            labels:['WNI', 'WNA'],
                            datasets:[{
                                data:<?php echo json_encode($dataCountry, JSON_NUMERIC_CHECK); ?>,
                                backgroundColor:['#5A7BB5', '#81F1B2']
                            }]
                        },
                        options:{
                            legend:{
                                position:'bottom'
                            }
                        }
                    });

                    let chartDua = document.getElementById('chartContainerDua').getContext('2d');
                    let displayChartDua = new Chart(chartDua, {
                        type:'doughnut',
                        data:{
                            labels:['Laki-Laki', 'Perempuan'],
                            datasets:[{
                                data:<?php echo json_encode($dataGender, JSON_NUMERIC_CHECK);?>,
                                backgroundColor:['#4FA4F3','#FD665C']
                            }]
                        },
                        options:{
                            legend:{
                                position:'bottom'
                            }
                        }
                    });

                    let chartTiga = document.getElementById('chartContainerTiga').getContext('2d');
                    let displayChartTiga = new Chart(chartTiga, {
                        type:'doughnut',
                        data:{
                            labels:['BPJS', 'Personal', 'Asuransi'],
                            datasets:[{
                                data:<?php echo json_encode($dataPayment, JSON_NUMERIC_CHECK);?>,
                                backgroundColor:['#FFA45B','#FFDA77','#AEE6E6']
                            }]
                        },
                        options:{
                            legend:{
                                position:'bottom'
                            }
                        }
                    });
                </script>

                <!--TODO: INSERT TABLE PASIEN DAN TOMBOL BUAT NAMBAH PASIEN (KALO BISA ADA SEARCH)-->
                <?php
                    $queryRead = "SELECT * FROM pasien WHERE flag_active = 'y' ORDER BY created_at DESC LIMIT $limit_start , $limit";
                    $resultRead = mysqli_query($conn, $queryRead);
                ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-item-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Tabel Pasien</h1>
                </div>
                <!--SCRIPT AJAX BUAT SEARCH-->
                <script>
                    $(document).ready(function(){
                    $("#inputSearch").on("keyup", function() {
                        let value = $(this).val().toLowerCase();
                        $("#tablePasien tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                      });
                    });
                </script>
                <!--SCRIPT BUAT SEARCH-->
                <div class="clearfix">
                    <input class="form-control float-left w-25" type="text" placeholder="Cari disini..." aria-label="Search" id="inputSearch">
                    <a class="btn btn-outline-dark float-right" href="./tambah-pasien.php" role="button">Tambah Pasien</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mt-2 table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Pembayaran</th>
                                <th scope="col"  style="text-align:center!important;">Wali</th>
                                <th scope="col" style="text-align:center!important;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tablePasien">
                            <?php if(mysqli_num_rows($resultRead)>0){?>
                                <?php while($rowRead = mysqli_fetch_assoc($resultRead)):?>
                                <tr>
                                    <td><a id="<?php echo $rowRead['kd_pasien']?>" name="view" href="#" class="badge badge-pill badge-dark view-data-pasien" data-toggle="modal" ><?php echo $rowRead["kd_pasien"]?></a></td>
                                    <td><?php echo $rowRead["nama_pasien"]?></td>
                                    <td><?php echo $rowRead["nik"]?></td>
                                    <td><?php echo $rowRead["pembayaran"]?></td>
                                    <?php if($rowRead["kd_wali"] == 'NULL' || $rowRead["kd_wali"] == ''){
                                        echo'<td  style="text-align:center!important;"><a class="btn btn-dark btn-sm" href="../wali/tambah-wali.php?q='.$rowRead["kd_pasien"].'" role="button"><i class="fas fa-plus-circle"></i></a></td>';
                                        ?>
                                    <?php }else{ ?>
                                        <?php 
                                            $kodeWali = $rowRead["kd_wali"];
                                            $queryReadWali = "SELECT * FROM wali WHERE kd_wali = '$kodeWali' ";
                                            $resultReadWali = mysqli_query($conn, $queryReadWali);
                                            $rowReadWali = mysqli_fetch_assoc($resultReadWali);
                                        ?>
                                        <td style="text-align:center!important;"><a id="<?php echo $rowReadWali['kd_wali'];?>" name="view"  href="#" class="btn btn-dark btn-sm view-data-wali" data-toggle="modal" ><?php echo $rowReadWali['kd_wali']?></a></td>
                                    <?php }?>
                                    <td  style="text-align:center!important;">
                                        <a class="btn btn-secondary btn-sm" role="button" href="ubah-pasien.php?q=<?php echo $rowRead['kd_pasien']?>"><i class="fas fa-pen"></i></a>
                                        <a id="<?php echo $rowRead['kd_pasien']?>" class="btn btn-light btn-sm alert-delete" data-toggle="modal" role="button" href="#"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr> 
                                <?php endwhile;?>
                            <?php }else{echo'<tr class="alert alert-danger m-2" role="alert"><td colspan="6">0 result</td></tr>';}?>
                        </tbody>
                    </table>
                </div>
                <!--Pagination-->
                <?php
                $queryReadCount = "SELECT COUNT(*) 'count' FROM pasien WHERE flag_active = 'y'";
                $resultReadCount = mysqli_query($conn, $queryReadCount);
                $rowReadCount = mysqli_fetch_assoc($resultReadCount);
                $totalPage = ceil($rowReadCount['count']/ $limit);
                $totalNumber = 5;
                $startNumber = ($page > $totalNumber)? $page - $totalNumber : 1;
                $endNumber = ($page < ($totalPage - $totalNumber))? $page + $totalNumber : $totalPage;
                ?>
                <nav aria-label="Page pagination">
                    <ul class="pagination justify-content-end">
                    <?php if($page == 1){ ?>
                        <li class="page-item disabled">
                            <a href="#" tab-index="-1" aria-disabled="true" class="page-link">Sebelum</a>
                        </li>
                    <?php }else{
                        $link_prev = ($page>1)? $page-1 : 1;?>
                        <li class="page-item">
                            <a href="pasien.php?page=<?php echo $link_prev?>" tab-index="-1" class="page-link">Previous</a>
                        </li>
                    <?php }?>
                        <?php for($i = $startNumber; $i<=$endNumber; $i++){
                            $linkActive = ($page == $i)? 'class = "page-item active"' : '';
                            ?>
                            <li <?php echo $linkActive?>>
                                <a class="page-link " href="pasien.php?page=<?php echo $i?>"><?php echo $i?></a>
                            </li>
                        <?php }?>
                        <?php if($page == $totalPage){?>
                            <li class="page-item disabled">
                            <a href="#" tab-index="-1" aria-disabled="true" class="page-link">Berikut</a>
                        </li>
                        <?php }else{
                            $link_next = ($page < $totalPage)? $page+1 : $totalPage; ?>
                            <li class="page-item">
                                <a href="pasien.php?page=<?php echo $link_next?>" tab-index="-1" class="page-link">Berikut</a>
                            </li>
                        <?php }?>
                    </ul>
                </nav>
                <!--Pagination-->
            </main>
        </div>
    </div>
    <!--Main Container-->


<!--MODAL SELECT-->
<div id="dataModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Informasi Pasien</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="detail-pasien">
         </div>
         <div class="modal-footer">
            <button class="btn btn-default" type="button" data-dismiss="modal">Tutup</button>
         </div>
       </div>
    </div>
</div>

<div id="dataModalWali" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Informasi Wali</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="detail-wali">
         </div>
         <div class="modal-footer">
            <button class="btn btn-default" type="button" data-dismiss="modal">Tutup</button>
         </div>
       </div>
    </div>
</div>

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
       <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Peringatan!</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="detail-pasien">
            <h5>Apakah anda yakin ingin menghapus data ini?</h5>
            <p class="font-weight-light text-muted">*Data yang telah dihapus hanya dapat dikembalikan melalui basis data.</p>
         </div>
         <div class="modal-footer">
            <button class="btn btn-dark" type="button" data-dismiss="modal">Batal</button>
            <button id="hapusButton" class="btn btn-light" type="button" data-dismiss="modal">Hapus</button>
         </div>
       </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('.view-data-pasien').click(function(){
        let kode = $(this).attr("id");
        console.log(kode);
        $.ajax({
            url: 'select-pasien.php',
            method: 'post',
            data: {kode:kode},
            success:function(data){
                $('#detail-pasien').html(data);
                $('#dataModal').modal("show");
            }
        });
    });
});

$(document).ready(function(){
    $('.view-data-wali').click(function(){
        let kodeWali = $(this).attr("id");
        console.log(kodeWali);
        $.ajax({
            url:'select-wali.php',
            method:'post',
            data:{kodeWali:kodeWali},
            success:function(data){
                $('#detail-wali').html(data);
                $('#dataModalWali').modal("show");
            }
        });
    });
});

$(document).ready(function(){
    $('.alert-delete').click(function(){
        let kode = $(this).attr("id");
        console.log(kode);
        document.getElementById("hapusButton").onclick = function(){
            $.ajax({
                url:'hapus-pasien.php',
                method:'get',
                data: {kode:kode},
                success:function(data){
                    $("#"+kode).remove();
                    window.location.reload(true);
                }
            });
        }
        $('#deleteModal').modal("show");
    });
});

</script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   
</body>
</html>
