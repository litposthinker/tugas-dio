<?php
require "template.php";
if (isset($_GET["ID"])) {
    $ID       = $_GET["ID"];
    $anggota     = query("SELECT * FROM tabel_anggota WHERE ID = '$ID'")[0];
    $id_sub = $anggota["id_sub"];
    $datasub = query("SELECT KELAS FROM tabel_subject WHERE id_sub ='$id_sub' ")[0];
    $diff_tgl  = strtotime($anggota["TERDAFTAR"]);
    $terdaftar = date("d F Y", $diff_tgl);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>
    <div class="content-wrapper bg-white pt-5">
        <section class="content-header">
            <div class="container-fluid pt-2">
                <ol class="breadcrumb p-1 float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </section>
        <!-- Content Header (Page header) -->
        <section class="content">
            <h3 class=" pl-3 title-bold pt-2">Detail</h3>
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user shadow-lg">
                <div class="widget-user-header bg-danger pb-5">
                    <img class="img-circle widget-user-username" src="<?= $anggota['GAMBAR'] ?>" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <h3>No Induk: <?= $anggota["NO_INDUK"] ?></h3>
                    <h3>Nama: <?= $anggota["NAMA"] ?></h3>
                    <h3>Kelas: <?= $datasub["KELAS"] ?></h3>
                    <h3>Kelamin: <?= $anggot["KELAMIN"]='L'?'LAKI-LAKI':'PEREMPUAN' ?></h3>
                    <h3>Terdaftar: <?= $terdaftar ?></h3>
                </div>
            </div>
            <!-- /.widget-user -->
        </section>
    </div>
</body>

</html>