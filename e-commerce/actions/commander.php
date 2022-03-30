<?php
session_start();
//test user connectee
if(!isset($_SESSION['nom'])){
    header('location:../../connexion.php');
    exit();
}





$id_produit =  $_POST['produit'];

$quantite =  $_POST['quantite'];

//2- la chaine de connexion 
include "../inc/function.php";
$conn = connect();
$visiteur = $_SESSION['id'];


//3- la creation de la requette


$requette = "SELECT prix, nom FROM produit WHERE id = '$id_produit'";
// //execution de la requette


$resultat = $conn->query($requette);
$produit = $resultat->fetch();
$total = $quantite *  $produit['prix'] ;
$date = date('Y-m-d');
if(!isset($_SESSION['panier'])){// panier n'existe pas
    $_SESSION['panier'] = array($visiteur,0, $date, array() ); // creation de panier
} 
$_SESSION['panier'][1] += $total; 


$_SESSION['panier'][3][] = array($id_produit, $quantite, $total, $date, $date,$produit['nom'] );


header('location:../panier.php');


?>








