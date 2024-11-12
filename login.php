<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri Photo</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body {
        background-image: url('https://t3.ftcdn.net/jpg/04/03/02/92/360_F_403029269_KCrGHt5AdtV7GSD2KeP8Wk2PYIbVKlNU.jpg');
        background-size: cover;      
        background-position: center;   
        background-repeat: no-repeat;  
      }

      .navbar-custom {
        background-image: url('https://t3.ftcdn.net/jpg/04/03/02/92/360_F_403029269_KCrGHt5AdtV7GSD2KeP8Wk2PYIbVKlNU.jpg'); 
        background-size: cover;
        background-position: center;
      }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Website Galeri Photo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <!-- Tambahkan navigasi tambahan di sini jika diperlukan -->
      </div>
      <a href="register.php" class="btn btn-outline-primary m-1">Daftar</a>
      <a href="login.php" class="btn btn-outline-primary m-1">Masuk</a>
    </div>
  </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body bg-light">
            <div class="text-center">
              <h5>Login Aplikasi Galeri Photo</h5>
              <br>
              <img src="assets/img/images-removebg-preview-removebg-preview.png" class="circle">
              <br><br>
            </div>
            <form action="config/aksi_login.php" method="POST">
              <label class="form-label">Username</label>
              <input type="text" name="username" class="form-control" required>
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
              <div class="d-grid mt-2">
                <button class="btn btn-success" type="submit" name="kirim">Masuk</button>
              </div>
            </form>
            <hr>
            <p>Belum punya akun? <a href="register.php">Daftar di sini!</a></p>
          </div>
        </div>
      </div>
    </div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; UKK PPLG 2024 | Djuto Febrian Pratama</p>
</footer>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
