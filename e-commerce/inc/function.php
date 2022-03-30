<?php

function connect(){
    // 1- connection vers la BD
$servername = "localhost";
$DBuser = "root";
$DBpassword = "";
$DBname="ecommerce";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$DBname", $DBuser, $DBpassword);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();

}

return $conn;

}



function getAllCategories(){

$conn = connect();
    

// 2- creation de la requette

$requette ="SELECT * FROM categories";

// 3- execution de la requette

$resultat =  $conn->query($requette);

// 4- resultat de la requette

$categories = $resultat->fetchAll();
//var_dump($categories);
return $categories;
    }




function getAllProducts(){
  $conn = connect();
// 2- creation de la requette

$requette ="SELECT * FROM produit";

// 3- execution de la requette

$resultat =  $conn->query($requette);

// 4- resultat de la requette

$produit = $resultat->fetchAll();
//var_dump($categories);
return $produit;
}



function searchProduit($keyword){
   // 1- connection vers la BD
   $conn = connect();

// 2- creation de la requette

$requette ="SELECT * FROM produit WHERE nom LIKE '%$keyword%'";

// 3- execution de la requette

$resultat =  $conn->query($requette);

// 4- resultat de la requette

$produit = $resultat->fetchAll();
//var_dump($categories);
return $produit;
}
function getProduitById($id){
  $conn = connect();
  //1 - creation de la requette
   $requette = " SELECT * FROM produit WHERE id=$id";
   // 3- execution de la requette

  $resultat =  $conn->query($requette);

  // 4- resultat de la requette

  $produit = $resultat->fetch();
  //var_dump($categories);
  return $produit;
}
 function AddVisiteur($data){
  $conn = connect();
  $mphash = md5($data['mp']);
  $requette = "INSERT INTO visiteur(nom, prenom, email, mp, telephone) VALUES('".$data['nom']."','".$data['prenom']."','".$data['email']."','".$mphash."','".$data['telephone']."' )";
  $resultat =$conn->query($requette);
  if($resultat){
    return true;

  }else{
    return false;
  }
}
function ConnectVisiteurs($data){
  $conn = connect();
  $email =$data['email'];
  $mp = md5($data['mp']);
  $requette = "SELECT * FROM visiteur WHERE email='$email' AND mp = '$mp'";

  $resultat =$conn->query($requette);
  $user = $resultat->fetch();
 return $user;

}
function ConnectAdmin($data){
  $conn = connect();
  $email =$data['email'];
  $mp = md5($data['mp']);
  $requette = "SELECT * FROM administrateur WHERE email='$email' AND mp = '$mp'";

  $resultat =$conn->query($requette);
  $user = $resultat->fetch();
 return $user;
}
 function getAllusers(){
  $conn = connect();
  $requette = "SELECT * FROM visiteur WHERE etat =0";

  $resultat =$conn->query($requette);
  $user = $resultat->fetchAll();
 return $user;
 }



 function getStocks(){
  $conn = connect();
  $requette = "SELECT nom,s.id,  quantite FROM produit p, stocks s WHERE p.id = s.produit";

  $resultat =$conn->query($requette);
  $stocks = $resultat->fetchAll();
 return $stocks;
 }
 function getAllPaniers(){
  $conn = connect();
  $requette = "SELECT p.id ,v.nom , v.prenom, v.telephone, p.total, p.etat, p.date_creation FROM  visiteur v, panier p where p.visiteur = v.id";

  $resultat =$conn->query($requette);
  $paniers = $resultat->fetchAll();
 return $paniers;
 }
 function getAllCommandes(){
  $conn = connect();
  $requette = "SELECT p.nom, p.image, c.quantite, c.total, c.panier FROM  commandes c, produit p where c.produit=p.id ";

  $resultat =$conn->query($requette);
  $commandes = $resultat->fetchAll();
  return $commandes;
 }
 function changeretatPanier($data){
      $conn = connect();
      $requette ="UPDATE panier Set etat = '".$data['etat']."' WHERE id = '".$data['panier_id']."' ";
      $resultat =$conn->query($requette);

 }

 function  getPanierbyEtat($paniers,$etat){
  
  $panieretat = array();
  foreach($paniers as $p){
    if($p['etat'] == $etat){
     array_push( $panieretat,$p);
    }
  }
  return $panieretat;
 }
 function EditAdmin($data){
  $conn = connect();
  if($data['mp'] != ""){//motpasse nom empty
    $requette ="UPDATE administrateur Set nom = '".$data['nom']."',  email = '".$data['email']."',  mp = '".md5($data['mp'])."' WHERE id = '".$data['id_admin']."' ";
  
  }else{
    $requette ="UPDATE administrateur Set nom = '".$data['nom']."',  email = '".$data['email']."' WHERE id = '".$data['id_admin']."' ";

  } 
  // if($data['nom'] != ""){
  //   $requette ="UPDATE administrateur Set nom = '".$data['nom']."',  email = '".$data['email']."',  mp = '".md5($data['mp'])."' WHERE id = '".$data['id_admin']."' ";
  
  // }else{
  //   $requette ="UPDATE administrateur Set   mp = '".md5($data['mp'])."',    email = '".$data['email']."' WHERE id = '".$data['id_admin']."' ";

  // }
  // if($data['email'] != ""){
  //   $requette ="UPDATE administrateur Set nom = '".$data['nom']."',  email = '".$data['email']."',  WHERE id = '".$data['id_admin']."' ";
  
  // }else{
  //   $requette ="UPDATE administrateur Set nom =   '".$data['nom']."', mp = '".md5($data['mp'])."' WHERE id = '".$data['id_admin']."' ";

  // }
  $resultat =$conn->query($requette);
  return true;

 }
 function  getData(){

   $data = array();
  $conn = connect();

  $requette = "SELECT COUNT(*) FROM produit";
  $resultat=$conn->query($requette);
 $nbrprds = $resultat->fetch();

  $requette1 = "SELECT COUNT(*) FROM categories";
  $resultat1=$conn->query($requette1);
   $nbrcat=$resultat1->fetch();

  $requette2 = "SELECT COUNT(*) FROM visiteur";
  $resultat2=$conn->query($requette2);
  $nbrclients=$resultat2->fetch();
  
  $data["produits"] = $nbrprds[0];
  $data["categories"] = $nbrcat[0];
  $data["clients"] = $nbrclients[0];

  return $data;
 }


 ?>