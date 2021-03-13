<?php
require 'koneksi.php';
if (isset($_GET['id'])) {
    (delete($_GET['id']) > 0) ?
        header('Location: admin.php') :
        header('Location: hapus.php?error');
}
