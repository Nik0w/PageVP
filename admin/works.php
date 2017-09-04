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
		$db->query("DELETE FROM works WHERE id_work = $id");
		header('Location:works.php');
		die();
	}

	$selectWorks = $db->query("SELECT * FROM works ORDER BY id_work"); 
	$works = $selectWorks->fetchAll();
?>

<?php include "partials/header.php"; ?>



<body>

    	<?php include('includes/navAdmin.php') ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Works</h1>

          <a href="works_edit.php"><button class="btn btn-success">Ajouter un projet</button></a>

          
          <div class="table-responsive">
            <table class="table table-striped">
            
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Description</th>
                  <th>Slug</th>
                  <th>catégories</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>

              <?php foreach ($works as $k => $work): ?>

					<tr>
	                  <td><?= $work['id_work'] ?></td>
	                  <td><?= $work['name_work'] ?></td>
                    <td><?= $work['description_work'] ?></td>
	                  <td><?= $work['slug_work'] ?></td>
                    <td><?= $work['cat_work_id'] ?></td>
	                  <td>
	                  	<a href="works_edit.php?id=<?= $work['id_work'] ?>"><button class="btn btn-success">Editer</button></a>

	                  	<a href="?delete=<?= $work['id_work'] ?>&csrf=<?= $_SESSION['csrf'] ?>"><button class="btn btn-warning" onclick="return confirm('Voulez-vous vraiment supprimer ?');">Supprimer</button></a>
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