<?php
require 'koneksi.php';

if (isset($_POST['submit'])) {
    (tambahanggota($_POST) > 0) ?
        header('Location: admin.php') :
        header('Location: tambah.php?error');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Menu | Starbhak Market</title>
    <link rel="shortcut icon" href="/asset/Starbhak.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="design2.css">

</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="">Starbhak Market</a>
        <div class="dropdown show">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Admin
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="admin.php">Admin</a>
                <a class="dropdown-item" href="index.php">User</a>
            </div>
        </div>
    </nav>
    <div class="container w-50 text-center mt-2" style="background-color: rgb(231, 76, 60);">
        <!-- form -->
        <h3 class="text-white pt-2">FORM INPUT DATA BARANG</h3>
        <form action="" method="post">
            <div class="form-box text-left">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Nama Produk</span>
                    </div>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Produk e.g Jus Mangga" id="namaproduk">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Harga Produk</span>
                    </div>
                    <input type="text" class="form-control" name="harga" placeholder="Rp 10.000" maxlength="50" id="hargaproduk" autocomplete="off">
                </div>


                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">kategori</span>
                    </div>
                    <input type="text" class="form-control" autocomplete="off" name="kategori" placeholder="pilih kategori" maxlength="25" list="kategori" id="kategoriproduk" onchange="kodeprodukChange(this.value)">
                    <datalist id="kategori">
                        <option>Minuman</option>
                        <option>Makanan</option>
                    </datalist>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">URL Gambar</span>
                    </div>
                    <input type="text" class="form-control" name="gambar" placeholder="Jus/Mangga.jpeg" id="urlproduk" autocomplete="off">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Stock Awal</span>
                    </div>
                    <input type="number" class="form-control" name="stock" value="1" id="stockproduk" autocomplete="off" min="1">
                </div>
                <a href="admin.php"><button type="button" class="btn btn-dark mb-4">Cancel</button></a>
                <button type="submit" name="submit" class="btn btn-light mb-4">simpan</button>
            </div>
        </form>
        <!-- form selesai -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

    <script>
        var rupiah = document.getElementById("hargaproduk");
        rupiah.addEventListener("keyup", function(e) {
            rupiah.value = formatDollar(this.value, "Rp ");
        });

        /* Fungsi formatRupiah */
        function formatDollar(angka, prefix = "Rp ") {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = (sisa) ? ".":"";
                rupiah += separator + ribuan.join(".");
            }

            if (split[1] != undefined) {
                rupiah = rupiah + "," + split[1]
            }

            if (prefix == undefined) {
                prefix = rupiah
            } else if (rupiah) {
                prefix = "Rp " + rupiah
            } else {
                prefix = ""
            }
            return prefix
        }
    </script>
</body>

</html>