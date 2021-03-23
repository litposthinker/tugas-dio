<?php

require "template.php";

$data = query("SELECT * FROM tabel_anggota ORDER BY NAMA ASC");
$date = date('Y-m-d');

if (isset($_POST["simpan"])) {
    if (tambahanggota($_POST) > 0) {
        echo "
                 <script> 
                  Swal.fire({ 
                  title: 'BERHASIL',
                  text: 'Data Telah disimpan',
                  icon: 'success', buttons: [false, 'OK'], 
                  }).then(function() { 
                      window.location.href='anggota.php'; 
                  }); 
                 </script>
                ";
    } else {
        echo "
         <script> 
         Swal.fire({ 
            title: 'OOPS', 
            text: 'Data gagal ditambahkan', 
            icon: 'warning', 
            dangerMode: true, 
            buttons: [false, 'OK'], 
            }).then(function() { 
                window.location.href='anggota.php'; 
            }); 
         </script>
        ";
    }
}




?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>
    <div class="content-wrapper bg-white text-center pt-5">
        <section class="content-header">
            <div class="container-fluid pt-2">
                <ol class="breadcrumb p-1 float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Anggota</li>
                </ol>
            </div>
        </section>
        <!-- Content Header (Page header) -->
        <section class="content">
            <h3 class="mx-auto title-bold pt-2" style="width: 25rem;">DATA ANGGOTA</h3>
            <div class="container-fluid text-left">
                <div class="row mx-2">
                    <div class="col-md-5">
                        <!-- Tombol tambah data -->
                        <div class="btn-group">
                            <button type="button" class="tambah btn" href="#tambahanggota" style="background:#2E8B57; color:white;" data-toggle="modal" data-target="#tambahanggota"><i class="fa fa-user-plus"></i> Tambah Data</button>
                            <a href="kelas.php" class="btn mx-4 d-none" style="background:darkblue; color:white;"><i class="fa fa-users"></i> Data Kelas</a>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Search Data -->
                        <div class="mr-3">
                            <div class="input-group form-group">
                                <input id="searchdata" class="form-control border-right-0 shadow-none" placeholder="Masukkan Keyword Pencarian Data di sini..." autocomplete="off" type="text">
                                <div class="input-group-append">
                                    <button class="input-group-text btn button-primary" style="background:white;border-left:white;">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"></path>
                                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tabelanggota" class="dataTables_wrapper dt-bootstrap4 pb-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-striped table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <tr role="row" class="bg-dark text-white">
                                        <th class="sorting_asc" aria-controls="example2" rowspan="1" colspan="1">No.</th>
                                        <th class="sorting" aria-controls="example2" rowspan="1" colspan="1">No. Induk</th>
                                        <th class="sorting" aria-controls="example2" rowspan="1" colspan="1">Nama Anggota</th>
                                        <th class="sorting" aria-controls="example2" rowspan="1" colspan="1">Photo</th>
                                        <th width="10px">L/P</th>
                                        <th class="sorting" aria-controls="example2" rowspan="1" colspan="1">Kelas</th>
                                        <th>Terdaftar</th>
                                        <th width="140px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($data as $anggota) :
                                        $diff_tgl  = strtotime($anggota["TERDAFTAR"]);
                                        $terdaftar = date("d F Y", $diff_tgl);
                                        $id_sub = $anggota["id_sub"];
                                        $datasub = query("SELECT * FROM tabel_subject WHERE id_sub ='$id_sub' ");
                                    ?>
                                        <?php if ($i % 2 == 0) {
                                            echo '<tr role="row" class="even" >';
                                        } else {
                                            echo '<tr role="row" class="odd" >';
                                        }
                                        ?>
                                        <td class="text-center"><?= $i; ?></td>
                                        <td class="text-center"><?= $anggota["NO_INDUK"]; ?></td>
                                        <td><?= $anggota["NAMA"]; ?></td>
                                        <td><img class="text-center" style="width: 50px;" src="<?= $anggota["GAMBAR"]; ?>" alt=""></td>
                                        <td class="text-center"><?= $anggota["KELAMIN"]; ?></td>
                                        <?php
                                        if ($anggota["id_sub"] == 0) {
                                            echo '<td class="text-center text-danger">--No Subject--</td>';
                                        } else {
                                            foreach ($datasub as $subject) {
                                                echo '<td class="text-center">' . $subject["KELAS"] . '</td>';
                                            }
                                        }
                                        ?>
                                        <td class="text-center"><?= $terdaftar; ?></td>
                                        <td class="text-center">
                                            <a class="ubah btn btn-success btn-sm" href="ubahanggota.php?ID=<?= $anggota["ID"]; ?>"><i class="fa fa-edit"></i></a>
                                            <a class="hapus btn btn-danger btn-sm alert_hapus" href="hapus.php?ID=<?= $anggota["ID"]; ?>?>"><i class="fa fa-trash-alt"></i></a>
                                        </td>
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
    </div>

    <!-- Modal Tambah Anggota -->
    <div class="modal fade" id="tambahanggota" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title"><i class="fa fa-user-plus"></i> FORM TAMBAH ANGGOTA</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body bg-dark text-white">
                        <div class="form-group">
                            <input class="form-control bg-dark text-white" name="NO_INDUK" type="text" autocomplete="off" placeholder="Nomor Induk Pegawai" required><br>
                            <input class="form-control bg-dark text-white" name="NAMA" type="text" autocomplete="off" placeholder="Nama Lengkap" required><br>

                            <div class="row px-5">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="pria" name="KELAMIN" value="L" required>
                                        <label class="form-check-label" for="pria">Laki laki</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="wanita" name="KELAMIN" value="P" required>
                                        <label class="form-check-label" for="wanita">Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="input-group">
                                <div class="input-group-prepend"></div>
                                <select name="id_sub" class="custom-select col-md-5 bg-dark text-white">
                                    <option selected disabled>---Pilih Kelas---</option>

                                    <?php
                                    $subject = query("SELECT * FROM tabel_subject");
                                    foreach ($subject as $i) {
                                        echo "<option value=" . $i['id_sub'] . ">" . $i['KELAS'] . "</option>";
                                    } ?>
                                </select>
                            </div>

                            <div class="input-group mt-4">
                                <div class="input-group-prepend"></div>
                                <input type='file' name="gambar" id="upload" accept=".jpg, .jpeg, .png" />
                            </div>
                            <input type="text" name="TERDAFTAR" value="<?= $date; ?>" hidden>
                        </div>
                    </div>
                    <div class="modal-footer bg-dark text-white">
                        <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                        <button type="button" class=" btn btn-danger" data-dismiss="modal"> <i class="fa fa-undo"></i> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#anggota').addClass('menu-open')
        $('#anggota a').addClass('active')
        var table = $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "dom": 'rt<"bottom"<"row"<"col-5"i><"col pt-2"l><"col-2"p>>>'
        })
        $('#searchdata').on('keyup', function() {
            table.search(this.value).draw();
        });
    </script>

</body>

</html>