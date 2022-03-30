<?php

$idvisiteur = $_GET['id'];


//2- la chaine de connexion 
include "../../inc/function.php";
$conn = connect();
$requette = "UPDATE visiteur SET etat = 1 WHERE id ='$idvisiteur'";

$resultat = $conn->query($requette);
if($resultat){
    header('location:liste.php?valider=ok');
    
}else{
    echo "error de validation";
}

?>