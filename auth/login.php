<?php
    session_start();
    if(isset($_SESSION["login"])){
        header("Location: ../index.php");
        exit;
    }
    require '../function.php';
    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)===1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row["password"])){
                $_SESSION["login"] = true;
                header("Location:../index.php");
                exit;
            }
        }
        $error = true;
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
    <link rel="stylesheet" href="style.css">
    <title>Sistem Informasi Rumah Sakit</title>
</head>
<body class="text-center">
  <form action="login.php" class="form-signin" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Sistem Informasi Rumah Sakit</h1>
    <label for="inputUsername" class="sr-only">Username</label>
    <input class="form-control" type="text" name="username" id="inputUsername" placeholder="Username" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input class="form-control mb-3" type="password" name="password" id="inputPassword" placeholder="Password" requred autofocus>
    <?php if(isset($error)):?>
    <div class="alert alert-danger" role="alert">Username atau Password salah!</div>
    <?php endif;?>
    <button class="btn btn-md btn-outline-primary btn-block mb-2" type="submit" name="login">Masuk</button>
    <footer>&copy; XYZ Hospital. All Rights Reserved</footer>
  </form>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> 
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>