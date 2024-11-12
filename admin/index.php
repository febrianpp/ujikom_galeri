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
  <div class="row">
    <?php
  $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.id_user=user.id_user INNER JOIN album ON foto.id_album=album.id_album");
while($data = mysqli_fetch_array($query)) {
?>

<div class="col-md-3">
<a type="button" data-bs-toggle="modal" data-bs-target="#komentar <?php echo $data['id_foto'] ?>"> 
        <div class="card mb-2">
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
                                              
           <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar 
           <?php echo $data['id_foto'] ?>"> <i class="fa-ragular fa-comment">
           </i> </a>
            <?php
            $jumlah_komentar = mysqli_query($koneksi, "SELECT * FROM komentar_foto WHERE id_foto='$id_foto'");
            echo mysqli_num_rows($jumlah_komentar). 'Komentar';
            ?>
          </div>
        </div>
        </a>
        <div class="modal fade" id="komentar <?php echo $data['id_foto'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
          <img src="../assets/img/<?php echo $data['lokasi'] ?>" class="card-img-top" title="<?php echo $data['judul_foto'] ?>">
          </div>
          <div class="col-md-4">
              <div class="mt-2">
                <div class="overflow-auto">
                  <div class="sticky-top">
                    <strong><?php echo $data['judul_foto'] ?></strong><br>
                    <span class ="badge bg-secondary"><?php echo $data['nama_lengkap'] ?></span>
                    <span class ="badge bg-secondary"><?php echo $data['tanggal_unggah'] ?></span>
                    <span class ="badge bg-primary"><?php echo $data['nama_album'] ?></span>
                  </div>
                  <hr>
                  <p align="left">
                    <?php echo $data['deskripsi_foto'] ?>
                  </p>
                  <hr>
                  <?php
                    $id_foto = $data['id_foto'];
                    $komentar = mysqli_query($koneksi, "SELECT * FROM komentar_foto INNER JOIN user ON komentar_foto.id_user=user.id_user WHERE komentar_foto.id_foto='$id_foto'");
                    while($row = mysqli_fetch_array($komentar)) {
                  ?>
                  <p align="left">
                    <strong><?php echo $row['nama_lengkap'] ?></strong>
                    <?php echo $row['isi_komentar'] ?>
                  </p>
                  <?php } ?>
                  <hr>
                  <div class="sticky-bottom">
                    <form action="../config/proses_komentar.php" method="POST">
                      <div class="input-group">
                        <input type="hyden" name="id_foto" value="<?php echo $data['id_foto'] ?>">
                        <input type="text" name="isi_komentar" class="form-control" placeholder="Tambah Komentar">
                        <div class="input-group-prepend">
                          <button type="submit" name="kirim komentar" class="btn bnt-outline-primary">Kirim</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      </div>
      <?php } ?>
  </div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 bg-light text-center">
    <p>&copy; UKK PPLG 2024 | Djuto Febrian Pratama</p>
</footer>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/js/bootscrapt.min.js"></script>
</body>
</html>