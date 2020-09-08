<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pelanggan</title>
</head>

<body>
    <h3>Data pelanggan</h3>
    <h4><a href="signup.html">[+] Tambah baru</a></h4>
    <table border='1'>
        <tr>
            <th>Id pelanggan</th>
            <th>Nama pelanggan</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>email</th>
            <th>Keterangan</th>
        </tr>

        <?php
            $sql ="SELECT * FROM pelanggan";
            $query =mysqli_query($connect,$sql);
            while($pel =mysqli_fetch_array($query)){
                echo "<tr>";
                echo "<td>".$pel['id_pelanggan']."</td>";
                echo "<td>".$pel['nama_pelanggan']."</td>";
                echo "<td>".$pel['alamat']."</td>";
                echo "<td>".$pel['telepon']."</td>";
                echo "<td>".$pel['email']."</td>";
                
                echo "<td>";
                echo "<a href='edit.php?id=".$pel['id_pelanggan']."'>Edit</a> | ";
                echo "<a href='hapus.php?id=".$pel['id_pelanggan']."'>Hapus</a> | ";
                
                
                echo"</td>";
                echo "</tr>";
            }
        ?>
</body>

</html>