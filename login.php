<?php
session_start();
include 'koneksi.php';

$pesan = "";

if(isset ($_POST ['login'])){
    $username = $_POST ['username'];
    $password = $_POST ['password'];

    if(empty($username) || empty($password)){
        $pesan = "kosong";
    }else{
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($koneksi, $query);

        if(mysqli_num_rows($result) > 0){
            $_SESSION['username']=$username;
            $_SESSION['status']="login";
            header("Location: index.php");
            exit();
        } else {
            $pesan = "gagal";
        }
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body bg-body-primary>
    
<div class="container mt-5 mb-5">
    <div class="card col-md-9 mx-auto p-4 shadow">
        <form action =" " method= "POST">
            <h2 class="text-center">LOGIN</h2>
            <h6>Sistem Perpustakaan</h6>

            <div class="mb-3">
                <label for ="username" class="form-label"> Username </label>
                    <input type="text" class="form-control" id ="username" name ="username">
            </div>
            <div class="mb-3">
                <label for ="password" class="form-label"> Password </label>
                    <input type="password" class="form-control" id ="password" name ="password">
            </div>
            <button type="submit" class= "btn btn-primary w-100" name ="login">Masuk</button>

        </form>
    </div>
</div>

</body>
</html>