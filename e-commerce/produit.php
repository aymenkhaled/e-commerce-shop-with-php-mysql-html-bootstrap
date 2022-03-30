<?php 
session_start();
include "inc/function.php";
$categories = getAllCategories();
if(isset($_GET['id']) ){
    $produit = getProduitById($_GET['id']);
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
        <?php if(isset($_SESSION['etat']) && $_SESSION['etat'] == 0){
           print' <div class="alert alert-danger">Compte non validee</div>';
        }
        
        ?>
  
        
        <div class="card col-8 offset-2">
            <img class="card-img-top" src="images/<?php echo $produit['image'];?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo $produit['nom']; ?></h5>
                <p class="card-text"><?php echo $produit['description']; ?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $produit['prix'];?> DT</li>
                <?php   
                        foreach($categories as $indes => $c){
                            if($c['id'] == $produit['categorie']){
                                print '<button class="btn btn-success mb-2 ">'. $c['nom'].'</button>
                                ';
                            }
                        }

                ?>
                
            </ul>
            <div>
            <form action="actions/commander.php" class="text-center d-flex" method="POST">
                <input type="hidden" value="<?php echo $produit['id']; ?>" name="produit" >
                <input type="number" class="form-control" step="1" placeholder="Quantite du produit ..." name="quantite">
                <button type="submit" <?php if(isset($_SESSION['etat']) && $_SESSION['etat'] == 0 || !isset($_SESSION['etat'])){ echo "disabled";}?> class="btn btn-primary">Commander</button>

            </form>
        </div>
        </div>
        
    </div>

    
    <?php 
    include "footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>