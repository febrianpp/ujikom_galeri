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
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

<div class="container">
    <div class="row">
        <div class="col-md-4">
          <div class="card mt-2">
            <div class="card-header">Tambah Album</div>
             <div class="card-body">
                <form action="../config/aksi_album.php" method="POST">
                    <label class="form-label">Nama Album</label>
                    <input type="text" name="nama_album" class="form-control" required>
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" required></textarea>
                    <button type="submit" class="btn btn-success mt-2" name="tambah">Tambah Data</button>
                </form>
            </div>
          </div>
        </div>
        <div class="col-md-8">
            <div class="card mt-2">
                <div class="card-header">Data Album</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Album</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Buat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $id_user = $_SESSION['id_user'];
                                $sql = mysqli_query($koneksi, "SELECT * FROM album WHERE id_user='$id_user'");
                                while($data = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['nama_album']?></td>
                                <td><?php echo $data['deskripsi']?></td>
                                <td><?php echo $data['tanggal_buat']?></td>
                                <td>
                                    <!-- Button Edit Data -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['id_album']?>">Edit</button>
                                    <div class="modal fade" id="edit<?php echo $data['id_album']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <form action="../config/aksi_album.php" method="POST">
                                                <input type="hidden" name="id_album" value="<?php echo $data['id_album'] ?>">
                                                <label class="form-label">Nama Album</label>
                                                <input type="text" name="nama_album" value="<?php echo $data['nama_album'] ?>" class="form-control" required>
                                                <label class="form-label">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi" required><?php echo $data['deskripsi'] ?></textarea>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- Button Delete Data -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['id_album']?>">Hapus</button>
                                    <div class="modal fade" id="hapus<?php echo $data['id_album']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <form action="../config/aksi_album.php" method="POST">
                                                <input type="hidden" name="id_album" value="<?php echo $data['id_album'] ?>">
                                                Apakah anda yakin akan menghapusnya <strong><?php echo $data['nama_album'] ?></strong> ?
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" name="hapus" class="btn btn-primary">Hapus data</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; UKK PPLG 2024 | Djuto Febrian Pratama</p>
</footer>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
