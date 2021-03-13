<?php
require 'koneksi.php';

$barang = query("SELECT GROUP_CONCAT(barang.nama) AS nama, GROUP_CONCAT(barang.harga) AS harga, GROUP_CONCAT(semuaid.stock) AS stock, history.jumlah_harga AS jumlah, history.created_at AS tanggal 
FROM belibarang AS semuaid 
INNER JOIN stockbarang AS barang 
ON semuaid.barang_id = barang.id 
INNER JOIN historybarang as history 
ON semuaid.history_id = history.id
GROUP BY history.created_at
");

date_default_timezone_set('Asia/Jakarta');
setlocale(LC_ALL, 'IND');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>History | Starbhak Market</title>
    <link rel="shortcut icon" href="/asset/Starbhak.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="design2.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="">Starbhak Market</a>
        <div class="dropdown show">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                History
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="history.php">History</a>
                <a class="dropdown-item" href="admin.php">Admin</a>
                <a class="dropdown-item" href="index.php">User</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid mt-5 w-75">
        <div class="row d-flex justify-content-center">
            <table id="example" class="display stripe dataTable text-capitalize" style="width:100%" aria-describedby="example_info" role="grid">
                <thead class="bg-primary text-white">
                    <tr role="row">
                        <th>No</th>
                        <th>nama</th>
                        <th>stock beli</th>
                        <th>harga beli</th>
                        <th>jumlah harga</th>
                        <th>tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($barang as $brg) :
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $brg['nama'] ?></td>
                            <td><?= $brg['stock'] ?></td>
                            <td>
                                <?php
                                $harga = explode(',', $brg['harga']);
                                $data = array();
                                foreach ($harga as $hrg) {
                                    array_push($data, rupiah($hrg));
                                }
                                echo join(',', $data);
                                ?>
                            </td>
                            <td><?= rupiah($brg['jumlah']) ?></td>
                            <td><?= strftime('%e %B %G, %H:%M:%S', strtotime($brg['tanggal'])) ?></td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "dom": 'rt<"bottom d-flex justify-content-between pt-2"ilp>'
            })
        });
    </script>
</body>

</html>