<?php 
Session_start();
$nom = $_POST['nom'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$createur = $_POST['createur'];
$categorie = $_POST['categorie'];
$quantite = $_POST['quantite'];
$date_creation = date("Y-m-d");

// upload image
$target_dir= "../../images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $image = $_FILES["image"]["name"];
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
$date_creation = date('Y-m-d');

//2- la chaine de connexion 
include "../../inc/function.php";
$conn = connect();
try {
  //3- la creation de la requette
$requette = "INSERT INTO produit(nom, description, prix,image,categorie, createur, date_creation ) VALUES ('$nom', '$description','$prix','$image','$categorie','$createur','$date_creation')";

//execution de la requette
$resultat = $conn->query($requette);


if($resultat){
  $produit_id=$conn->lastInsertId();

$requette2 = "INSERT INTO stocks(produit, quantite, createur,date_creation) VALUES ('$produit_id','$quantite','$createur','$date_creation')";
if($conn->query($requette2)){
  header('location:liste.php?ajout=ok');
}else{
  echo "impossible d'ajouter le stock du produit";
}
  
}
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  if($e->getcode()== 23000) {
    //echo "cette nom de categorie existt deja";
    header('location:liste.php?error=duplicate');
  }
  //echo $e->getcode();

}












?>