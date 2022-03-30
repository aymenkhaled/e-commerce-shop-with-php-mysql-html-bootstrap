<?php
session_start();
  //1-recuperation des donnes de la formulaire

  
  $quantite = $_POST['quantite'];
    $id = $_POST['ids'];
  $date_modification = date('Y-m-d');


//2- la chaine de connexion 
include "../../inc/function.php";
$conn = connect();

//3- la creation de la requette
$requette = "UPDATE  stocks SET quantite = '$quantite' WHERE id = '$id'";

//execution de la requette
$resultat = $conn->query($requette);

if($resultat){
  header('location:liste.php?modif=ok');
}

?>