<?php include "includes/constants.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php

  if(isset($_POST['name_cat']) && isset($_POST['slug_cat'])){
    checkCsrf();
    $slug = $_POST['slug_cat'];
    if(preg_match('/^[a-z\-0-9]+$/' , $slug)){
      $name = $db->quote($_POST['name_cat']);
      $slug = $db->quote($_POST['slug_cat']);

      if(isset($_GET['id'])){

        $id = $db->quote($_GET['id']);
        $db->query("UPDATE categories SET name_cat = $name, slug_cat = $slug WHERE id_cat = $id");

      }else{

        $db->query("INSERT INTO categories SET name_cat = $name, slug_cat = $slug");
        
      }

      header('Location:categories.php');
      die();

    }else{

    }
  }

  if(isset($_GET['id'])){

    $id = $db->quote($_GET['id']);
    $select = $db->query("SELECT * FROM categories WHERE id_cat=$id");
    if($select->rowCount() == 0){
      header('Location:categories.php');
      die();
    }
    $_POST = $select->fetch();
  }

?>

<?php include "partials/header.php"; ?>



<body>

        <?php include('includes/navAdmin.php') ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Editer Catégorie</h1>

          <form action="#" method="POST">

            <div class="form-group">
              <label for="name_cat">Nom de la catégorie :</label>
              <input type="text" class="form-control" id="name_cat" placeholder="Nom de la catégorie" name="name_cat" value="<?php if(isset($_POST['name_cat'])){echo $_POST['name_cat'];} ?>">
            </div>
            <div class="form-group">
              <label for="slug_cat">Slug :</label>
              <input type="text" class="form-control" id="slug_cat" placeholder="Slug" name="slug_cat" value="<?php if(isset($_POST['slug_cat'])){echo $_POST['slug_cat'];} ?>">
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