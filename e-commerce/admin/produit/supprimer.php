<?php

$idcategorie = $_GET['idc'];
include "../../inc/function.php";
$conn = connect();
$requette = "DELETE FROM produit WHERE id = '$idcategorie'";
$resultat = $conn->query($requette);
if($resultat){
   // echo "categorie supprimee";
   header('location:liste.php?delete=ok');
}




?>