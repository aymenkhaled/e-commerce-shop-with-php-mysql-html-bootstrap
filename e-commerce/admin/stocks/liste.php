<?php
Session_start();
include "../../inc/function.php";
$stocks = getStocks();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>liste Stocks</title>

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
            <h1 class="h2">Liste Des Stocks</h1>
            
            
           
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
      <th scope="col">Nom de produit</th>
      <th scope="col">Qauntite </th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 0;
        foreach($stocks as $s){
          $i++;
       print ' <tr>
       <th scope="row">'.$s['id'].'</th>
       <td>'.$s['nom'].'</td>
       <td>'.$s['quantite'].'</td>
       <td>
           <a data-toggle="modal" data-target="#editModal'.$s['id'].'" class="btn btn-success">Modifier</a>
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
    
    <?php
foreach($stocks as $index => $stock){?>
<!-- Modal  Modifier-->
<div class="modal fade" id="editModal<?php echo $stock['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">  Modifier stock du<span class="text-primary"> <?php echo $stock['nom'];  ?></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="modifier.php" method="POST">
          <input type="hidden" value="<?php echo $stock['id']; ?>" name="ids">
              <div class="form-group">
                <input type="number" step="1" name="quantite" class="form-control" value="<?php echo $stock['quantite']; ?>" placeholder="stock du produit ...">
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
