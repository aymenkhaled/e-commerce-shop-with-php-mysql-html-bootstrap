<?php
session_start();
include "../inc/function.php";
$conn = connect();

// id client
$visiteur = $_SESSION['id'];
$total = $_SESSION['panier'][1];
$date = date('Y-m-d');

// //creation de panier



$requette_panier = "INSERT INTO panier(visiteur, total, date_creation) VALUES('$visiteur','$total', '$date')";


// //execution de la requette_panier
$resultat1 = $conn->query($requette_panier);
$panier_id = $conn->lastInsertId();

$commandes = $_SESSION['panier'][3];

foreach($commandes as $commande){
    $quantite = $commande[1];
    $total = $commande[2];
    $id_produit= $commande[0];
// // ajouter commande
$requette = "INSERT INTO commandes(produit, quantite, total, panier, date_creation, date_modification) VALUES('$id_produit','$quantite', '$total', '$panier_id','$date', '$date')";
//execution de la requette
$resultat = $conn->query($requette);
}




$_SESSION['panier'] = null;
header('location:../index.php');



?>