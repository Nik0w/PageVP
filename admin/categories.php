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
		$db->query("DELETE FROM categories WHERE id_cat = $id");
		header('Location:categories.php');
		die();
	}

	$selectCat = $db->query("SELECT * FROM categories ORDER BY id_cat"); 
	$categories = $selectCat->fetchAll();
?>

<?php include "partials/header.php"; ?>



<body>

    	<?php include('includes/navAdmin.php') ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Catégories</h1>

          <a href="categorie_edit.php"><button class="btn btn-success">Ajouter une catégorie</button></a>

          
          <div class="table-responsive">
            <table class="table table-striped">
            
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Slug</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>

              <?php foreach ($categories as $k => $cat): ?>

					<tr>
	                  <td><?= $cat['id_cat'] ?></td>
	                  <td><?= $cat['name_cat'] ?></td>
	                  <td><?= $cat['slug_cat'] ?></td>
	                  <td>
	                  	<a href="categorie_edit.php?id=<?= $cat['id_cat'] ?>"><button class="btn btn-success">Editer</button></a>

	                  	<a href="?delete=<?= $cat['id_cat'] ?>&csrf=<?= $_SESSION['csrf'] ?>"><button class="btn btn-warning" onclick="return confirm('Voulez-vous vraiment supprimer ?');">Supprimer</button></a>
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