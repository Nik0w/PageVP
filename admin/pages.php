<?php include "includes/constants.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php

  $selectPages = $db->query("SELECT * FROM vp_pages");

  $pages = $selectPages->fetchAll();

  /**
  * SUPPR
  **/

  if(isset($_GET['delete'])){
    checkCsrf();

    $id = $db->quote($_GET['delete']);
    $db->query("DELETE FROM vp_magasins WHERE id_mag = $id");
    header('Location:magasins.php');
    die();
  }

	$selectMagasins = $db->query("SELECT * FROM vp_magasins");

	$magasins = $selectMagasins->fetchAll();
  
?>

<?php include "partials/header.php"; ?>

<body>

    	<?php include('includes/navAdmin.php') ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Gérer les pages :</h1>

          <a href="add_page.php" class="btn btn-primary" role="button">Créer une page</a>
         
         <h2>Page active :</h2>

         <div class="col-sm-12 col-md-12">
          <div class="thumbnail">
            <img src="..." alt="...">
            <div class="caption">
              <h3>Page active</h3>
              <p>...</p>
              <p><a href="#" class="btn btn-primary" role="button">Modifier</a> <a href="#" class="btn btn-default" role="button">Supprimer</a></p>
            </div>
          </div>
        </div>

          <h2>Mes autres pages :</h2>

          <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
              <img src="..." alt="...">
                <div class="caption">
                  <h3>Thumbnail label</h3>
                  <p>...</p>
                  <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
              </div>
            </div>
          
        </div>
      </div>
    </div>

<?php include "partials/footer.php"; ?>