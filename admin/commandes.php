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

	$selectCommandes = $db->query("SELECT * FROM commandes INNER JOIN compagnies WHERE commandes.id_compagnie = compagnies.id_compagnie ORDER BY id_commande");

	$commandes = $selectCommandes->fetchAll();
  
?>

<?php include "partials/header.php"; ?>

<body>

    	<?php include('includes/navAdmin.php') ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Commandes :</h1>

          <a href="add_commande.php"><button class="btn btn-success">Ajouter une commande</button></a>

          
          <div class="table-responsive">
            <table class="table table-striped">
            
              <thead>
                <tr>
                  <th>#</th>
                  <th>Référence</th>
                  <th>Compagnie</th>
                  <th>Création</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>

              <?php foreach ($commandes as $k => $commande): ?>

					<tr>
            <td><?= $commande['id_commande'] ?></td>
            <td><?= $commande['ref_commande'] ?></td>
            <td><?= $commande['nom_compagnie'] ?></td>
            <td><?= date_create($commande['date_commande'])->format('d-m-Y') ?></td>
            <td>
            	<a href="competences_edit.php?id=<?= $commande['id_commande'] ?>"><button class="btn btn-success">Editer</button></a>

              <a href="?delete=<?= $commande['id_commande'] ?>&csrf=<?= $_SESSION['csrf'] ?>"><button class="btn btn-warning" onclick="return confirm('Voulez-vous vraiment supprimer ?');">Supprimer</button></a>
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