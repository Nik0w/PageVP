<?php include "includes/constants.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php

  if( (isset($_POST['nom_magasin'])) && (isset($_POST['type_val_mag'])) && (isset($_POST['val_mag'])) && (isset($_FILES['image'])) ){
      checkCsrf();
      $nom_mag = $db->quote($_POST['nom_magasin']);
      $type_val_mag = $db->quote($_POST['type_val_mag']);
      $val_mag = $db->quote($_POST['val_mag']);

        /**
        * SAUVEGARDE DU MAGASIN
        **/

        $db->query("INSERT INTO vp_magasins SET nom_mag = $nom_mag, type_val_mag = $type_val_mag , val_mag = $val_mag , url_img_mag =''");
        $_GET['id'] = $db->lastInsertId();

        /**
        * ENVOIE DES IMAGES
        **/

        $id_mag = $db->quote($_GET['id']);
        $image =$_FILES['image'];
        $imageName = $image['name'];
        
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        if(in_array($extension, array('jpg','png','JPG','PNG'))){
          $image_name = $_GET['id'] . '.' . $extension;
          move_uploaded_file($image['tmp_name'], IMAGES . $image_name);

          $db->query("UPDATE vp_magasins SET url_img_mag = '$image_name' WHERE id_mag = $id_mag");

          header('Location:add_magasin.php');
          die();

      }else{

      }
    }


  // On récupere la liste des pages
  $selectPages = $db->query("SELECT * FROM vp_pages");
  $pages = $selectPages->fetchAll();


?>

<?php include "partials/header.php"; ?>

<body>

        <?php include('includes/navAdmin.php') ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Nouvelle Page :</h1>

          <div class="row">
            <div class="col-sm-6">
              <form action="#" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                  <label for="nom_magasin">Nom de la page :</label>
                  <input type="text" class="form-control" id="nom_magasin" placeholder="Nom de la page :" name="nom_magasin"/>
                </div>

                <div class="form-group">
                  <label for="nom_magasin">Définition des lignes :</label>
                  <button>Ajouter une ligne</button>
                </div>

                <div class="form-group">
                  <input type="hidden" value="<?= $_SESSION['csrf'] ?>" name="csrf">
                </div>
                <button type="submit" class="btn btn-default">Enregistrer la page : </button>

              </form>
            </div>

             <div class="col-sm-6">
              <div class="table-responsive">
                <table class="table table-striped">
                
                  <thead>
                    <tr>
                      <th>Nom page</th>
                      <th>Date création</th>
                      <th>Active</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($pages as $k => $page): ?>

                    <tr>
                        <td><?= $page['nom_page'] ?></td>
                        <td><?= $page['date_creation'] ?></td>
                        <td><?= $page['is_active'] ?></td>
                        <td><a href="competences_edit.php?id=<?= $page['id_mag'] ?>"><button class="btn btn-success">Editer</button></a>
                            <a href="?delete=<?= $page['id_mag'] ?>&csrf=<?= $_SESSION['csrf'] ?>"><button class="btn btn-warning" onclick="return confirm('Voulez-vous vraiment supprimer ?');">Supprimer</button></a>
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