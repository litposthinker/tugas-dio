<?php
include 'koneksi.php';
    $id_pel = $_GET['id'];
    $sql = "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pel'";
    $query = mysqli_query($connect,$sql);
    $pel = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) < 1) {
        die("data tidak ditemukan");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
</head>

<body>
    <h3>Form edit pelanggan</h3>
    <form action="sedit.php" method="post">
        <input type="hidden" name="id_pelanggan" value="<?php echo $pel['id_pelanggan']?>">
        <p>
            <label>Nama Pelanggan : <input type="text" name="nama_pelanggan"
                    value="<?php echo $pel['nama_pelanggan']?>"></label>
        </p>
        <p>
            <label>Alamat : <input type="text" name="alamat" value="<?php echo $pel['alamat']?>"></label>
        </p>
        <p>
            <label>No Telepon : <input type="text" name="telepon" value="<?php echo $pel['telepon']?>"></label>
        </p>
        <p>
            <label>Email : <input type="text" name="email" value="<?php echo $pel['email']?>"></label>
        </p>
        <input type="submit" name="simpan" value="simpan">
    </form>
</body>

</html>