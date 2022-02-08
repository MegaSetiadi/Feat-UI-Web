<?php
include './CreateDB.php';

$IBP = 1;//output IBP01-001 dst (01)
$NIBP = 1;//output IBP01-001 dst (001)

$CheckIDP = "SELECT id_peminjaman FROM peminjaman ORDER BY id_peminjaman desc";
$IDP = mysqli_query($conn,$CheckIDP);
$RowIDP = mysqli_num_rows($IDP);
$RowIDPArray = mysqli_fetch_array($IDP);

if(isset($_REQUEST['cart'])){ 
    $IBP = substr($RowIDPArray[0],4,1);
    $NIBP = substr($RowIDPArray[0],-3);     
    if($RowIDP == 0 || $RowIDP == null){
        $id_peminjaman = "IBP01-001";
    }else{
        if($NIBP < 999){
            $NIBP = substr($RowIDPArray[0],-3) + 1;
            $id_peminjaman = "IBP0".$IBP."-".$NIBP;
            
            if($NIBP > 9 && $NIBP < 99){
                $NIBP = substr($RowIDPArray[0],-2) + 1;
                $id_peminjaman = "IBP0".$IBP."-0".$NIBP;
            }else if($NIBP < 9){
                $NIBP = substr($RowIDPArray[0],-1) + 1;
                $id_peminjaman = "IBP0".$IBP."-00".$NIBP;
            }
        }else if($IBP >= 9){
            $IBP = substr($RowIDPArray[0],3,2) + 1;
            $NIBP = 1;
            $id_peminjaman = "IBP".$IBP."-00".$NIBP;
            
        }else if($IBP < 9){
            $IBP = substr($RowIDPArray[0],4,1) + 1;
            $NIBP = 1;
            $id_peminjaman = "IBP0".$IBP."-00".$NIBP;
        }
    }
}