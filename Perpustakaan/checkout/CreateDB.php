<?php
include './connect.php';

$CreateDB = "CREATE DATABASE IF NOT EXISTS perpustakaan";

try{
    if ($con->query($CreateDB) === TRUE){
        //echo "Database created successfully";
}}  catch (Exception $e){
        echo $e;
}

$conn = new mysqli("localhost", "root", "","perpustakaan");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$CreateBuku = "CREATE TABLE IF NOT EXISTS buku (
id_buku VARCHAR(9) NOT NULL PRIMARY KEY,
judul VARCHAR(30) NOT NULL,
pengarang VARCHAR(30) NOT NULL,
stok INT(10) NOT NULL,
harga INT(10) NOT NULL
)";

$CreatePeminjaman = "CREATE TABLE IF NOT EXISTS peminjaman (
id_peminjaman VARCHAR(9) NOT NULL PRIMARY KEY,
judul_buku VARCHAR(30) NOT NULL,
tgl_pinjam VARCHAR(10) NOT NULL,
tgl_pengembalian VARCHAR(10) NOT NULL,
status_peminjaman VARCHAR(30) NOT NULL,
jumlah_peminjaman INT(10) NOT NULL,
pembayaran VARCHAR(10) NOT NULL,
harga INT(10) NOT NULL
)";

try{
    if (mysqli_query($conn, $CreateBuku)){
        //echo "Database created successfully";
}   if (mysqli_query($conn, $CreatePeminjaman)){
        //echo "Database created successfully";
}}  catch (Exception $e){
        echo $e;
}

$CheckBuku = "SELECT * FROM buku";
$Buku = mysqli_query($conn,$CheckBuku);
$RowBuku = mysqli_num_rows($Buku);

if($RowBuku == null){
    $InsertBuku = "INSERT INTO buku "
        . "(id_buku,judul,pengarang,stok,harga)VALUES "
        . "('IBS01-001','Potter','Sudirman','5','20000'),"
        . "('IBS01-002','Spiderman','Jhon','2','15000'),"
        . "('IBS01-003','Ether','Smith','1','25000')";
    mysqli_query($conn, $InsertBuku);
}