<?php
include 'koneksi.php';
session_start();
if (isset($_GET['session'])&& isset($_GET['value'])) {

    $id = explode('brg', $_GET['session'])[1];
    $barang = query("SELECT stock FROM stockbarang WHERE id = '$id'")[0];
    
    if (isset($_SESSION[$_GET['session']])) {
        
        if (is_numeric($_GET['value']) && $_GET['value'] < $barang['stock']) {
            $_SESSION[$_GET['session']] = $_GET['value'];
        }
        
    }
}
