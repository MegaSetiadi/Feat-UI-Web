<!DOCTYPE html>
<?php include './Kalkulator.php'?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Kalkulator Pecahan</title>
        <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="index.css" rel="stylesheet">
        
        <style>
            body{
                background-color: lightblue;                
            }
            form {
                width: 400px;
                align-items: center;
                margin-left: -70px;
            }
        </style>
    </head>
    
    <body class="text-center">    
        <main class="form-signin">
            <form>
                <h1>Kalkulator Pecahan</h1>
                
                <div class="form-floating">
                    <input type="text" class="form-control" id="total" placeholder="100.000" name="total">
                    <label for="total">Total</label>
                </div>
                
                <label><h2>Stok Pecahan</h2></label>
                
                    <div class="form-floating">
                        <input type="text" class="form-control" id="duapuluh" placeholder="20.000" name="duapuluh">
                        <label for="duapuluh">Rp 20.000</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="limapuluh" placeholder="50.000" name="limapuluh">
                        <label for="limapuluh">Rp 50.000</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="seratus" placeholder="100.000" name="seratus">
                        <label for="seratus">Rp 100.000</label>
                    </div>
              
                <br>
            
                <button class="w-10 btn btn-lg btn-primary" type="submit" id="hitung" name="hitung">Hitung</button>
                <br>
                <label><h2>Hasil Kalkulasi</h2></label>
                
                <p class="form-control"> 
                    <?php 
                        echo $z;
                        echo " Pecahan Rp20,000";
                    ?> <br>
                    <?php 
                        echo $y;
                        echo " Pecahan Rp50,000";
                    ?> <br>
                    <?php 
                        echo $x;
                        echo " Pecahan Rp100,000";
                    ?> <br>
                    <?php    
                        echo " Sisa : Rp";
                        echo number_format(sprintf("%0.2f", $sisa));
                    ?> 
                </p>
            </form>
        </main>
    </body>
</html>
