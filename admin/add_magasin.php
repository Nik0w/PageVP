<?php include "includes/constants.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php

  if( (isset($_POST['nom_magasin'])) && (isset($_POST['type_val_mag'])) && (isset($_POST['val_mag'])) && (isset($_POST['link_mag'])) && (isset($_FILES['image'])) ){
      checkCsrf();
      $nom_mag = $db->quote($_POST['nom_magasin']);
      $type_val_mag = $db->quote($_POST['type_val_mag']);
      $val_mag = $db->quote($_POST['val_mag']);
      $link_mag = $db->quote($_POST['link_mag']);

        /**
        * SAUVEGARDE DU MAGASIN
        **/

        $db->query("INSERT INTO vp_magasins SET nom_mag = $nom_mag, type_val_mag = $type_val_mag , val_mag = $val_mag , url_img_mag ='',link_mag = $link_mag");
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


  // On récupere la liste des compagnies
  $select_magasins = $db->query("SELECT * FROM vp_magasins");
  $magasins = $select_magasins->fetchAll();


?>

<?php include "partials/header.php"; ?>

<body>

        <?php include('includes/navAdmin.php') ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Nouveau Magasin :</h1>

          <div class="row">
            <div class="col-sm-6">
              <form action="#" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                  <label for="nom_magasin">Nom du magasin :</label>
                  <input type="text" class="form-control" id="nom_magasin" placeholder="Nom du magasin :" name="nom_magasin"/>
                </div>

                <div class="form-group">
                  <label for="img">Image :</label>
                  <input type="file" name="image" >
                </div>

                <div class="form-group">
                  <label for="type_val_mag">Type valeur :</label>
                  <input type="text" class="form-control" id="type_val_mag" placeholder="Type valeur :" name="type_val_mag"/>
                </div>

                <div class="form-group">
                  <label for="val_mag">Valeur(s) :</label>
                  <input type="text" class="form-control" id="val_mag" placeholder="Valeur(s) :" name="val_mag"/>
                </div>

                <div class="form-group">
                  <label for="link_mag">Lien :</label>
                  <input type="text" class="form-control" id="link_mag" placeholder="Lien :" name="link_mag"/>
                </div>

                <div class="form-group">
                  <input type="hidden" value="<?= $_SESSION['csrf'] ?>" name="csrf">
                </div>
                <button type="submit" class="btn btn-default">Enregistrer le magasin</button>

              </form>
            </div>

             <div class="col-sm-6">
              <div class="table-responsive">
                <table class="table table-striped">
                
                  <thead>
                    <tr>
                      <th>Nom_magasin</th>
                      <th>Type valeur</th>
                      <th>Valeur</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($magasins as $k => $magasin): ?>

                    <tr>
                        <td><?= $magasin['nom_mag'] ?></td>
                        <td><?= $magasin['type_val_mag'] ?></td>
                        <td><?= $magasin['val_mag'] ?></td>
                        <td><a href="competences_edit.php?id=<?= $magasin['id_mag'] ?>"><button class="btn btn-success">Editer</button></a>
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
      </div>
    </div>

<?php include "partials/footer.php"; ?>