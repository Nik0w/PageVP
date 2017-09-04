<?php include "includes/constants.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php


	$selectImg = $db->query("SELECT * FROM images ORDER BY id_image"); 
	$images = $selectImg->fetchAll();

  /**
  * Supprime une image
  **/

  if(isset($_GET['delete_image'])){
    checkCsrf();
    $id = $db->quote($_GET['delete_image']);
    $select = $db->query("SELECT name_image, work_id FROM images WHERE id_image = $id");
    $image = $select->fetch();
    unlink('img/works/'.$image['name_image']);
    $db->query("DELETE FROM images WHERE id_image=$id");

    header('Location:images.php');
    die();
  }

?>

<?php include "partials/header.php"; ?>



<body>

    	<?php include('includes/navAdmin.php') ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Images</h1>
          
          <div class="table-responsive">
            <table class="table table-striped">
            
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>work</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>

              <?php foreach ($images as $k => $img): ?>

					<tr>
	                  <td><?= $img['id_image'] ?></td>
	                  <td><img src="<?= IMAGES; ?>works/<?= $img['name_image'] ?>" width="100"></td>
	                  <td><?= $img['work_id'] ?></td>
	                  <td>

	                  	<a href="?delete_image=<?= $img['id_image'] ?>&csrf=<?= $_SESSION['csrf'] ?>"><button class="btn btn-warning" onclick="return confirm('Voulez-vous vraiment supprimer ?');">Supprimer</button></a>
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