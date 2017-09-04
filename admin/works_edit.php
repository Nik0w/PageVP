<?php include "includes/constants.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php

  if(isset($_POST['name_work']) && isset($_POST['slug_work'])){
    checkCsrf();
    $slug = $_POST['slug_work'];
    if(preg_match('/^[a-z\-0-9]+$/' , $slug)){
      $name = $db->quote($_POST['name_work']);
      $description = $db->quote($_POST['description_work']);
      $categorie = $db->quote($_POST['categorie_work']);
      $slug = $db->quote($_POST['slug_work']);

      /**
      * SAUVEGARDE DE LA REA OU MISE A JOUR
      **/

      if(isset($_GET['id'])){

        $id = $db->quote($_GET['id']);
        $db->query("UPDATE works SET name_work = $name, slug_work = $slug, description_work = $description, cat_work_id=$categorie WHERE id_work = $id");

      }else{

        $db->query("INSERT INTO works SET name_work = $name, slug_work = $slug, description_work = $description, cat_work_id=$categorie");
        $_GET['id'] = $db->lastInsertId();
      }

        /**
        * ENVOIE DES IMAGES
        **/

        $work_id = $db->quote($_GET['id']);
        $files = $_FILES['images'];
        $images = array();

        foreach ($files['tmp_name'] as $k => $v) {
          $image = array(
            'name' => $files['name'][$k],
            'tmp_name' => $files['tmp_name'][$k]
          );
        
          $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
          if(in_array($extension, array('jpg','png','JPG','PNG'))){
            $db->query("INSERT INTO images SET work_id = $work_id, name_image = ''");
            $image_id = $db->lastInsertId();
            $image_name = $image_id . '.' . $extension;

            move_uploaded_file($image['tmp_name'], IMAGES . 'works/' . $image_name);
            $image_name = $db->quote($image_name);
            $db->query("UPDATE images SET name_image = $image_name WHERE id_image = $image_id");
        }
      }

      header('Location:works.php');
      die();

    }else{

    }
  }

   /**
  * Recup un projet
  **/

  if(isset($_GET['id'])){

    $id = $db->quote($_GET['id']);
    $select = $db->query("SELECT * FROM works WHERE id_work=$id");
    if($select->rowCount() == 0){
      header('Location:works.php');
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
          <h1 class="page-header">Editer Projet</h1>

          <div class="row">
            <div class="col-sm-6">
              <form action="#" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                  <label for="name_work">Nom du projet :</label>
                  <input type="text" class="form-control" id="name_work" placeholder="Nom du projet" name="name_work" value="<?php if(isset($_POST['name_work'])){echo $_POST['name_work'];} ?>">
                </div>

                <div class="form-group">
                  <label for="description_work">Description du projet :</label>
                  <textarea type="text" class="form-control" id="description_work" placeholder="Description du projet" name="description_work" ><?php if(isset($_POST['description_work'])){echo $_POST['description_work'];} ?></textarea>
                </div>

                <div class="form-group">
                  <label for="slug_work">Slug :</label>
                  <input type="text" class="form-control" id="slug_work" placeholder="Slug" name="slug_work" value="<?php if(isset($_POST['slug_work'])){echo $_POST['slug_work'];} ?>">
                </div>

                <div class="form-group">
                  <label for="categorie_work">Catégorie :</label>
                  <select type="text" class="form-control" id="categorie_work" placeholder="Slug" name="categorie_work">
                    <?php foreach ($categories as $k => $cat): ?>
                      <?php if((isset($_POST['cat_work_id'])) && $_POST['cat_work_id'] == $cat["id_cat"]){
                        echo '<option value="'. $cat["id_cat"] .'" selected="selected"> '.$cat["name_cat"] .' </option>';
                        }
                        else{
                          echo '<option value="'.  $cat["id_cat"] .'"> '.$cat["name_cat"] .'</option>';
                        } ?>
                    <?php endforeach  ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="slug_work">Ajouter une image :</label>
                  <input type="file" name="images[]" >

                  <input type="file" name="images[]" class="hidden" id="duplicate">
                </div>

                <div class="form-group">
                  <button class="btn btn-success"  id="duplicateBtn">Ajouter une image</button>
                </div>


                <div class="form-group">
                  <input type="hidden" value="<?= $_SESSION['csrf'] ?>" name="csrf">
                </div>
                <button type="submit" class="btn btn-default">Enregistrer le projet</button>

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
                          <a href="works_edit.php?id=<?= $image['id_image'] ?>"><button class="btn btn-success">Choisir couverture</button></a>

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