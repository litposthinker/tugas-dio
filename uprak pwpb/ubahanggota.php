<?php

require "template.php";

if (isset($_POST["simpan"])) {
  if (ubahAnggota($_POST) > 0) {
    echo "
			 <script>
				  Swal.fire({ 
                  title: 'SELAMAT',
                  text: 'Perubahan data telah disimpan',
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
  <title></title>
</head>

<body>
  <div class="content-wrapper bg-white pt-5">
    <section class="content-header">
      <div class="container-fluid pt-2">
        <ol class="breadcrumb p-1 float-sm-right">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="dataanggota.php">Anggota</a></li>
          <li class="breadcrumb-item active">Ubah</li>
        </ol>
      </div>
    </section>
    <!-- Content Header (Page header) -->

    <section class="content">
      <h3 class="mx-auto title-bold pt-4 text-center" style="width: 25rem;">UBAH DATA ANGGOTA</h3>
      <?php
      if (isset($_GET["ID"])) :
        $ID       = $_GET["ID"];
        $data     = query("SELECT * FROM tabel_anggota WHERE ID = '$ID'")[0];
        $subject  = query("SELECT * FROM tabel_subject");
      ?>
        <div class="card mx-auto" style="width: 25rem;">
          <div class="card-body bg-dark text-white">
            <form action="ubahanggota.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input type="text" name="ID" class="form-control bg-dark text-white" value="<?= $data["ID"]; ?>" hidden><br>
                <input type="text" name="NO_INDUK" class="form-control bg-dark text-white" placeholder="Masukkan NIS...." autocomplete="off" value="<?= $data["NO_INDUK"]; ?>"><br>
                <input type="text" name="NAMA" class="form-control bg-dark text-white" placeholder="Masukkan Nama...." autocomplete="off" value="<?= $data["NAMA"]; ?>"><br>

                <div class="row">
                  <?php if ($data["KELAMIN"] == "L") {
                    echo '
                                  <div class ="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="pria" name="KELAMIN" value="L" checked="checked">
                                        <label class="form-check-label" for="pria">Laki laki</label>
                                    </div>
                                  </div>
                                  <div class ="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="KELAMIN" id="wanita" value="P">
                                        <label class="form-check-label" for="wanita">Perempuan</label>
                                    </div>
                                  </div>
                                ';
                  } else if ($data["KELAMIN"] == "P") {
                    echo '
                                  <div class ="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="pria" name="KELAMIN" value="L">
                                        <label class="form-check-label" for="pria">Laki laki</label>
                                    </div>
                                  </div>
                                  <div class ="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="KELAMIN" id="wanita" value="P" checked="checked">
                                        <label class="form-check-label" for="wanita" >Perempuan</label>
                                    </div>
                                  </div>
                                ';
                  }
                  ?>
                </div>

                <br>
                <div class="input-group">
                  <div class="input-group-prepend">
                  </div>
                  <select name="id_sub" class="custom-select col-md-5 bg-dark text-white">
                    <option disabled <?php if ($data['id_sub'] == 0) {
                                        echo 'selected';
                                      } ?>>---Pilih Subject---</option>
                    <?php
                    foreach ($subject as $i) {
                      if ($data['id_sub'] === $i['id_sub']) {
                        $select = "selected";
                      } else {
                        $select = "";
                      }
                      echo "<option value=" . $i['id_sub'] . " $select>" . $i['KELAS'] . "</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="input-group my-4">
                  <div class="input-group-prepend"></div>
                  <input type='file' name="gambar" id="upload" accept=".jpg, .jpeg, .png" />
                  <input type="hidden" value="<?= $data['GAMBAR'] ?>">
                </div>
                <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                <a href="dataanggota.php" name="batal" class="btn btn-danger"><i class="fa fa-undo"></i> Batal</a>
              </div>
            </form>
          </div>
        </div>
      <?php endif; ?>
    </section>
  </div>

  <script>
    $('#anggota').addClass('menu-open')
    $('#anggota a').addClass('active')
  </script>

</body>

</html>