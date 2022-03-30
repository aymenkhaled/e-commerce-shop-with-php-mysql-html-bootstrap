<?php 

session_start();
if(isset($_SESSION['nom'])){
    header('location:profile.php');
}


include "inc/function.php";
$showRegistrationAlert = 0;
$categories = getAllCategories();
if(!empty($_POST)){//click button sauvgarder
    if (AddVisiteur($_POST)){
        $showRegistrationAlert =1;
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
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

</head>

<body>
<?php
    include "inc/header.php";


    ?>
    <div class="col-12 p-5">
        <h1 class="text-center">Registre</h1>
        <form action="registre.php" method="POST">
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nom</label>
                <input type="text" name = "nom" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Prenom</label>
                <input type="text" name ="prenom" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">telephone</label>
                <input type="text" name = "telephone" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <input type="password" name="mp" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Sauvgarder</button>
        </form>
    </div>
    <?php 
    include "footer.php";
    ?>

    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
 <?php
    if($showRegistrationAlert == 1){
        print "<script>
        Swal.fire({
            title: 'success!',
            text: 'creation de compte ave succes',
            icon: 'success',
            confirmButtonText: 'ok',
            timer : 2000
        })

        </script>";
    }
    
    
    
    
?>
    
</html>