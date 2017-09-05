<?php include "includes/constants.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php

  $lines;$magasins;

  if(isset($_GET['id'])){

    $id = $db->quote($_GET['id']);
    $select = $db->query("SELECT * FROM vp_pages WHERE id_page=$id");
    if($select->rowCount() == 0){
      header('Location:pages.php');
      die();
    }
    $_POST = $select->fetch();

    // ON RECUP LES LIGNES DE LA PAGE
    $idLines = explode(";", $_POST['id_lignes_page']);
    for($i = 0 ; $i < count($idLines) ; $i++){
      $id = $idLines[$i];
      $select = $db->query("SELECT * FROM vp_lignes WHERE id_ligne=$id");
      $lines[$i] = $select->fetch();
    }

    // ON RECUP LES MAGASINS DE CHAQUES LIGNES
    
    for($i = 0 ; $i < count($lines) ; $i++){
      $idMagasins[$i] = explode(";", $lines[$i]['id_magasins']);
      for($j = 0 ; $j < count($idMagasins[$i]) ; $j++){
        $id = $idMagasins[$i][$j];
        $select = $db->query("SELECT * FROM vp_magasins WHERE id_mag=$id");
        $magasins[$i][$j] = $select->fetch();
      }

    }

  }else{
    header('Location:pages.php');
    die();
  }

?>

<?php include "partials/header.php"; ?>



<body>

        <?php include('includes/navAdmin.php') ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Editer Page</h1>

          <form action="#" method="POST">

            <div class="form-group">
              <label for="nom_page">Nom de la page :</label>
              <input type="text" class="form-control" id="nom_page" placeholder="Nom de la catégorie" name="nom_page" value="<?php echo $_POST['nom_page']; ?>">
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                 
                  <?php
                    if( $_POST['is_active'] == 0){
                      echo '<input type="checkbox">';
                    }else{
                      echo '<input type="checkbox" checked>';
                    }
                  ?>
                   Page Active 
                </label>
              </div>
            </div>

            <div class="list-group">
              <?php

                for($i = 0 ; $i < count($lines) ; $i++){
                  echo '<div class="row">';
                  echo '<h2>Ligne '.($i+1).'</h2>';
                  for($j = 0 ; $j < count($idMagasins[$i]) ; $j++){
                    echo'<div class="col-sm-6 col-md-3">';
                    echo'<div class="thumbnail">';
                    echo'<img src="'.WEBROOT.'images/'.$magasins[$i][$j]['url_img_mag'].'" alt=""/>';
                    echo'<div class="caption">';
                    echo'<h3>'.$magasins[$i][$j]["nom_mag"].'</h3>';
                    echo'<p></p>';
                    echo'<p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>';
                    echo'</div>';
                    echo'</div>';
                    echo'</div>';
                  }
                  echo'</div>';
                  
                }
              ?>
            </div>       

            <?php var_dump($magasins);?>

            <div class="form-group">
              <input type="hidden" value="<?= $_SESSION['csrf'] ?>" name="csrf">
            </div>
            <button type="submit" class="btn btn-default">Enregistrer la page</button>

          </form>

        </div>
      </div>
    </div>

<?php include "partials/footer.php"; ?>