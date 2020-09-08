<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    header('Location: tampil.php');
}
    $id_pel = $_GET['id'];
    
    $sql = "DELETE FROM pelanggan WHERE id_pelanggan ='$id_pel'";
    
    $query = mysqli_query($connect, $sql);
    
    if($query){
        header('Location: tampil.php');
    }else{
        header('Location: hapus.php?status=gagal');
    }
?>