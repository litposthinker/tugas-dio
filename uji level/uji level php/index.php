<?php
require 'koneksi.php';
$barang = query("SELECT * FROM data_barang");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>starbhak market</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="test1.css">
</head>

<body>
    <!-- tabel -->
    <div class="container-sm">
        <!-- dropdown -->
        <a href="tambah.php">
            <div class="dropdown text-center">
                <span id="span1"></span><span id="span2"></span>
            </div>
        </a>
        <!-- dropdown selesai -->
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga Produk</th>
                    <th scope="col">Satuan Produk</th>
                    <th scope="col">Kategori Produk</th>
                    <th scope="col">Stock Produk</th>
                    <th scope="col">Gambar Produk</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="text-center pt-4">
                <?php $i = 1;
                foreach ($barang as $brg) : ?>
                    <tr>
                        <th> <?= $i++ ?> </th>
                        <td> <?= $brg['kode'] ?> </td>
                        <td> <?= $brg['nama'] ?> </td>
                        <td> <?= $brg['harga'] ?> </td>
                        <td> <?= $brg['satuan'] ?> </td>
                        <td> <?= $brg['kategori'] ?> </td>
                        <td> <?= $brg['stock'] ?> </td>
                        <td> <img src='<?= $brg["gambar"] ?>'> </td>
                        <td>
                            <a href="edit.php?id=<?= $brg['kode'] ?>"><button class="btn btn-warning mr-1" onclick="edit(i)">Edit</button></a>
                            <a href="hapus.php?id=<?= $brg['kode'] ?>"><button class="btn btn-danger" onclick="return confirm(' Yakin ingin menghapus?')">hapus</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- tabel selesai -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="test1.js"></script>

</body>

</html>