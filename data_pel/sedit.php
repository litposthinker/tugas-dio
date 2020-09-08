<?php
include 'koneksi.php';
if (isset($_POST['simpan'])) {
    $id_pel = $_POST['id_pelanggan'];
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $tlp = $_POST['telepon'];
    $email = $_POST['email'];
    
    $sql = "UPDATE pelanggan SET nama_pelanggan ='$nama', alamat='$alamat', telepon='$tlp', email='$email' WHERE id_pelanggan ='$id_pel'";
    
    $query = mysqli_query($connect, $sql);
    if($query){
        header('Location: tampil.php');
    }else{
        header('Location: sedit.php?status=gagal');
    }
}
?>