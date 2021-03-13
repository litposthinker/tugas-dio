<?php
require 'koneksi.php';
session_start();
$barang = query("SELECT * FROM stockbarang WHERE NOT IsDeleted = 1");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Menu | Starbhak Market</title>
    <link rel="stylesheet" href="design.css">
    <link rel="shortcut icon" href="/asset/Starbhak.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/73d4cbd542.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript">
    </script>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="">Starbhak Market</a>
        <p class="marquee">
            <span>
                uji level tahap 3 [selesai] | bot spam python [need class] | bot discord python [need more features] | laravel presensi [ongoing] | titanic ML [ongoing] | data mining WA [need features to count if interest in chat] |
            </span>
        </p>
    </nav>
    <!-- Modal animasi -->
    <!-- <div class="modal fade" id="animatedberhasil" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalsucces" class="center text-center">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">no</th>
                                    <th scope="col">nama</th>
                                    <th scope="col">harga</th>
                                    <th scope="col">jumlah</th>
                                    <th scope="col">total</th>
                                </tr>
                            </thead>
                            <tbody id="table-bayar">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- akhir dari modal animasi -->
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-3 pr-2">
                <div class="form-group">
                    <select class="form-control shadow-none" id="order">
                        <option selected>Take Away</option>
                        <option>Dine In</option>
                    </select>
                </div>
                <div class="mt-3 mb-3 text-center">
                    <i class="fas fa-user-ninja"></i>
                    Impostor
                </div>
                <!-- keranjang -->
                <div class="border keranjang">
                    <div class="row ml-1 mr-1 pb-1 text-capitalize" id="keranjang">
                        <?php $krjgindex = 1;
                        foreach ($_SESSION as $keysesi => $valsesi) :
                            $keysesinew = explode("brg", $keysesi)[1];
                            $keranjang = query("SELECT * FROM stockbarang WHERE id = '$keysesinew'");
                            foreach ($keranjang as $krj) :
                                (isset($total)) ?
                                    $total = $krj['harga'] * $valsesi + $total:
                                    $total = $krj['harga'] * $valsesi;
                                ?>
                                <div class="w-100 border mt-1">
                                    <div class="row mt-1">
                                        <div class="col"> <?= $krj['nama'] ?> </div>
                                        <div class="col-4">
                                            <?= rupiah($krj['harga'] * $valsesi) ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-4 mt-1">
                                                    <div>Unit Price:</div>
                                                </div>
                                                <div class="col-8">
                                                    <span>
                                                        <?= rupiah($krj['harga']) ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4 mt-1">
                                                    <div>Quantity:</div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn input-group-text" onclick="barangBerkurang( '<?= $keysesi ?>' )"><i class="fas fa-minus"></i></button>
                                                        </div>
                                                        <div class="inputan">
                                                            <input type="text" class="form-control text-center shadow-none" value="<?= $valsesi ?>" autocomplete="off" maxlength="2" onchange="ubahNilai( '<?= $keysesi ?>' ,this.value)">
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn input-group-text" onclick="tambahBarang( '<?= $keysesi ?>' )">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 ">
                                            <button class="btn shadow-none" onclick="deleteBasket( '<?= $keysesi ?>' )">
                                                <i class="far fa-trash-alt fa-2x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        <?php $krjgindex++;
                            endforeach;
                        endforeach; ?>
                    </div>
                </div>
                <!-- akhir dari keranjang -->
                <!-- total -->
                <div class="mt-2 total mb-2">
                    <div class="row">
                        <div class="col">Total:</div>
                        <div class="col-5">
                            <?php if (isset($total)) : $tax = $total * 0.10; ?>
                                <?= rupiah($total) ?>
                            <?php else : ?>
                                Rp 0
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">Discount:</div>
                        <div class="col-5">
                            <?php if (isset($total) && $total > 15000) : $discount = $total * 0.05; ?>
                                <?= rupiah($discount) ?>
                            <?php else : $discount = 0; ?>
                                Rp 0
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">Tax:</div>
                        <div class="col-5">
                            <?php if (isset($total)) : ?>
                                <?= rupiah($tax) ?>
                            <?php else : ?>
                                Rp 0
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row bg-primary text-white">
                        <div class="col">Total Amount:</div>
                        <div class="col-5" id="totalamount">
                            <?php if (isset($total)) : ?>
                                <?= rupiah($total + $tax - $discount) ?>
                            <?php else : ?>
                                Rp 0
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- akhir dari total -->
                <button class="btn btn-primary float-right w-50" disabled id="bayar" onclick="confirmPembayaran()">Membayar (<span>0</span>)</button>
                <!-- data-toggle="modal" data-target="#animatedberhasil" -->
            </div>
            <div class="col-9">
                <!-- pilihan -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control border-right-0 shadow-none" placeholder="Cari nasi goreng" oninput="reSearch(this.value)">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                            </svg>
                        </span>
                    </div>
                    <div class="jam text-right">

                    </div>
                </div>
                <!-- akhir pilihan -->
                <!-- main -->
                <div class="border mr-1 main">
                    <div class="row text-capitalize" id="main">
                        <?php $i = 1;
                        foreach ($barang as $brg) : ?>
                            <div class="card rounded <?= ($brg['stock'] < 1) ? 'bg-danger text-white' : '' ?> mb-2 ml-3 mr-1 mt-2 drag" id="brg<?= $brg['id'] ?>" onclick="tambahBarang(this.id)">
                                <img class="card-img-top" src="  <?= $brg['gambar'] ?>  ">
                                <div class="card-body text-center">
                                    <p class="card-title text-truncate"> <?= $brg['nama'] ?> </p>
                                    <p class="card-text <?= ($brg['stock'] < 1) ? 'text-white' : '' ?>">
                                        <?= rupiah($brg['harga']) ?>
                                    </p>
                                </div>
                            </div>
                        <?php $i++;
                        endforeach; ?>
                    </div>
                </div>
                <!-- end of main -->
                <div class="row mt-2 float-right">
                    <div class="dropdown show dropup">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            User
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="history.php">History</a>
                            <a class="dropdown-item" href="admin.php">Admin</a>
                            <a class="dropdown-item" href="index.php">User</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="test2.js"></script>
    <script script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    </script>
    <script>
        <?php if (isset($total)) : ?>
            if (<?= $total ?> > 0) {
                $('#bayar').prop('disabled', false)
                $('#bayar span').html(<?= $krjgindex - 1 ?>)
            } else {
                $('#bayar').prop('disabled', true)
                $('#bayar span').html('')
            }
        <?php endif; ?>
    </script>

</body>

</html>