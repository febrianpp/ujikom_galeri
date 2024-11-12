<?php
// session_start();
// include 'koneksi.php';

// // Memastikan input diterima dengan aman
// $username = mysqli_real_escape_string($koneksi, $_POST['username']);
// $password = $_POST['password'];
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

// // Simpan $hashed_password ke database
// $query = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";
// $sql = mysqli_query($koneksi, $query);
// $data = mysqli_fetch_assoc($sql);

// if ($data) {
//     // Verifikasi password yang sudah di-hash
//     if (password_verify($password, $data['password'])) {
//         // Login berhasil, simpan data user ke session
//         $_SESSION['username'] = $username;
//         $_SESSION['status'] = 'login';
//         echo "<script>
//         alert('Login berhasil!');
//         location.href='../admin/index.php';
//         </script>";
//     } else {
//         // Jika password salah
//         echo "<script>
//         alert('Password salah!');
//         location.href='../login.php';
//         </script>";
//     }
// } else {
//     // Jika username tidak ditemukan
//     echo "<script>
//     alert('Username tidak ditemukan!');
//     location.href='../login.php';
//     </script>";
// }


session_start();
include 'koneksi.php';

// Ambil data username dan password dari form login
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

// Query untuk mencari pengguna berdasarkan username
$query = "SELECT * FROM user WHERE username='$username'";
$sql = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($sql);

// Setelah login berhasil
if ($data) {
    if (password_verify($password, $data['password'])) {
        // Login berhasil, simpan data user ke session
        $_SESSION['id_user'] = $data['id_user'];  // Tambahkan id_user ke session
        $_SESSION['status'] = 'login';
        $_SESSION['username'] = $username;

        echo "<script>
        alert('Login berhasil!');
        location.href='../admin/index.php';
        </script>";
    } else {
        // Jika password salah
        echo "<script>
        alert('Password salah!');
        location.href='../login.php';
        </script>";
    }
}


// if ($data) {
//     // Verifikasi password
//     if (password_verify($password, $data['password'])) {
//         // Jika password benar, simpan data ke session
//         $_SESSION['username'] = $username;
//         $_SESSION['status'] = 'login';
//         echo "<script>
//         alert('Login berhasil!');
//         location.href='../admin/index.php';
//         </script>";
//     } else {
//         // Jika password salah
//         echo "<script>
//         alert('Password salah!');
//         location.href='../login.php';
//         </script>";
//     }
// } else {
//     // Jika username tidak ditemukan
//     echo "<script>
//     alert('Username tidak ditemukan!');
//     location.href='../login.php';
//     </script>";
// }
?>







