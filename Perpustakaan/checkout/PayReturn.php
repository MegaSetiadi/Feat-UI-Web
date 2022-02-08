<?php
include './Cart.php';

$checkcart = "SELECT * FROM peminjaman WHERE status_peminjaman='cart'";
$ccart = mysqli_query($conn, $checkcart);
$Rowcart = mysqli_num_rows($ccart);

$M=0;

if(isset($_REQUEST['pay'])){
if($Rowcart != 0){
    while ($RowcartArray = mysqli_fetch_array($ccart)){
        $judul_buku[$M] = $RowcartArray[1];
        $jumlah_peminjaman[$M] = $RowcartArray[5];
        $M++;
    }   $M=0;
    
    while($Rowcart > $M){
        $checkbuku = "SELECT * FROM buku WHERE judul ='$judul_buku[$M]'";
        $cbuku = mysqli_query($conn, $checkbuku);
    while ($RowbukuArray = mysqli_fetch_array($cbuku)){
        $stock[$M] = $RowbukuArray[3];
        $M++;
    }}  $M=0;
    
    while($Rowcart > $M){
        $UPS = $stock[$M] - $jumlah_peminjaman[$M];
        $UpdateStatusBuku = "UPDATE peminjaman SET "
                        . "status_peminjaman = 'loan' "
                        . "WHERE judul_buku = '$judul_buku[$M]'";
        $UpdateStockBuku = "UPDATE buku SET stok='$UPS' WHERE judul='$judul_buku[$M]'";
        mysqli_query($conn,$UpdateStatusBuku);
        mysqli_query($conn,$UpdateStockBuku);
        $M++;
    }header('Location: index.php');
}else{header('Location: index.php');}}

$checkPeminjaman = "SELECT * FROM peminjaman WHERE id_peminjaman='$Title'";
$Peminjaman = mysqli_query($conn, $checkPeminjaman);
$RowPeminjaman = mysqli_num_rows($Peminjaman);
$G="";$H="";
if(isset($_REQUEST['givein'])){
   if($RowPeminjaman != null && $RowPeminjaman != 0){
        $RowPeminjamanArray = mysqli_fetch_array($Peminjaman);
        $G = $RowPeminjamanArray[1];
        $H = $RowPeminjamanArray[5];
        $UpdateStatusPeminjaman = "UPDATE peminjaman SET status_peminjaman = 'rack' "
                . "WHERE id_peminjaman = '$Title'";
        $UpdateStokBuku = "UPDATE buku SET stok = stok + $H "
                . "WHERE judul = '$G'";
        mysqli_query($conn, $UpdateStatusPeminjaman);
        mysqli_query($conn, $UpdateStokBuku);
        header('Location: index.php');
    }else{
        $pesan = "ID Pemesanan Salah / Tidak Sesuai Mohon di Cek Kembali";
        echo "<script type='text/javascript'>alert('$pesan');</script>";
    }
   }