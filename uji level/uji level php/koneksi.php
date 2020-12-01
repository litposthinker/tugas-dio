<?php
$server       = "localhost";
$user         = "root";
$password     = "";
$database     = "ujilevel"; //Silakan ganti dengan nama database anda

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
function tambahanggota($post)
{
    global $koneksi;
    $kode = htmlspecialchars($_POST['kode']);
    $nama = htmlspecialchars($_POST['nama']);
    $harga = htmlspecialchars($_POST['harga']);
    $satuan = htmlspecialchars($_POST['satuan']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $gambar = htmlspecialchars($_POST['gambar']);
    $stock = htmlspecialchars($_POST['stock']);

    //insert data ke tabel_anggota
    $query = "INSERT INTO data_barang
                   VALUES
                  ('$kode', '$nama', '$harga', '$satuan', '$kategori', '$gambar', '$stock')
                  ";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
function search($data)
{
    global $koneksi;
    $dt0 = explode("-", $data)[0];
    $dt1 = explode("-", $data)[1];
    $barang = query("SELECT kode FROM data_barang WHERE kode LIKE '$dt0%' ORDER BY kode DESC");
    $barang = $barang[0]['kode'];
    $brg1 = explode("-", $barang)[1];
    if ((int)$dt1 > (int)$brg1) {
        return 1;
    } else {
        $query = "UPDATE data_barang
                       SET kode = '$data' WHERE kode = '$barang'
                      ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }
}
function delete($data)
{
    global $koneksi;
    $query = "DELETE FROM data_barang WHERE kode = '$data' ";
    mysqli_query($koneksi, $query);
    return search($data);
}
function edit($data)
{
    global $koneksi;
    $kode = htmlspecialchars($_POST['kode']);
    $kodeedit = htmlspecialchars($_POST['kodeedit']);
    $nama = htmlspecialchars($_POST['nama']);
    $harga = htmlspecialchars($_POST['harga']);
    $satuan = htmlspecialchars($_POST['satuan']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $gambar = htmlspecialchars($_POST['gambar']);
    $stock = htmlspecialchars($_POST['stock']);
    if ($kodeedit === $kode) {
        $query = "UPDATE data_barang
                SET kode = '$kode',nama = '$nama',harga = '$harga',satuan = '$satuan',kategori = '$kategori',gambar = '$gambar',stock = '$stock'
                WHERE kode = '$kode'
                ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    } else {
        $query = "UPDATE data_barang
                SET kode = '$kodeedit', nama = '$nama',harga = '$harga',satuan = '$satuan',kategori = '$kategori',gambar = '$gambar',stock = '$stock'
                WHERE kode = '$kode'
                ";
        mysqli_query($koneksi, $query);
        return search($kode);
    }
}
