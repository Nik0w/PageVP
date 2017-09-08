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
    $db->query("DELETE FROM competences WHERE id_competence = $id");
    header('Location:competences.php');
    die();
  }

	$selectCompetences = $db->query("SELECT * FROM competences LEFT JOIN images ON image_competence = id_image");

	$competences = $selectCompetences->fetchAll();
  
?>

<?php include "partials/header.php"; ?>



<body>

    	<?php include('includes/navAdmin.php') ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Compétences</h1>

          <a href="competences_edit.php"><button class="btn btn-success">Ajouter une compétence</button></a>

          
          <div class="table-responsive">
            <table class="table table-striped">
            
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>

              <?php foreach ($competences as $k => $competence): ?>

					<tr>
	                  <td><?= $competence['id_competence'] ?></td>
	                  <td><?= $competence['nom_competence'] ?></td>
                    <td><img src="<?= IMAGES; ?>pictos/<?= $competence['name_image'] ?>" width="100"></td>
	                  <td>
	                  	<a href="competences_edit.php?id=<?= $competence['id_competence'] ?>"><button class="btn btn-success">Editer</button></a>

                      <a href="?delete=<?= $competence['id_competence'] ?>&csrf=<?= $_SESSION['csrf'] ?>"><button class="btn btn-warning" onclick="return confirm('Voulez-vous vraiment supprimer ?');">Supprimer</button></a>
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