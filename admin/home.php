<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login');
    location.href='../index.php';
    </script>";
    exit();
}

$id_user = $_SESSION['id_user'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri Photo</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootscrapt.min.css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <style>
       body {
        background-image: url('https://t3.ftcdn.net/jpg/04/03/02/92/360_F_403029269_KCrGHt5AdtV7GSD2KeP8Wk2PYIbVKlNU.jpg');
      background-size: cover;      
      background-position: center;   
      }
    </style>
  </head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php">Website Galeri Photo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
        <a href="home.php" class="nav-link">Home</a>
        <a href="album.php" class="nav-link">Album</a>
        <a href="foto.php" class="nav-link">Foto</a>
      </div>
      <a href="../config/aksi_logout.php" class="btn btn-outline-primary m-1">Keluar</a>
    </div>
  </div> 
</nav>
<div class="container mt-3">
    Album :
    <?php
    $album = mysqli_query($koneksi, "SELECT * FROM album WHERE id_user='$id_user'");
    while($row = mysqli_fetch_array($query)) { ?>
    <a href="home.php?id_album=<?php echo $row['id_album'] ?>" class = "btn btn-outline-primary" <?php echo $row['nama_album'] ?>></a>
    <?php } ?>
    <div class="row">
      <?php
        if(isset($_GET['id_album'])) {
            $id_album = $_GET['id_album'];
            $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE id_user='$id_user' AND id_album='$id_album'");
            while($data = mysqli_fetch_array($query)) { ?>
            <div class="col-md-3 mt-2">
        <div class="card">
          <img src="../assets/img/<?php echo $data['lokasi'] ?>" class="card-img-top" title="<?php echo $data['judul_foto'] ?>" style="height 12rem;">
          <div class="card-footer text-center">
            <?php
            $id_foto = $data['id_foto'];
            $cek_suka = mysqli_query($koneksi, "SELECT * FROM like_foto WHERE id_foto='$id_foto' AND id_user='$id_user'");
            if (mysqli_num_rows($cek_suka) == 1) { ?>
             <a href="../config/proses_like.php?id_foto=<?php echo $data['id_foto']?>" type="submit" name="batal_suka"><i class="fa fa-heart"></i></a>
            <?php }else { ?>
                <a href="../config/proses_like.php?id_foto=<?php echo $data['id_foto']?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
            <?php } 
            $like = mysqli_query($koneksi, "SELECT * FROM like_foto WHERE id_foto='$id_foto'");
            echo mysqli_num_rows($like) . 'Suka';
            ?>
            <a href=""><i class="fa-ragular fa-comment"></i></a>4 Komentar
          </div>
        </div>
      </div>

        <?php } }else { 
    
$query = mysqli_query($koneksi, "SELECT * FROM foto WHERE id_user='$id_user'");
while($data = mysqli_fetch_array($query)) {
?>
<div class="col-md-3 mt-2">
        <div class="card">
          <img src="../assets/img/<?php echo $data['lokasi'] ?>" class="card-img-top" title="<?php echo $data['judul_foto'] ?>" style="height 12rem;">
          <div class="card-footer text-center">
                                               <!-- Tambah Like --> 
            <?php
            $id_foto = $data['id_foto'];
            $cek_suka = mysqli_query($koneksi, "SELECT * FROM like_foto WHERE id_foto='$id_foto' AND id_user='$id_user'");
            if (mysqli_num_rows($cek_suka) == 1) { ?>
             <a href="../config/proses_like.php?id_foto=<?php echo $data['id_foto']?>" type="submit" name="batal_suka"><i class="fa fa-heart"></i></a>
            <?php }else { ?>
                <a href="../config/proses_like.php?id_foto=<?php echo $data['id_foto']?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
            <?php } 
            $like = mysqli_query($koneksi, "SELECT * FROM like_foto WHERE id_foto='$id_foto'");
            echo mysqli_num_rows($like) . 'Suka';
            ?>
                                               <!-- Tambah Comment -->
            <a href=""><i class="fa-ragular fa-comment"></i></a>4 Komentar
          </div>
        </div>
      </div>
<?php } } ?>
   </div>
 </div>
 

<footer class="d-flex justify-content-center border-to mt-3 bg-light fixed-bottom">
    <p>&copy; UKK PPLG 2024 | Djuto Febrian Pratama</p>
</footer>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/js/bootscrapt.min.js"></script>
</body>
</html>