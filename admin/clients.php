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

	$selectClients = $db->query("SELECT * FROM users");

	$clients = $selectClients->fetchAll();
  
?>

<?php include "partials/header.php"; ?>



<body>

    	<?php include('includes/navAdmin.php') ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Clients :</h1>

          <a href="competences_edit.php"><button class="btn btn-success">Ajouter un client</button></a>

          
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

              <?php foreach ($clients as $k => $client): ?>

					<tr>
	                  <td><?= $client['id_competence'] ?></td>
	                  <td><?= $client['nom_competence'] ?></td>
	                  <td>
	                  	<a href="competences_edit.php?id=<?= $client['id_competence'] ?>"><button class="btn btn-success">Editer</button></a>

                      <a href="?delete=<?= $client['id_competence'] ?>&csrf=<?= $_SESSION['csrf'] ?>"><button class="btn btn-warning" onclick="return confirm('Voulez-vous vraiment supprimer ?');">Supprimer</button></a>
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