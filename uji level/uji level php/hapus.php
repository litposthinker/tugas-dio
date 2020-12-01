<?php
require 'koneksi.php';
if (isset($_GET['id'])) {
    if (delete($_GET['id'])>0) {
        header('Location: index.php');
    } else {
        header('Location: hapus.php?error');
    }
}
