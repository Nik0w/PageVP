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
          <h1 class="page-header">Magasins :</h1>

          <a href="add_magasin.php"><button class="btn btn-success">Ajouter un magasin</button></a>
          <hr>

          
          
          <div class="table-responsive">
            <table class="table table-striped">
            
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Image</th>
                  <th>Type valeur</th>
                  <th>Valeur</th>
                  <th>Lien</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>

              <?php foreach ($magasins as $k => $magasin): ?>

      					<tr>
                  <td><?= $magasin['id_mag'] ?></td>
                  <td><?= $magasin['nom_mag'] ?></td>
                  <td> <img style="width:60px;" src="<?= WEBROOT.'images/'.$magasin['url_img_mag'] ?> "></td>
                  <td><?= $magasin['type_val_mag'] ?></td>
                  <td><?= $magasin['val_mag'] ?></td>
                  <td><?= $magasin['link_mag'] ?></td>
                  <td>
                  	<a href="edit_magasin.php?id=<?= $magasin['id_mag'] ?>"><button class="btn btn-success">Editer</button></a>

                    <a href="?delete=<?= $magasin['id_mag'] ?>&csrf=<?= $_SESSION['csrf'] ?>"><button class="btn btn-warning" onclick="return confirm('Voulez-vous vraiment supprimer ?');">Supprimer</button></a>
            		  </td>
                </tr>

      			  <?php endforeach  ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<?php include "partials/footer.php"; ?>