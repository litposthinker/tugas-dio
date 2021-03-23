<?php

use phpDocumentor\Reflection\Types\False_;

$server       = "localhost";
$user         = "root";
$password     = "";
$database     = "presensirfid"; //Silakan ganti dengan nama database anda

$koneksi      = mysqli_connect($server, $user, $password, $database);

function query($query)
{
  global $koneksi;
  $result = mysqli_query($koneksi, $query);
  $box = [];
  while ($siswa = mysqli_fetch_assoc($result)) {
    $box[] = $siswa;
  }
  return $box;
}

function uploadGambar($nama)
{
  global $koneksi;
  $namaFile = $_FILES['gambar']['name'];
  $tmpFile = $_FILES['gambar']['tmp_name'];

  $ekstensiGambarValid = ['jpeg', 'png', 'jpg'];
  $ekstensiGambar = pathinfo($namaFile, PATHINFO_EXTENSION);
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    return '';
  }
  $namaFileBaru = "$nama.$ekstensiGambar";
  move_uploaded_file($tmpFile, "photos/$namaFileBaru");

  return "photos/$namaFileBaru";
}


function tambahAnggota($post)
{
  global $koneksi;
  $NO_INDUK = htmlspecialchars($post['NO_INDUK']);
  $NAMA     = htmlspecialchars($post['NAMA']);
  $KELAMIN  = htmlspecialchars($post['KELAMIN']);
  $id_sub   = htmlspecialchars($post['id_sub']);
  $TERDAFTAR = htmlspecialchars($post['TERDAFTAR']);
  $gambar = uploadGambar($NAMA);

  //insert data ke tabel_anggota
  $query = "INSERT INTO tabel_anggota
                   VALUES
                  ('', '$NO_INDUK', '$NAMA','$gambar' ,'$KELAMIN', '$id_sub', '$TERDAFTAR')
                  ";

  mysqli_query($koneksi, $query);
  return mysqli_affected_rows($koneksi);
}

function tambahSubject($post)
{
  global $koneksi;
  $SUBJECT  = htmlspecialchars($post['SUBJECT']);
  //insert data ke tabel_subject
  $query = "INSERT INTO tabel_subject(SUBJECT) VALUES('$SUBJECT')";
  mysqli_query($koneksi, $query);
  return mysqli_affected_rows($koneksi);
}

function ubahsubject($post)
{
  global $koneksi;
  $SUBJECT  = $post['SUBJECT'];
  $id_sub   = $post['id_sub'];

  //update data tabel_subject
  $query = "UPDATE tabel_subject SET SUBJECT = '$SUBJECT' WHERE id_sub = '$id_sub'";
  mysqli_query($koneksi, $query);
  return mysqli_affected_rows($koneksi);
}

// function updateGambar($nama, $id)
// {
// }

function ubahAnggota($post)
{
  global $koneksi;
  $ID          = $post['ID'];
  $NIS         = $post['NO_INDUK'];
  $NAMA        = $post['NAMA'];
  $KELAMIN     = $post['KELAMIN'];
  $id_sub      = $post['id_sub'];
  if ($_FILES) {
    $namaFile = $_FILES['gambar']['name'];
    $tmpFile = $_FILES['gambar']['tmp_name'];
    $ekstensiGambarValid = ['jpeg', 'png', 'jpg'];
    $ekstensiGambar = pathinfo($namaFile, PATHINFO_EXTENSION);
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      return 0;
    }
    $namaFileBaru = "photos/$NAMA.$ekstensiGambar";
    
    $pengaturan =  query("SELECT * FROM tabel_anggota WHERE ID = '$ID'")[0];
    unlink($pengaturan["GAMBAR"]);
    $query = "UPDATE tabel_anggota SET 
              NO_INDUK  = '$NIS',
              NAMA      = '$NAMA',
              GAMBAR = '$namaFileBaru',
              KELAMIN   = '$KELAMIN',
              id_sub    = '$id_sub'
              WHERE ID  = '$ID'
              ";
    move_uploaded_file($tmpFile, "$namaFileBaru");
  }else{
    //update data ke tabel_siswa
    $query = "UPDATE tabel_anggota SET
              NO_INDUK  = '$NIS',
              NAMA      = '$NAMA',
              KELAMIN   = '$KELAMIN',
              id_sub    = '$id_sub'

              WHERE ID  = '$ID'
                ";
  }
  mysqli_query($koneksi, $query);
  return mysqli_affected_rows($koneksi);
}

function hapusAnggota($ID)
{
  global $koneksi;
  $pengaturan =  query("SELECT * FROM tabel_anggota WHERE ID = '$ID'")[0];
  unlink($pengaturan["GAMBAR"]);
  mysqli_query($koneksi, "DELETE FROM tabel_anggota WHERE ID = '$ID'");
  return mysqli_affected_rows($koneksi);
}
function hapusSubject($ID)
{
  global $koneksi;
  mysqli_query($koneksi, "DELETE FROM tabel_subject WHERE id_sub = '$ID'");
  return mysqli_affected_rows($koneksi);
}
