<?php
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location:./auth/login.php");
        exit;
    }
    require 'function.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<body>

    <!--Navbar-->
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">SI Rumah Sakit</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search" hidden>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <!--TODO: GANTI HREF NYA!-->
            <a class="nav-link" href="./auth/logout.php">Keluar</a>
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
                            <!--TODO: GANTI HREF NYA! -->
                            <a href="index.php" class="nav-link active">
                                <i class="fas fa-tachometer-alt mr-1"></i>
                                Dashboard
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <!--TODO: GANTI HREF NYA! -->
                            <a href="./pasien/pasien.php" class="nav-link">
                                <i class="fas fa-user-injured mr-1"></i>
                                &nbsp;Pasien
                            </a>
                        </li>
                        <li class="nav-item">
                            <!--TODO: GANTI HREF NYA! -->
                            <a href="./wali/wali.php" class="nav-link">
                                <i class="fas fa-user-shield mr-1"></i>
                                Wali
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4" role="main">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>
                <!--TODO: INSERT COUNT PASIEN DAN WALI-->
                <div class="row my-4">
                    <div class="col-md-6 col-sm-6">
                        <div class="layer border bg-white p-2">
                            <div class="layer mb-2 w-100 text-center border-bottom"><h2 class="h6" style="color:#777">Pasien</h2></div>
                            <div class="layer w-100 text-center"><h1><span>
                                <?php 
                                    $sql = "SELECT COUNT(*) AS 'count' FROM pasien WHERE flag_active = 'y'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['count'];
                                ?>
                            </span></h1></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="layer border bg-white p-2">
                            <div class="layer mb-2 w-100 text-center border-bottom"><h2 class="h6" style="color:#777">Wali</h2></div>
                            <div class="layer w-100 text-center"><h1><span>
                                <?php 
                                    $sql = "SELECT COUNT(*) AS 'count' FROM pasien";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['count'];
                                ?>
                            </span></h1></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Grafik</h1>
                </div>
                <!--TODO: INSERT CHART -->
                <?php
                    $sqlMonday = "SELECT COUNT(*) jumlah FROM pasien WHERE DAYNAME(created_at) = 'Monday' AND flag_active = 'y'";
                    $sqlTuesday = "SELECT COUNT(*) jumlah FROM pasien WHERE DAYNAME(created_at) = 'Tuesday' AND flag_active = 'y'";
                    $sqlWednesday = "SELECT COUNT(*) jumlah FROM pasien WHERE DAYNAME(created_at) = 'Wednesday' AND flag_active = 'y'";
                    $sqlThursday = "SELECT COUNT(*) jumlah FROM pasien WHERE DAYNAME(created_at) = 'Thursday' AND flag_active = 'y'";
                    $sqlFriday = "SELECT COUNT(*) jumlah FROM pasien WHERE DAYNAME(created_at) = 'Friday' AND flag_active = 'y'";
                    $sqlSaturday = "SELECT COUNT(*) jumlah FROM pasien WHERE DAYNAME(created_at) = 'Saturday' AND flag_active = 'y'";
                    $sqlSunday = "SELECT COUNT(*) jumlah FROM pasien WHERE DAYNAME(created_at) = 'Sunday' AND flag_active = 'y'";

                    $resultSunday = mysqli_query($conn, $sqlSunday);
                    $resultMonday = mysqli_query($conn, $sqlMonday);
                    $resultTuesday = mysqli_query($conn, $sqlTuesday);
                    $resultWednesday = mysqli_query($conn, $sqlWednesday);
                    $resultThursday = mysqli_query($conn, $sqlThursday);
                    $resultFriday = mysqli_query($conn, $sqlFriday);
                    $resultSaturday = mysqli_query($conn, $sqlSaturday);

                    $rowMonday = mysqli_fetch_assoc($resultMonday);
                    $rowTuesday = mysqli_fetch_assoc($resultTuesday);
                    $rowWednesday = mysqli_fetch_assoc($resultWednesday);
                    $rowThursday = mysqli_fetch_assoc($resultThursday);
                    $rowFriday = mysqli_fetch_assoc($resultFriday);
                    $rowSaturday = mysqli_fetch_assoc($resultSaturday);
                    $rowSunday = mysqli_fetch_assoc($resultSunday);

                    $dataDay = array($rowSunday["jumlah"], $rowMonday["jumlah"], $rowTuesday["jumlah"], $rowWednesday["jumlah"], $rowThursday["jumlah"], $rowFriday["jumlah"], $rowSaturday["jumlah"]);

                ?>
                <!--TODO: GANTI CHART KE CHART.JS-->
                
                <canvas id="chartContainer" class="my-4 w-100" style="height:348px; display:block;"></canvas>

                <script>
                    let chartHari = document.getElementById('chartContainer').getContext('2d');
                    let displayChart = new Chart(chartHari, {
                        type:'line',
                        data:{
                            labels:['Minggu', 'Senin', 'Selasa','Rabu','Kamis','Jumat','Sabtu'],
                            datasets:[{
                                label:'Pasien',
                                data:<?php echo json_encode($dataDay, JSON_NUMERIC_CHECK);?>,
                                borderColor:['#4FA4F3'],
                                backgroundColor:['#4FA4F3'],
                                fill:false,
                                lineTension:0
                            }],
                            
                        },
                        options:{
                            responsive:true,
                            title:{
                                display:true,
                                text:'Jumlah Pasien Per Hari'
                            },
                            legend:{
                                position:'bottom'
                            },
                            tooltips:{
                                mode:'index',
                                intersect:false
                            },
                            hover:{
                                mode:'nearest',
                                intersect:true
                            },
                            scales:{
                                xAxes:[{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Hari'
                                    }
                                }],
                                yAxes:[{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Jumlah'
                                    }
                                }]
                            }
                        }
                    });
                </script>
                
            </main>
        </div>
    </div>
    <!--Main Container-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> 
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  
</body>
</html>