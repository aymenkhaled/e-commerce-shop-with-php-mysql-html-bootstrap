<?php
Session_start();
include "../../inc/function.php";
$categories = getAllCategories();

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
            <h1 class="h2">Liste Des Categories</h1>
            
            <div>
                <a  class="btn btn-primary"data-toggle="modal" data-target="#exampleModal">Ajouter</a>
            </div>
           
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
          
           <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 0;
        foreach($categories as $c){
          $i++;
       print ' <tr>
       <th scope="row">'.$c['id'].'</th>
       <td>'.$c['nom'].'</td>
       <td>'.$c['description'].'</td>
       <td>
           <a data-toggle="modal" data-target="#editModal'.$c['id'].'" class="btn btn-success">Modifier</a>
           <a onclick="return popUpDeleteCategorie()" href="supprimer.php?idc='.$c['id'].'" class="btn btn-danger">Supprimer</a>
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
    

<!-- Modal Ajout-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Categorie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="ajoute.php" method="POST" id="addform">
              <div class="form-group">
                <input type="text" name="nom"  required maxlength="15" minlength="2" class="form-control" placeholder="nom de categorie ...">
              </div>
              <div class="form-group" id="blocknom">
                <textarea  name="description" id="nom"  class="form-control" placeholder="description de la categorie ..."></textarea>
              </div>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button  type="submit" class="btn btn-primary">Ajouter</button>
          </div>
        </form>
    </div>
  </div>
</div>

<?php
foreach($categories as $index => $categorie){?>
<!-- Modal  Modifier-->
<div class="modal fade" id="editModal<?php echo $categorie['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier Categorie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="modifier.php" method="POST">
          <input type="hidden" value="<?php echo $categorie['id']; ?>" name="idc">
              <div class="form-group">
                <input type="text" name="nom" class="form-control" value="<?php echo $categorie['nom']; ?>" placeholder="nom de categorie ...">
              </div>
              <div class="form-group">
                <textarea  name="description" class="form-control" placeholder="description de la categorie ..."><?php echo $categorie['description']; ?></textarea>
              </div>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button  type="submit" class="btn btn-primary">Modifier</button>
          </div>
        </form>
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
