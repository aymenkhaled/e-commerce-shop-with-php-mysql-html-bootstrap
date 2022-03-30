<?php 


session_start();
if(isset($_SESSION['nom'])){
    //header('location:profile.php');
}



include "../inc/function.php";
$user = true;
if(!empty($_POST)){//click button sauvgarder
    $user = ConnectAdmin($_POST);
    if($user ){ //utilisateur connecter
        session_start();
        $_SESSION['id']=$user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['mp'] = $user['mp'];
        
        header('location:profile.php'); // redirection vers la page profile
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

    <div class="col-12 p-5">
        <h1 class="text-center">Espace Admin :Connexion</h1>
        <form action ="connexion.php" method="POST">
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name ="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <input type="password" name ="mp" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">connecter</button>
        </form>
    </div>
    <?php 
    include "../footer.php";
    ?>

   
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
 <?php
    if(!$user){
        print "<script>
        Swal.fire({
            title: 'Erreur',
            text: 'Cordonnes non valide',
            icon: 'error',
            confirmButtonText: 'ok',
            timer : 2000
        })

        </script>";
    }

   
    
    
    
?>
</html>