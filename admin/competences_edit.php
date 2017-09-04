<?php include "includes/constants.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php

  if(isset($_POST['nom_competence'])){
    checkCsrf();
    $name = $db->quote($_POST['nom_competence']);

      /**
      * SAUVEGARDE DE LA REA OU MISE A JOUR
      **/

      if(isset($_GET['id'])){

        $id = $db->quote($_GET['id']);
        $db->query("UPDATE competences SET nom_competence = $name WHERE id_competence = $id");

      }else{

        $db->query("INSERT INTO competences SET nom_competence = $name, image_competence =''");
        $_GET['id'] = $db->lastInsertId();
      }

      /**
      * ENVOIE DES IMAGES
      **/

      $competence_id = $db->quote($_GET['id']);
      $image =$_FILES['image'];

      
      $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
      if(in_array($extension, array('jpg','png','JPG','PNG'))){
        $db->query("UPDATE competences SET image_competence = $competence_id WHERE id_competence = $competence_id");
        $image_name = $_GET['id'] . '.' . $extension;

        move_uploaded_file($image['tmp_name'], IMAGES . 'pictos/' . $image_name);

        header('Location:competences.php');
        die();

    }else{

    }
  }

   /**
  * Recup un projet
  **/

  if(isset($_GET['id'])){

    $id = $db->quote($_GET['id']);
    $select = $db->query("SELECT * FROM competences WHERE id_competence=$id");
    if($select->rowCount() == 0){
      header('Location:competences.php');
      die();
    }
    $_POST = $select->fetch();

  }

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

    header('Location:works_edit.php?id='.$image['work_id']);
    die();
  }

  /**
  * Recup Categoeries
  **/

  $selectCat = $db->query("SELECT id_cat,name_cat FROM categories ORDER BY id_cat"); 
  $categories = $selectCat->fetchAll();

   /**
  * Recup images
  **/

  if(isset($_GET['id'])){
    $work_id = $db->quote($_GET['id']);
    $selectImg = $db->query("SELECT id_image,name_image FROM images WHERE work_id = $work_id"); 
    $images = $selectImg->fetchAll();
  }else{
    $images = array();
  }
  

?>

<?php include "partials/header.php"; ?>



<body>

        <?php include('includes/navAdmin.php') ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Editer Compétence</h1>

          <div class="row">
            <div class="col-sm-6">
              <form action="#" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                  <label for="nom_competence">Nom de la compétence :</label>
                  <input type="text" class="form-control" id="nom_competence" placeholder="Nom de la compétence" name="nom_competence" value="<?php if(isset($_POST['nom_competence'])){echo $_POST['nom_competence'];} ?>">
                </div>

                <div class="form-group">
                  <label for="img">Ajouter une image :</label>
                  <input type="file" name="image" >
                </div>


                <div class="form-group">
                  <input type="hidden" value="<?= $_SESSION['csrf'] ?>" name="csrf">
                </div>
                <button type="submit" class="btn btn-default">Enregistrer la compétence</button>

              </form>
            </div>

            <div class="col-sm-6">
              <div class="table-responsive">
                <table class="table table-striped">
                
                  <thead>
                    <tr>
                      <th>Images</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($images as $k => $image): ?>

                    <tr>
                        <td><img src="<?= IMAGES; ?>works/<?= $image['name_image'] ?>" width="100"></td>
                        <td>
                          <a href="?delete_image=<?= $image['id_image'] ?>&<?= csrf() ?> "><button class="btn btn-warning" onclick="return confirm('Voulez-vous vraiment supprimer l'image ?');">Supprimer</button></a>
                        </td>
                    </tr>

                  <?php endforeach  ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

<?php include "partials/footer.php"; ?>