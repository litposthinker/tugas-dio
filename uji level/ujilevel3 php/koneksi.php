<?php
$server       = "localhost";
$user         = "root";
$password     = "";
$database     = "starbhakmarket"; //Silakan ganti dengan nama database anda

$koneksi      = mysqli_connect($server, $user, $password, $database);

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $box = [];
    while ($barang = mysqli_fetch_assoc($result)) {
        $box[] = $barang;
    }
    return $box;
}
function rupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

function tambahanggota($post)
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $harga = (int) explode(' ', join('', explode('.', htmlspecialchars($_POST['harga']))))[1];
    $kategori = htmlspecialchars($_POST['kategori']);
    $gambar = htmlspecialchars($_POST['gambar']);
    $stock = htmlspecialchars($_POST['stock']);
    $query = "INSERT INTO stockbarang 
                VALUES ('', '$nama', '$harga', '$stock','$kategori', '$gambar', 0)
            ";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function delete($id)
{
    global $koneksi;
    $query = "UPDATE stockbarang SET IsDeleted = 1 WHERE id = '$id'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
function edit($data)
{
    global $koneksi;
    $id = htmlspecialchars($_POST['id']);
    $nama = htmlspecialchars($_POST['nama']);
    $harga = (int) explode(' ', join('', explode('.', htmlspecialchars($_POST['harga']))))[1];
    $kategori = htmlspecialchars($_POST['kategori']);
    $gambar = htmlspecialchars($_POST['gambar']);
    $stock = htmlspecialchars($_POST['stock']);
    $query = "UPDATE stockbarang
                SET nama = '$nama',harga = '$harga',jenis = '$kategori',gambar = '$gambar',stock = '$stock'
                WHERE id = '$id'
                ";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
function history($id, $stock, $jumlah)
{
    global $koneksi;

    $tanggal = date("y/m/d H:i:s");
    $query = "INSERT INTO historybarang VALUES('','$stock','$jumlah','$tanggal')";
    mysqli_query($koneksi, $query);

    $history_id = mysqli_insert_id($koneksi);
    foreach ($id as $key => $value) {
        $barang_id = explode('brg', $key)[1];
        $order = "INSERT INTO belibarang VALUES('$history_id','$barang_id','$value')";
        mysqli_query($koneksi, $order);
    }
    
    return mysqli_affected_rows($koneksi);
}
