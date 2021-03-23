<?php

require "template.php";
if (isset($_GET["ID"])) {
   if (hapusanggota($_GET["ID"]) > 0) {

      echo "
            <script>
               Swal.fire({ 
                  title: 'BERHASIL',
                  text: 'Data Anggota Telah dihapus',
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
                  text: 'Data gagal dihapus', 
                  icon: 'warning', 
                  dangerMode: true, 
                  buttons: [false, 'OK'], 
                  }).then(function() { 
                     window.location.href=''; 
                  }); 
            </script>
           ";
   }
}

if (isset($_GET["id_sub"])) {
   if (hapussubject($_GET["id_sub"]) > 0) {
      echo "
            <script>
               Swal.fire({ 
                  title: 'BERHASIL',
                  text: 'Data Subject Telah dihapus',
                  icon: 'success', buttons: [false, 'OK'], 
                  }).then(function() { 
                     window.location.href='subject.php'; 
                  });  
            </script>
            ";
   } else {
      echo "
            <script> 
               Swal.fire({ 
                  title: 'OOPS', 
                  text: 'Data gagal dihapus', 
                  icon: 'warning', 
                  dangerMode: true, 
                  buttons: [false, 'OK'], 
                  }).then(function() { 
                     window.location.href=''; 
                  }); 
            </script>
         ";
   }
}

$koneksi->close();

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>';
?>