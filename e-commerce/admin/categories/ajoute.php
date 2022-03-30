<?php
session_start();
  //1-recuperation des donnes de la formulaire

  $nom = $_POST['nom'];
  $description = $_POST['description'];
 $createur =  $_SESSION['id'];
  $date_creation = date('Y-m-d');


//2- la chaine de connexion 
include "../../inc/function.php";
$conn = connect();

//3- la creation de la requette
$requette = "INSERT INTO categories(nom, description,date_creation ) VALUES ('$nom', '$description','$date_creation')";

//execution de la requette
$resultat = $conn->query($requette);

if($resultat){
  header('location:liste.php?ajout=ok');
}
try {
  //3- la creation de la requette
$requette = "INSERT INTO categories(nom, description, createur, date_creation ) VALUES ('$nom', '$description','$createur''$date_creation')";

//execution de la requette
$resultat = $conn->query($requette);

if($resultat){
  header('location:liste.php?ajout=ok');
}
} catch(PDOException $e) {
  //echo "Connection failed: " . $e->getMessage();
  if($e->getcode()== 23000) {
    echo "cette nom de categorie existt deja";
    header('location:liste.php?error=duplicate');
  }
  //echo $e->getcode();

}

?>