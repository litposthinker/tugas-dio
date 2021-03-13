<?php
require 'koneksi.php';
session_start();
if (isset($_SESSION)) {

    foreach ($_SESSION as $keysesi => $valsesi) {
        $keysesinew = explode("brg", $keysesi)[1];
        $keranjang = query("SELECT stock,harga FROM stockbarang WHERE id = '$keysesinew'");
        
        foreach ($keranjang as $krj) {
            $total = (isset($total)) ? $krj['harga'] * $valsesi + $total : $krj['harga'] * $valsesi;
        }
        
        $stock = (isset($stock)) ? $valsesi + $stock : $valsesi;
    }
    
    $jumlah_harga = ($total < 15000) ? $total + $total * 0.10 - $total * 0.05 : $total + $total * 0.10;
    
    if (history($_SESSION,(int)$stock,(int)$jumlah_harga) > 0) {
        session_destroy();
        header('Location: index.php');
    } else {
        header('Location: tambahkeranjang.php?error');
    }
}
