<?php
//include './index.php';
$total = isset ($_REQUEST['total'])?$_REQUEST['total']:0 ;
$seratus = isset ($_REQUEST['seratus'])?$_REQUEST['seratus']:0 ;
$limapuluh = isset ($_REQUEST['limapuluh'])?$_REQUEST['limapuluh']:0 ;
$duapuluh = isset ($_REQUEST['duapuluh'])?$_REQUEST['duapuluh']:0 ; 

$sisa=0;
$x=0;$y=0;$z=0;

$tseratus = 100000;
$tlimapuluh = 50000;
$tduapuluh = 20000;

if(isset($_REQUEST['hitung'])){
   
   if($total>0){
       while($total > 0 && $seratus > 0 && $total >= $tseratus){
           if($total >= $tseratus){
           $total = $total - $tseratus;    
           $x++;
           $seratus--;
           }
       }
       while($total > 0 && $limapuluh > 0 && $total >= $tlimapuluh){
           if($total >= $tlimapuluh){
           $total = $total - $tlimapuluh;
           $y++;
           $limapuluh--;
           }
       }
       while($total > 0 && $duapuluh > 0 && $total >= $tduapuluh){
           if($total >= $tduapuluh){
           $total = $total - $tduapuluh;
           $z++;
           $duapuluh--;
           }
       }
       $sisa = $total;
       
   }
}

