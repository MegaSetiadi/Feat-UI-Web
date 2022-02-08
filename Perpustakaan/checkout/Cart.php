<?php
include './IDBP.php';

$Title = isset ($_REQUEST['title'])?$_REQUEST['title']:"" ; 
$Quantity = isset ($_REQUEST['quantity'])?$_REQUEST['quantity']:"" ;
$PaymentMethod = isset ($_REQUEST['paymentmethod'])?$_REQUEST['paymentmethod']:"" ;
$Date = isset ($_REQUEST['date'])?$_REQUEST['date']:"" ;
$Return = isset ($_REQUEST['return'])?$_REQUEST['return']:0 ;
$Stock = isset ($_REQUEST['stock'])?$_REQUEST['stock']:0 ;

$CheckTitle = "SELECT judul FROM buku WHERE judul = '$Title'";
$title = mysqli_query($conn,$CheckTitle);
$RowTitle = mysqli_num_rows($title);

$CheckHarga = "SELECT harga FROM buku WHERE judul = '$Title'";
$Harga = mysqli_query($conn,$CheckHarga);
$I=0;
while($RowHargaArray = mysqli_fetch_array($Harga)){
    $harga[$I] = $RowHargaArray[0];}

if(isset($_REQUEST['cart'])){
    if($RowTitle > 0){
        if($Stock >= $Quantity){
            if($Quantity > 0 || $Quantity != ""){
                $InsertPeminjaman = "INSERT INTO peminjaman "
                . "(id_peminjaman,judul_buku,tgl_pinjam,tgl_pengembalian,"
                . "status_peminjaman,jumlah_peminjaman,pembayaran,harga)VALUES "
                    . "('$id_peminjaman','$Title','$Date','$Return','cart',"
                    . "'$Quantity','$PaymentMethod','$harga[$I]')";
                mysqli_query($conn,$InsertPeminjaman);
                header('Location: index.php');        
            }else{
                $pesan = "Quantity tidak boleh 0 (nol) atau kosong";
                echo "<script type='text/javascript'>alert('$pesan');</script>";
                }
        }else{
            $pesan = "Stok tidak mencukupi Mohon di cek kembali";
            echo "<script type='text/javascript'>alert('$pesan');"
                 . "location.href='index.php'</script>";
            }
    }else{
        $pesan = "Judul tidak tersedia Mohon di cek kembali";
        echo "<script type='text/javascript'>alert('$pesan');</script>";
        }
}

if(isset($_REQUEST['reset'])){
    header('Location: index.php');
}