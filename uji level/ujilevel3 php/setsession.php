<?php
include 'koneksi.php';
session_start();
if (isset($_GET['session'])) {
    $id = explode('brg', $_GET['session'])[1];
    $barang = query("SELECT stock FROM stockbarang WHERE id = '$id'")[0];

    if (isset($_SESSION[$_GET['session']])) {
        if ($_SESSION[$_GET['session']] < $barang['stock']) {
            $_SESSION[$_GET['session']]++;

            $oke = 'ditambah';
            echo json_encode($oke);
        } else {
            $error = 'kelebihan';
            echo json_encode($error);
        }
    } else {
        if ($barang['stock'] > 0) {
            $_SESSION[$_GET['session']] = 1;

            $oke = 'ditambah';
            echo json_encode($oke);
        } else {
            $error = 'kelebihan';
            echo json_encode($error);
        }
    }
}
