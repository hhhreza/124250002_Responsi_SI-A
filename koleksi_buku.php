<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION ['status']) || $_SESSION ['status'] != "login"){
    header("Location: login.php?pesan= logindulu");
    exit();
}

if(isset($_POST['tambah'])){
    $id = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $kategori = $_POST['kategori'];
    $stok=$_POST['stok'];
     $status = $_POST['status'];

     $query= "INSERT INTO pinjam (id_buku, judul, penulis, kategori,stok, status) VALUES ('$id', '$judul', '$penulis', '$kategori','$stok', '$status')";
     mysqli_query($koneksi, $query);
     header("Location: koleksi_buku.php");
     exit();
}

$result=mysqli_query($koneksi, "SELECT * FROM pinjam");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-body-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">PUSDIGIF</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
       <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="koleksi_buku.php">koleksi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="peminjaman.php">peminjaman</a>
        </li>
      </ul>
      <a href="logout.php"> <button class="btn btn-outline-light" type="submit">Logout</button></a>
      </form>
    </div>
  </div>
</nav>

<div class ="container mt-4">
    <h3 class="text-center">Koleksi Buku</h3>
    <div class="text-end mb-3">
        <button class ="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah"> Tambah Koleksi </button>
    </div>

    <table class ="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row=mysqli_fetch_assoc($result)){
                if($row['stok']==0){
                    $status="Habis";
                }else if ($row['stok']<=10){
                    $status="Menipis";
                } else {
                    $status="Tersedia";
                }
            ?>
                <tr>
                    <td><?= $row['id_buku'] ?></td>
                     <td><?= $row['judul'] ?></td>
                      <td><?= $row['penulis'] ?></td>
                       <td><?= $row['kategori'] ?></td>
                        <td><?= $row['stok'] ?></td>
                         <td><?= $status ?></td>
                         <td>
                            <a href="edit.php?id=<?= $row['id_buku'] ?>" class = "btn btn-success bt-sm">Edit</a>
                            <a href="koleksi_buku.php?hapus=<?= $row['id_buku'] ?>" class = "btn btn-waring bt-sm" onclick="return confirm ('Yakin?')">Hapus</a>
                         </td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
</div>

<div class="modal" id="modalTambah" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
       <div class="row">
        <div class = "col-md-6 mb-3">
            <label> Kode Buku </label>
            <input type="text" name="kode_buku" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
      </div>
    </div>
  </div>
</div>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>