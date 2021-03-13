<?php
require 'koneksi.php';
$barang = query("SELECT * FROM stockbarang WHERE NOT IsDeleted = 1");
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="">Starbhak Market</a>
        <div class="dropdown show">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Admin
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="history.php">History</a>
                <a class="dropdown-item" href="admin.php">Admin</a>
                <a class="dropdown-item" href="index.php">User</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col d-flex justify-content-center mb-3">
                <a href="tambahbarang.php" class="mr-5">
                    <button class="btn btn-secondary">
                        [+] Tambah Barang
                    </button>
                </a>
                <div class="input-group w-25 ml-5">
                    <input type="text" id="searchdata" class=" form-control border-right-0 shadow-none" placeholder="Cari nasi goreng">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"></path>
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center mb-3">
            <table id="example" class="display dataTable text-capitalize" style="width:100%" aria-describedby="example_info" role="grid">
                <thead class="bg-primary text-white">
                    <tr role="row">
                        <th>No</th>
                        <th>gambar</th>
                        <th>nama</th>
                        <th>jenis</th>
                        <th>stock</th>
                        <th>harga</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($barang as $brg) :
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><img style="width: 100px;height: 100px !important;object-fit: cover;" src="<?= $brg['gambar'] ?>" alt=""></td>
                            <td><?= $brg['nama'] ?></td>
                            <td><?= $brg['jenis'] ?></td>
                            <td class="<?= ($brg['stock'] <= 5) ? 'bg-danger text-white' : ''; ?>"><?= $brg['stock'] ?></td>
                            <td><?= rupiah($brg['harga']) ?></td>
                            <td>
                                <a href="edit.php?id=<?= $brg['id'] ?>"><button class="btn btn-warning mr-1">Edit</button></a>
                                <button class="btn btn-danger" onclick="confirmDelet(<?= $brg['id'] ?>)">hapus</button>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    endforeach;
                    ?>
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
        function confirmDelet(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this product!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your imaginary product has been deleted.',
                        icon: 'success',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "hapus.php?id=" + id;
                        }
                    })

                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'Your imaginary product is safe :)',
                        'error'
                    )
                }
            })
        }

        $(document).ready(function() {
            var table = $('#example').DataTable({
                "paging": true,
                "lengthChange": true,
                responsive: true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "dom": 'rt<"bottom d-flex justify-content-between pt-2"ilp>'
            })
            $('#searchdata').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
</body>

</html>