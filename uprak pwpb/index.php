<?php require "template.php";
$data = query("SELECT * FROM tabel_anggota ORDER BY NAMA ASC");
$count = query("SELECT COUNT(*) FROM tabel_anggota")[0];

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <div class="content-wrapper bg-white pt-5">
        <section class="content-header">
            <div class="container-fluid pt-2">
                <ol class="breadcrumb p-1 float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </section>
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="col-lg-2 col-2">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?= $count["COUNT(*)"]?></h3>
                        <p>User Terdata</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                foreach ($data as $anggota) :
                    $id_sub = $anggota["id_sub"];
                    $datasub = query("SELECT KELAS FROM tabel_subject WHERE id_sub ='$id_sub' ")[0];
                ?>
                    <div class="col-md-3">
                        <!-- Widget: user widget style 1 -->
                        <div class="card card-widget widget-user shadow-lg">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white bg-info">
                                <h3 class="widget-user-username text-right"><?= $anggota['NAMA'] ?></h3>
                                <h5 class="widget-user-desc text-right"><?= $datasub['KELAS'] ?></h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= $anggota['GAMBAR'] ?>" alt="User Avatar">
                            </div>
                            <div class="card-footer">
                                <a href="detail.php?ID=<?= $anggota["ID"]; ?>" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                <?php endforeach ?>
            </div>
        </section>
    </div>
    <script>
        $('#dashboard').addClass('menu-open')
        $('#dashboard a').addClass('active')
    </script>
</body>

</html>