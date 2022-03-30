<?php 

session_start();
include "inc/function.php";
// var_dump($_SESSION['panier']);
$total =0;
if(isset($_SESSION['panier'][1])){
    $total = $_SESSION['panier'][1];
}

$categories = getAllCategories();

if(!empty($_POST)){//button search click
   
    $produit = searchProduit($_POST['search']);

}else{
    $produit = getAllProducts();

}
$commandes=array();
if(isset($_SESSION['panier'])){
    if(count($_SESSION['panier'][3]) > 0){
        $commandes = $_SESSION['panier'][3];
    }
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
    <div class="row col-12 mt-4 gy-2 p-5">
        <h1>Panier utilisateur</h1>
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Produit</th>
                    <th scope="col">Qantite</th>
                    <th scope="col">total</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                foreach($commandes as $index => $commande){
                    print' <tr>
                        <th scope="row">'.($index+1).'</th>
                        <td>'.$commande[5].'</td>
                        <td>'.$commande[1].' pieces</td>
                        <td>'.$commande[2].' DDT</td>
                       
                        <td>
                        <a href ="actions/enlever-produit-panier.php?id='.$index.'" class="btn btn-danger">supprimer</a>
                    </td>
                  </tr>';
                }
                
                
                
                ?>
               
            </tbody>
</table>
<div class="text-end mt-3">
    <h3>total : <?php echo $total;?> DDT</h3>
    <hr>
    <a href="actions/valider-panier.php" class="btn btn-success " style="width: 100px;"> Valider</a>

</div>
       
    <?php 
    include "footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>