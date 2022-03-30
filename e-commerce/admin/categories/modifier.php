<?php
session_start();
  //1-recuperation des donnes de la formulaire

  $nom = $_POST['nom'];
  $description = $_POST['description'];
    $id = $_POST['idc'];
  $date_modification = date('Y-m-d');


//2- la chaine de connexion 
include "../../inc/function.php";
$conn = connect();

//3- la creation de la requette
$requette = "UPDATE  categories SET nom = '$nom', description='$description', date_modification='$date_modification' WHERE id = '$id'";

//execution de la requette
$resultat = $conn->query($requette);

if($resultat){
  header('location:liste.php?modif=ok');
}

?>