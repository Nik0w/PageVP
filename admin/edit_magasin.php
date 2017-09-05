<?php include "includes/constants.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php

  if(isset($_GET['id'])){

    $id = $db->quote($_GET['id']);
    $select = $db->query("SELECT * FROM vp_magasins WHERE id_mag=$id");
    if($select->rowCount() == 0){
      header('Location:magasins.php');
      die();
    }
    $_POST = $select->fetch();
  }else{
    header('Location:magasins.php');
    die();
  }

?>

<?php include "partials/header.php"; ?>



<body>

        <?php include('includes/navAdmin.php') ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Editer Magasin</h1>

          <form action="#" method="POST">

            <div class="form-group">
              <label for="nom_mag">Nom du magasin :</label>
              <input type="text" class="form-control" id="nom_mag" placeholder="Nom de la catégorie" name="nom_mag" value="<?php echo $_POST['nom_mag']; ?>">
            </div>
            <div class="form-group">
              <label for="type_val_mag">Type valeur :</label>
              <input type="text" class="form-control" id="type_val_mag" placeholder="Slug" name="type_val_mag" value="<?php echo $_POST['type_val_mag']; ?>">
            </div>
            <div class="form-group">
              <label for="val_mag">Valeur :</label>
              <input type="text" class="form-control" id="val_mag" placeholder="Slug" name="val_mag" value="<?php echo $_POST['val_mag']; ?>">
            </div>
            <div class="form-group">
              <label for="val_mag">Image :</label>
              <img style="width:300px;" src="<?= WEBROOT.'images/'.$_POST['url_img_mag'] ?> ">
            </div>
            

            <div class="form-group">
              <label for="link_mag">Lien :</label>
              <input type="text" class="form-control" id="link_mag" placeholder="Lien" name="link_mag" value="<?php echo $_POST['link_mag']; ?>">
            </div>

            <div class="form-group">
              <input type="hidden" value="<?= $_SESSION['csrf'] ?>" name="csrf">
            </div>
            <button type="submit" class="btn btn-default">Enregistrer la catégorie</button>

          </form>

        </div>
      </div>
    </div>

<?php include "partials/footer.php"; ?>