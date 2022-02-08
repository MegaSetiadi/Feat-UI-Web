<!doctype html>
<?php 
include './PayReturn.php';
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Perpustakaan Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/checkout/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        }

        @media (min-width: 768px) {
        .bd-placeholder-img-lg {
        font-size: 3.5rem;
            }
        }
        
    </style>

    <link href="form-validation.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container">
    <main>
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="../assets/brand/istockphoto-1128894938-612x612.png" alt="" width="53" height="60">
        <h2>Checkout form</h2>
        </div>

        <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your cart</span>
            </h4>
        <?php
            $CheckCart = "SELECT * FROM peminjaman WHERE status_peminjaman = 'cart'";
            $Cart = mysqli_query($conn,$CheckCart);
            $RowCart = mysqli_num_rows($Cart);
            
            if($RowCart > 0){
                while ($RowCartArray = mysqli_fetch_array($Cart)){
        ?>   
        <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0"><?php echo $RowCartArray[1];?></h6>
                </div>
                <span>
                    <?php echo "Rp ".number_format(sprintf("%0.2f", $RowCartArray[7]));?>
                </span>
            </li>
        <?php
                }
            }
        ?>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (IDR)</span>
                <strong>
                    <?php 
                        $CheckCart = "SELECT * FROM peminjaman WHERE status_peminjaman = 'cart'";
                        $Cart = mysqli_query($conn,$CheckCart);
                        $i=0;$y=0;
                        while ($RowCartArray = mysqli_fetch_array($Cart)){
                            $x[$i]=$RowCartArray[7];
                            $y=$y+$x[$i];
                            $i++;
                        }
                        echo "Rp ".number_format(sprintf("%0.2f", $y));
                    ?>
                </strong>
            </li>
        </ul>
        
        <form class="card p-2">
           <div>
                <button type="submit" class="btn w-100 btn-primary" name="pay">Pay</button>
            </div>  
        </form>
        </div>
            
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Billing</h4>
        <form class="needs-validation" novalidate>
            <div class="row g-3">
            <div class="col-sm-6">
                <label for="title" class="form-label">Book Title</label>
                <?php
                    $Checkbuku = "SELECT * FROM buku WHERE judul = '$Title'";
                    $buku = mysqli_query($conn, $Checkbuku);
                    $Rowbuku = mysqli_num_rows($buku);
                            
                    if(isset($_REQUEST['checkbook'])){
                        if($Rowbuku == null){
                            $pesan = "Judul tidak tersedia Mohon di cek kembali";
                            echo "<script type='text/javascript'>alert('$pesan');"
                                    . "location.href='index.php'</script>";
                            exit();
                    }}
                ?>
                <input type="text" class="form-control" name="title" id="title" required autofocus
                        value=
                        <?php
                            if($Title == ""){
                                echo "";
                                }else{
                                    echo $Title;
                                }
                        ?>
                        >
                <div class="invalid-feedback">
                    Valid Book Title is required.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" 
                       required readonly value=1>
                <div class="invalid-feedback">
                    Valid Book Quantity is required.
                </div>
            </div>
                
            <div class="col-12">
                <label for="stock" class="form-label">Stock</label>
                <input type="text" class="form-control" id="stock" name="stock" 
                        readonly value=
                        <?php 
                            $Stok = mysqli_query($conn,$Checkbuku);
                            $Rowbuku = mysqli_num_rows($buku);
                            $stok="";
                        
                            if($Rowbuku > 0 ){
                                if(isset($_REQUEST['checkbook'])){
                                    while ($RowStokArray = mysqli_fetch_array($Stok)){
                                        $stok[0] = $RowStokArray[3];}
                                    echo $stok[0];}}
                        ?> 
                        >
            </div>
                
            <div class="col-12">
                <label for="writer" class="form-label">Writer</label>
                <input type="text" class="form-control" name="writer" id="writer" readonly
                       value=
                       <?php 
                        $Pengarang = mysqli_query($conn,$Checkbuku);
                        $Rowbuku = mysqli_num_rows($buku);
                        
                        if($Rowbuku > 0){
                        if(isset($_REQUEST['checkbook'])){
                        while ($RowPengarangArray = mysqli_fetch_array($Pengarang)){
                            $pengarang[0] = $RowPengarangArray[2];}
                            echo $pengarang[0];}}
                        ?> 
                       >
            </div>
            
            <div class="col-12">
                <label for="date" class="form-label">Date</label>
                <div class="input-group has-validation">
                    <input type="date " class="form-control" id="date" name="date" 
                           value="<?php echo date('Y-m-d');?>" readonly>
                </div>
            </div>

            <div class="col-12">
                <label for="return" class="form-label">Return Date</label>
                <input type="input" class="form-control" name="return" id="return" 
                       value="<?php echo date('Y-m-d',strtotime("+7 day"));?>" readonly>
            </div>

            <div class="col-12">
                <label for="status" class="form-label">Return Status</label>
                <input type="text" class="form-control" id="status" name="status" readonly 
                       value=
                        
                    <?php
                        $Checkpeminjaman = "SELECT * FROM peminjaman WHERE "
                                . "judul_buku = '$Title' AND status_peminjaman ='loan'";
                        $Jumlah = mysqli_query($conn,$Checkpeminjaman);
                        $Rowpeminjaman = mysqli_num_rows($Jumlah);
                        $i=0;$y=0;
                        
                        if(isset($_REQUEST['checkbook'])){
                            if($Rowpeminjaman != 0){
                                while ($RowJumlahArray = mysqli_fetch_array($Jumlah)){
                                    $x[$i]=$RowJumlahArray[5];
                                    $y=$y+$x[$i];
                                    $i++;
                                }
                                    echo $y."_Sedang_di_pinjam";}
                                if($Rowpeminjaman == null){
                                    echo "0_Sedang_di_pinjam";
                        }}
                    ?> 
                        > 
            </div> 
        <hr class="my-4"></hr
        <h4 class="mb-3">Payment</h4>
        <div class="my-3">
            <div class="form-check">
                <input id="cash" name="paymentmethod" type="radio" class="form-check-input" required
                       <?php echo "checked";?> 
                       value="Cash">
                <label class="form-check-label" for="cash">Cash</label>
            </div>
            
            <div class="form-check">
                <input id="mbanking" name="paymentmethod" type="radio" class="form-check-input" required
                       <?php if ($PaymentMethod=="M-Banking") {echo "checked";}?> 
                       value="M-Banking">
                <label class="form-check-label" for="mbanking">M-Banking</label>
            </div>
            
            <div class="form-check">
                <input id="ewallet" name="paymentmethod" type="radio" class="form-check-input" required
                       <?php if ($PaymentMethod=="E-Wallet") {echo "checked";}?> 
                       value="E-Wallet">
                <label class="form-check-label" for="ewallet">E-Wallet</label>
            </div>
        </div>
        <hr class="my-4">
        <div class="row g-3">
            <div class="col-sm-6">
                <button type="submit" class="btn w-100 btn-secondary" name="reset" 
                        onclick="window.location.href='index.php';">Reset</button>
            </div>
            <?php
                if($RowTitle > 0){
            ?>
                    <div class="col-sm-6">
                        <button type="submit" class="btn w-100 btn-primary" 
                        name="cart">Add to Cart</button>
                    </div>
            <?php
                }else{
            ?>
                    <div class="col-sm-6">
                        <button type="submit" class="btn w-100 btn-primary" 
                        name="checkbook">Check Book</button>
                    </div>
            <?php } ?>
         
            <div class="my-4">
                <button type="submit" id="givein" name="givein" style="outline: 0;" 
                        formnovalidate="formnovalidate"
                        class="btn w-100 btn-primary">Return</button>
            </div>
        </div>
                </div>
            </form>
        </div>
    </div>
</main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017–2021 Company Name</p>
    <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacy</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
    </footer>
    </div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="form-validation.js"></script>
</body>
</html>
