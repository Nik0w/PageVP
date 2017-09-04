<?php include "includes/constants.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php

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
          <h1 class="page-header">Gérer la page :</h1>

          <a href="edit_page.php"><button class="btn btn-success">Modifier la page</button></a>

          
          
        </div>
      </div>
    </div>

<?php include "partials/footer.php"; ?>