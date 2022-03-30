<?php
Session_start();
include "../../inc/function.php";
if(isset($_POST['btnSubmit'])){
  //changer etat de panier 
  changeretatPanier($_POST);

}
$paniers = getAllPaniers();
$commandes = getAllCommandes();

if(isset($_POST['btnSearch'])){
  echo $_POST['etat'];
  //exit;
  if($_POST['etat'] == "tout"){
    $paniers = getAllPaniers();

  }else{
    $paniers = getPanierbyEtat($paniers,$_POST['etat']);

  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>admin profile</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../../deconnexion.php">deconnexion</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
      <?php 
       include "../template/navigation.php"
       ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Liste Des Paniers</h1>
            
          
          </div>

          <!-- liste start -->
          <div>

            <?php if(isset($_GET['ajout']) && $_GET['ajout'] == "ok"){
              print'<div class="alert alert-success">
              Categorie ajoutee avec succes
            </div>';
            }
            ?>
            <?php if(isset($_GET['delete']) && $_GET['delete'] == "ok"){
              print'<div class="alert alert-success">
              Categorie supprimee avec succes
            </div>';
            }
            ?>
            <?php if(isset($_GET['modif']) && $_GET['modif'] == "ok"){
              print'<div class="alert alert-success">
              Categorie modifier avec succes
            </div>';
            }
            ?>
            <?php if(isset($_GET['error']) && $_GET['error'] == "duplicate"){
              print'<div class="alert alert-danger">
              nom deCategorie deja exist
            </div>';
            } 
            ?>
          <form  method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-gourp d-flex">
            <select name="etat" class="form-control">
              <option value="">--choisir l'etat--</option>
              <option value="tout">tout</option>
              <option value="en cours">en cours</option>

              <option value="en livraison">en livraison</option>
              <option value="livraison termine">livraison termine</option>
            </select>
            <input type="submit" class="btn btn-primary ml-2 mr-5" value="chercher" name = "btnSearch" />
            </div>
            
          </form>
           <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Client</th>
      <th scope="col">total</th>
      <th scope="col">Date</th>
      <th scope="col">telephone</th>
      <th  scope="col">etat</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 0;
        foreach($paniers as $p){
          $i++;
       print ' <tr>
       <th scope="row">'.$i.'</th>
       <td>'.$p['nom'].' '.$p['prenom'].'</td>
       <td>'.$p['total'].' DDT</td>
       <td>'.$p['date_creation'].'</td>
       <td>'.$p['telephone'].'</td>
       <td>'.$p['etat'].'</td>
       <td>
    
       <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal'.$p['id'].'">
       afficher</button>
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#traiterModal'.$p['id'].'">
       traiter</button>
       </td>
     </tr>';
      }
    ?>
   
    
  </tbody>
</table>




           </div>
          
        </main>
      </div>
    </div>
    <!-- blabla -->
    <?php
foreach($paniers as $index => $p){?>


<!-- Button trigger modal -->


<!-- Modal -->

           
       
<div class="modal fade" id="exampleModal<?php echo $p['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">liste du commande</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table">
                <thead>
                    <tr>
                        <th>Nom produit</th>
                        <th>image</th>
                        <th>quantite</th>
                        <th>total</th>
                        


                    </tr>
                </thead>
                <tbody>
                   <?php  
                        foreach($commandes as $index => $c){
                          if($c['panier'] == $p['id']){// si commande appartient au panier ouvert $p
                            print'<tr>
                            <td>'.$c['nom'].'</td>
                            <td><img src="../../images/'.$c['image'].'"  width="100"/></td>
                            <td>'.$c['quantite'].'</td>
                            <td>'.$c['total'].'</td>
                           
                    </tr>';
                        }
                            
                      }

?>
                </tbody>
            </table>
      </div>
      
    </div>
  </div>
</div>
<?php 
}

?>

<?php
foreach($paniers as $index => $p){?>


<!-- Button trigger modal -->


<!-- Modal -->

           
       
<div class="modal fade" id="traiterModal<?php echo $p['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Traiter les commande</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
       
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" value="<?php echo $p['id']?>" name="panier_id">
        <div class="form-group">
            <select name="etat" class="form-control">
                <option value="en livraison">en livraison</option>
                <option value="livraison termine"> livraison termine</option>
              </select>
        </div>
        <div class="form-group">
          <button type="submit" name="btnSubmit" class="btn btn-primary">Sauvegarder</button>
          
          
        </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<?php 
}

?>
     
    





    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.min.js"></script>
    <script>
      function popUpDeleteCategorie(){
        return confirm("vouler vou vraiment supprimer la categorie ?");
      }
    </script>
    <!-- <script>
      $('#addform').submit(function(){
        if ($('#nom').val() == ""){
          $('#blocknom').append('<p class="text-danger"> il faut remplir la description</p>')
          return false;
        }
      })
    </script> -->
  </body>
</html>
