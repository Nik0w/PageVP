<?php include "includes/constants.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php

  $selectLignes = $db->query("SELECT * FROM vp_lignes");
  $lignes = $selectLignes->fetchAll();

  /**
  * SUPPR
  **/

  if(isset($_GET['delete'])){
    checkCsrf();

    $id = $db->quote($_GET['delete']);
    $db->query("DELETE FROM vp_lignes WHERE id_ligne = $id");
    header('Location:lignes.php');
    die();
  }

 
?>

<?php include "partials/header.php"; ?>

<body>

    	<?php include('includes/navAdmin.php') ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Gérer les lignes :</h1>

          <a href="add_ligne.php" class="btn btn-primary" role="button">Créer une ligne</a>
         
         <h2>Mes lignes :</h2>

          <?php foreach ($lignes as $k => $ligne): ?>

            <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <div class="caption">
                  <h3><?= $ligne['id_ligne'] ?></h3>
                  <p>...</p>
                  <p><a href="edit_ligne.php?id=<?= $ligne['id_ligne'] ?>" class="btn btn-primary" role="button">Modifier</a> <a href="#" class="btn btn-default" role="button">Supprimer</a></p>
                </div>
              </div>
            </div>

          <?php endforeach  ?>

        </div>
      </div>
    </div>

<?php include "partials/footer.php"; ?>