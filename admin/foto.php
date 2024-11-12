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
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
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
            <div class="card-header">Tambah Foto</div>
             <div class="card-body">
                <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                    <label class="form-label">Judul foto</label>
                    <input type="text" name="judul_foto" class="form-control" required>
                    <label class="form-label">Deskripsi foto</label>
                    <textarea class="form-control" name="deskripsi_foto" required></textarea>
                    
                    <!-- tambah album -->
                    <label class="form-label">Album</label>
                    <select class="form-control" name="id_album" required>
                        <?php
                        $id_user = $_SESSION['id_user'];
                        $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE id_user='$id_user'");
                        while($data_album = mysqli_fetch_array($sql_album)) { ?>
                        <option value="<?php echo $data_album['id_album'] ?>"><?php echo $data_album['nama_album'] ?></option>
                       <?php } ?>
                    </select>
                    
                    <!-- Tambah foto -->
                    <label class="form-label">File</label>
                    <input type="file" class="form-control" name="lokasifile" required>
                    <button type="submit" class="btn btn-primary mt-2" name="tambah">Tambah Data</button>
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
                                <th>Foto</th>
                                <th>Judul Foto</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Buat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT * FROM foto WHERE id_user='$id_user'");
                                while($data = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><img src="../assets/img/<?php echo $data['lokasi_foto'] ?>" width="100"></td>
                                <td><?php echo $data['judul_foto']?></td>
                                <td><?php echo $data['deskripsi_foto']?></td>
                                <td><?php echo $data['tanggal_unggah']?></td>
                                <td>
                                    <!-- Button Edit Foto -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['id_foto']?>">Edit</button>
                                    <div class="modal fade" id="edit<?php echo $data['id_foto']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="id_foto" value="<?php echo $data['id_foto'] ?>">
                                                <label class="form-label">Judul Foto</label>
                                                <input type="text" name="judul_foto" value="<?php echo $data['judul_foto'] ?>" class="form-control" required>
                                                <label class="form-label">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi_foto" required><?php echo $data['deskripsi_foto'] ?></textarea>
                                                
                                                <label class="form-label">Album</label>
                                                <select class="form-control" name="id_album">
                                                    <?php
                                                    $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE id_user='$id_user'");
                                                    while($data_album = mysqli_fetch_array($sql_album)) { ?>
                                                    <option <?php if($data_album['id_album'] == $data['id_album']) echo 'selected'; ?> value="<?php echo $data_album['id_album'] ?>"><?php echo $data_album['nama_album'] ?></option>
                                                   <?php } ?>
                                                </select>
                                                
                                                <label class="form-label">Foto</label>
                                                <div class="row">
                                                  <div class="col-md-4">
                                                    <img src="../assets/img/<?php echo $data['lokasi_foto'] ?>" width="100">
                                                  </div>
                                                  <div class="col-md-8">
                                                    <label class="form-label">Ganti File</label>
                                                    <input type="file" class="form-control" name="lokasi_foto">
                                                  </div>
                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    
                                    <!-- Button Delete Foto -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['id_foto']?>">Hapus</button>
                                    <div class="modal fade" id="hapus<?php echo $data['id_foto']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <form action="../config/aksi_foto.php" method="POST">
                                                <input type="hidden" name="id_foto" value="<?php echo $data['id_foto'] ?>">
                                                Apakah Anda yakin akan menghapus <strong><?php echo $data['judul_foto'] ?></strong>?
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" name="hapus" class="btn btn-danger">Hapus Data</button>
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
