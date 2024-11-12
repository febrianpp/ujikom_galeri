<?php
    session_start(); 
    require_once("koneksi.php");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Add new photo
    if (isset($_POST['tambah'])) {
        $judul_foto = mysqli_real_escape_string($koneksi, $_POST['judul_foto']);
        $deskripsi_foto = mysqli_real_escape_string($koneksi, $_POST['deskripsi_foto']);
        $tanggal_unggah = date('Y-m-d');
        $id_album = $_POST['id_album'];
        $id_user = $_SESSION['id_user'];
        $foto = $_FILES['lokasi_foto']['name'];
        $tmp = $_FILES['lokasi_foto']['tmp_name'];
        $lokasi = '../assets/img/';
        $namafoto = rand() . '-' . $foto;
    
        // Cek apakah file ada dan valid
        if ($_FILES['lokasi_foto']['error'] === 0) {
            // Cek apakah direktori upload ada dan memiliki izin yang benar
            if (move_uploaded_file($tmp, $lokasi . $namafoto)) {
                // Query untuk menyimpan data ke database
                $query = "INSERT INTO foto (judul_foto, deskripsi_foto, tanggal_unggah, lokasi_foto, id_album, id_user) 
                          VALUES ('$judul_foto', '$deskripsi_foto', '$tanggal_unggah', '$namafoto', '$id_album', '$id_user')";
    
                // Eksekusi query dan cek apakah berhasil
                if (mysqli_query($koneksi, $query)) {
                    echo "<script>
                        alert('Data berhasil disimpan');
                        location.href='../admin/foto.php';
                    </script>";
                } else {
                    // Tampilkan pesan error jika query gagal
                    echo "<script>
                        alert('Gagal menyimpan data ke database: " . mysqli_error($koneksi) . "');
                    </script>";
                }
            } else {
                // Menampilkan pesan error jika gagal mengunggah foto
                echo "<script>
                    alert('Gagal mengunggah foto');
                </script>";
            }
        } else {
            // Menampilkan pesan error jika file tidak valid
            echo "<script>
                alert('Terjadi kesalahan saat mengunggah file: " . $_FILES['lokasi_foto']['error'] . "');
            </script>";
        }
    }
    

    // Edit photo
    if (isset($_POST['edit'])) {
        $id_foto = $_POST['id_foto'];
        $judul_foto = mysqli_real_escape_string($koneksi, $_POST['judul_foto']);
        $deskripsi_foto = mysqli_real_escape_string($koneksi, $_POST['deskripsi_foto']);
        $tanggal_unggah = $_POST['tanggal_unggah'];
        $id_album = $_POST['id_album'];

        if ($_FILES['lokasi_foto']['name'] != "") {
            $foto = $_FILES['lokasi_foto']['name'];
            $tmp = $_FILES['lokasi_foto']['tmp_name'];
            $lokasi = '../assets/img/';
            $namafoto = rand() . '-' . $foto;

            if (move_uploaded_file($tmp, $lokasi . $namafoto)) {
                $query = "UPDATE foto SET 
                            judul_foto = '$judul_foto', 
                            deskripsi_foto = '$deskripsi_foto', 
                            tanggal_unggah = '$tanggal_unggah', 
                            lokasi_foto = '$namafoto', 
                            id_album = '$id_album' 
                          WHERE id_foto = '$id_foto'";
            } else {
                echo "<script>alert('Gagal mengunggah file baru');</script>";
            }
        } else {
            $query = "UPDATE foto SET 
                        judul_foto = '$judul_foto', 
                        deskripsi_foto = '$deskripsi_foto', 
                        tanggal_unggah = '$tanggal_unggah', 
                        id_album = '$id_album' 
                      WHERE id_foto = '$id_foto'";
        }

        if (mysqli_query($koneksi, $query)) {
            echo "<script>
                    alert('Foto berhasil diubah');
                    window.location.href = '../admin/foto.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal mengubah foto');
                    window.location.href = '../admin/foto.php';
                  </script>";
        }
    }

    // Delete photo
    if (isset($_POST['hapus'])) {
        $id_foto = $_POST['fotoid'];
        $lokasi = '../assets/img/';

        $query = mysqli_query($koneksi, "SELECT lokasi_foto FROM foto WHERE id_foto = '$id_foto'");
        $data = mysqli_fetch_assoc($query);

        if (is_file($lokasi . $data['lokasi_foto'])) {
            unlink($lokasi . $data['lokasi_foto']);
        }

        $deleteQuery = "DELETE FROM foto WHERE id_foto = '$id_foto'";
        
        if (mysqli_query($koneksi, $deleteQuery)) {
            echo "<script>
                    alert('Foto berhasil dihapus');
                    window.location.href = '../admin/foto.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menghapus foto');
                    window.location.href = '../admin/foto.php';
                  </script>";
        }
    }
?>
