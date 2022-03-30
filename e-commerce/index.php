<?php 

session_start();
include "inc/function.php";
$categories = getAllCategories();

if(!empty($_POST)){//button search click
   
    $produit = searchProduit($_POST['search']);

}else{
    $produit = getAllProducts();
}


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-SHOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
   <?php
    include "inc/header.php";


    ?>
    <div class="row col-12 mt-4 gy-2 ">


    <?php
        foreach($produit as $produit){
            print '<div class="col-3 mt-2">
            <div class="card" style="width: 18rem;">
                <img src="images/'.$produit['image'].'" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">'.$produit['nom'].'</h5>
                    <p class="card-text">'.$produit['description'].'</p>
                    <a href="produit.php?id='.$produit['id'].'" class="btn btn-primary">afficher</a>
                </div>
            </div>
        </div>';
        }


    ?>
       
    <?php 
    include "footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>