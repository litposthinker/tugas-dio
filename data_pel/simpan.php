<?php
include 'koneksi.php';
if(isset($_POST['simpan'])){
    $id_pel = $_POST['id_pelanggan'];
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $tlp = $_POST['telepon'];
    $email = $_POST['email'];
    
    $sql = "INSERT INTO pelanggan (id_pelanggan, nama_pelanggan, alamat, telepon, email) VALUES ('$id_pel','$nama','$alamat','$tlp','$email')";
    $query = mysqli_query($connect, $sql);

    if($query){
        header('Location: tampil.php');
    }else{
        header('Location: simpan.php?status=gagal');
    }
    }
?>