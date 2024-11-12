<?php
// include'koneksi.php';
// $username = $_POST['username'];
// $password = $_POST['password'];
// $email = $_POST['email'];
// $nama_lengkap = $_POST['nama_lengkap'];
// $alamat = $_POST['alamat'];

// $query = "INSERT INTO user (username,password,email,nama_lengkap,alamat) VALUES ('$username','$$password','$$email','$nama_lengkap','$alamat')";
// $sql = mysqli_query($koneksi, $query);
    
// if ($sql){
//     echo "<script>
//     alert('pendaftaran akun berhasil');
//     location.href='../login.php';
//     </script>";
// } else {
// echo '<script>alert("Gagal: '. mysqli_error(mysql:$koneksi).' "); location.href="register.php"</script>';
// }

session_start();
include 'koneksi.php';

// Ambil data username dan password dari form registrasi
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Query untuk menyimpan pengguna baru ke database
$query = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";
$sql = mysqli_query($koneksi, $query);

if ($sql) {
    echo "<script>
    alert('Registrasi berhasil! Silakan login.');
    location.href='../login.php';
    </script>";
} else {
    echo "<script>
    alert('Registrasi gagal. Silakan coba lagi.');
    location.href='../register.php';
    </script>";
}
?>
