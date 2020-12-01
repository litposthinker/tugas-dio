<?php
require 'koneksi.php';
$kategori = query("SELECT kategori FROM data_barang");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = query("SELECT * FROM data_barang WHERE kode ='$id'");
    $data = $data[0];
}
if (isset($_POST['submit'])) {
    
        if (edit($_POST)>0) {
            header('Location: index.php');
        }else{
            header('Location: edit.php?error');
        }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="test1.css">
</head>

<body>
    <div class="container w-50 text-center mt-2" style="background-color: rgb(231, 76, 60);">
        <!-- form -->
        <h3 class="text-white pt-2">FORM INPUT MASTER dan STOCK DATA BARANG</h3>
        <form action="" method="post">
            <input type="hidden" name="kode" value="<?= $id ?>">
            <div class="form-box text-left">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Kode Produk</span>
                    </div>
                    <input type="text" class="form-control" placeholder="SM-00" value="<?= $data['kode'] ?>" disabled id="kodeproduk1">
                    <input type="text" class="form-control" name="kodeedit" placeholder="SM-00" value="<?= $data['kode'] ?>" hidden id="kodeproduk">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Nama Produk</span>
                    </div>
                    <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" placeholder="Nama Produk e.g Jus Mangga" id="namaproduk">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Harga Produk</span>
                    </div>
                    <input type="text" class="form-control" name="harga" value="<?= $data['harga'] ?>" placeholder="Rp 10.000" maxlength="50" id="hargaproduk" autocomplete="off">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Satuan</span>
                    </div>
                    <input autocomplete="off" type="text" class="form-control" name="satuan" value="<?= $data['satuan'] ?>" placeholder="pilih satuan" maxlength="50" list="satuan" id="satuanproduk">
                    <datalist id="satuan">
                        <option>Gelas</option>
                        <option>piring</option>
                        <option>pcs</option>
                    </datalist>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">kategori</span>
                    </div>
                    <input type="text" class="form-control" name="kategori" value="<?= $data['kategori'] ?>" placeholder="pilih kategori" maxlength="25" list="kategori" id="kategoriproduk" onchange="kodeprodukChange(this.value)">
                    <datalist id="kategori">
                        <option>Minuman Dingin</option>
                        <option>Minuman Hangat</option>
                        <option>Snack</option>
                        <option>Makanan</option>
                    </datalist>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">URL Gambar</span>
                    </div>
                    <input type="text" class="form-control" name="gambar" value="<?= $data['gambar'] ?>" placeholder="Jus/Mangga.jpeg" id="urlproduk" autocomplete="off">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Stock Awal</span>
                    </div>
                    <input type="number" class="form-control" name="stock" value="<?= $data['stock'] ?>" value="1" id="stockproduk" autocomplete="off" min="1">
                </div>
                <a href="index.php"><button type="button" class="btn btn-dark mb-4">Cancel</button></a>
                <button type="submit" name="submit" class="btn btn-light mb-4">simpan</button>
            </div>
        </form>
        <!-- form selesai -->
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="test1.js"></script>
    <script>
        var data = []
        <?php foreach ($kategori as $ktg => $value) : ?>
            data.push("<?= $value['kategori'] ?>")
        <?php endforeach; ?>

        function kodeprodukChange(value) {
            var kode = []
            var strkode = value.split(/(\s+)/).filter(function(e) {
                return e.trim().length > 0;
            });
            for (i = 0; i < strkode.length; i++) {
                if (strkode.length == 1) {
                    code = strkode[i].slice(0, 2)
                } else {
                    code = strkode[i].slice(0, 1)
                }
                kode.push(code)
            }
            var kodepro = kode.join("")
            kodepro = kodepro.toUpperCase()
            if (kode.length == 0) {
                document.getElementById("kodeproduk").value = ''
                document.getElementById("kodeproduk1").value = ''
            } else {
                var count = 1;
                for (var i = 0; i < data.length; ++i) {
                    if (data[i].toLowerCase() === value.toLowerCase())
                        count++;
                }
                if (count < 10) {
                    document.getElementById("kodeproduk").value = kodepro + '-00' + count
                    document.getElementById("kodeproduk1").value = kodepro + '-00' + count
                } else if (count < 100) {
                    document.getElementById("kodeproduk").value = kodepro + '-0' + count
                    document.getElementById("kodeproduk1").value = kodepro + '-0' + count
                } else {
                    document.getElementById("kodeproduk").value = kodepro + '-' + count
                    document.getElementById("kodeproduk1").value = kodepro + '-' + count
                }
            }
        }
    </script>
</body>

</html>