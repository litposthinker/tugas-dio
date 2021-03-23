<?php

session_start();

//cek cookie
if (isset($_COOKIE['login'])) {
  if ($_COOKIE['login'] == 'true') {
    $_SESSION['login'] = true;
  }
}

if (isset($_SESSION["login"])) {
  header("location: ../dashboard.php");
  exit;
}

require '../koneksidb.php';

$ID_CHAT_1 = $pengaturan["ID_CHAT"];
$TOKEN     = $pengaturan["TOKEN"];

if (isset($_POST["login"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($koneksi, "SELECT * FROM tabel_pengaturan WHERE USERNAME = '$username'");

  //cek username
  if (mysqli_num_rows($result) == 1) {

    //cek password
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row["PASSWORD"])) {

      //set session
      $_SESSION["login"] = true;
      $_SESSION['username'] = $username;
      
      //cek remember me
      if (isset($_POST["remember"])) {
        setcookie('login', 'true', time() + 60);
      }
      if ($pengaturan["SW_2"]) {
        $pesan = "Anda telah melakukan login pada\nTanggal= " . date("d F Y") . "\nPukul= " . date("H:i:s");
        kirimpesan($ID_CHAT_1, $pesan, $TOKEN);
      }
      header("location:../dashboard.php");
      exit;
    }
  }
  if ($pengaturan["SW_2"]) {
    $pesan = "PERINGATAN!!!\n\nAda yang berusaha login pada\nTanggal= " . date("d F Y") . "\nPukul= " .
      date("H:i:s");
    kirimpesan($ID_CHAT_1, $pesan, $TOKEN);
  }
  $error = true;
}


if (isset($_POST["kirim"])) {
  $ID_CHAT_2 = $_POST["ID_CHAT"];

  if ($ID_CHAT_1 == $ID_CHAT_2) {
    $user_baru  = "admin123";
    $pass_baru  = rand(100000, 999999);
    $pass_hash  = password_hash($pass_baru, PASSWORD_DEFAULT);
    $pesan      = "Username dan Password anda telah direset\n\nUsername: " . $user_baru . "\nPassword: " . $pass_baru;
    kirimpesan($ID_CHAT_1, $pesan, $TOKEN);
    //update password
    $sql = "UPDATE tabel_pengaturan SET USERNAME = '$user_baru ', PASSWORD  = '$pass_hash'";
    $koneksi->query($sql);

    $alert = ' 
            <div class="alert bg-primary alert-dismissible fade show text-center text-white" role="alert"> Akun telah direset
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div> 

           ';
  } else {
    $pesan = "PERINGATAN!!!\n\nAda yang berusaha mereset akun anda";
    kirimpesan($ID_CHAT_1, $pesan, $TOKEN);
    $alert = ' 
            <div class="alert bg-danger alert-dismissible fade show text-center text-white" role="alert"> ID Chat Tidak Dikenali!!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div> 

           ';
  }
}


?>



<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link href="fontawesome/css/all.css" rel="stylesheet">
  <link href="fontawesome/css/fontawesome.min.css" rel="stylesheet">
  <!--load all styles -->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/custom.css">

  <title>E-Presensi Doorlock</title>
</head>

<body>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form p-l-55 p-r-55 p-t-178" action="" method="POST">
          <span class="login100-form-title">
            LOG IN
          </span>

          <div class="wrap-input100 validate-input m-b-16" data-validate="masukan username">
            <input class="input100" type="text" name="username" placeholder="Username">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="masukan password">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
          </div>

          <div class="text-right p-t-13 p-b-23">
            <input type="checkbox" name="remember" id="remember" class="form-check-input ml-2 mt-1">
            <label for="remember" class="mx-4 form-check-label">Ingat saya</label>
          </div>

          <div class="container-login100-form-btn mb-3">
            <button class="login100-form-btn" name="login">
              Log in
            </button>
          </div>
        </form>
        <div class="login100-form mb-5 p-l-55 p-r-55">
          <div class="container-login100-form-btn">
            <button class="login100-form-btn bg-danger" href="#" data-toggle="modal" data-target="#resetakun">
              Reset Akun
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal Konfirmasi ID Chat -->
  <div class="modal fade" id="resetakun" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title title-bold">KONFIRMASI ID CHAT</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="index.php" method="post">
          <div class="modal-body ">
            <div class="form-group">
              <input class="form-control " name="ID_CHAT" type="text" autocomplete="off" placeholder="ID Chat Bot Telegram">
            </div>
          </div>
          <div class="modal-footer ">
            <button type="submit" name="kirim" class="btn btn-success"><i class="fa fa-save"></i> Kirim</button>
            <button type="button" class=" btn btn-danger" data-dismiss="modal"> <i class="fa fa-undo"></i> Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>

  <!-- My Javascript/jQuery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/main.js"></script>


</body>

</html>